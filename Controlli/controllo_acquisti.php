<!DOCTYPE html>
<html lang="en">
    <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIESOLE NEWS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/logo.png">
</head>
<body class="pag2">
    
      <nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
        <div class="container-fluid">
            <nav class="navbar bg-body-tertiary">
                <div class="container">
                  <a class="navbar-brand" href="../index.html">
                    <img src="../Images/logo.png" width="40" height="40">
                  </a>
                </div>
              </nav>
            <a class="navbar-brand" href="../index.html">FIESOLE NEWS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="../index.html">Home</a>
              </li>
              <li class="nav-item dropdown fs-4">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Biglietti
                </a>
                <ul class="dropdown-menu ">
                  <li><a class="dropdown-item" href="../Pages/aquisti.php">Acquista un biglietto</a></li>
                  <li><a class="dropdown-item" href="../Pages/ricercaPosti.php">Ricerca posto</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <ul class="nav collapse navbar-collapse justify-content-end text-dark ">
            <li class="nav-item ">
            <a href="../Pages/profilo.php" class="btn btn-dark position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </a>
          </li>
          </ul>
        </div>
      </nav>

      <br />
      <?php
      include("../db.php");
              session_start();

              if (!isset($_SESSION['id_utenti'])) {
                  die("Errore: utente non autenticato.");
              }
              $id_utenti = $_SESSION['id_utenti'];

              $posti = [];
              if (isset($_POST['fila']) && isset($_POST['numero'])) {
                  for ($i = 0; $i < count($_POST['fila']); $i++) {
                      $fila = strtoupper(trim($_POST['fila'][$i]));
                      $numero = intval($_POST['numero'][$i]);

                      if (!empty($fila) && $numero > 0) {
                          $settore = in_array($fila, ['A', 'B', 'C']) ? 'GIU' : 'SU';
                          $posti[] = [
                              'fila' => $fila,
                              'numero' => $numero,
                              'settore' => $settore
                          ];
                      }
                  }
              }

              $inseriti = [];
              $occupati = [];

              foreach ($posti as $posto) {
                  $fila = $posto['fila'];
                  $numero = $posto['numero']; 
                  $settore = $posto['settore'];

                  $query = "SELECT * FROM posti WHERE fila = '$fila' AND num_posto = $numero AND settore = '$settore' AND disponibile = 0";
                  $result = mysqli_query($connessione, $query);

                  if (mysqli_num_rows($result) > 0) {
                      $occupati[] = $posto;
                  } else {
                      $insert = "INSERT INTO posti (fila, num_posto, settore, disponibile) VALUES ('$fila', $numero, '$settore', 0)";
                      if (mysqli_query($connessione, $insert)) {
                          $inseriti[] = $posto;

                          $insert_storico = "INSERT INTO biglietti (id_utente, fila, num_posto, settore) VALUES ('$id_utenti', '$fila', $numero, '$settore')";
                          mysqli_query($connessione, $insert_storico);
                      }
                  }
              }

        ?>

    <div class="position-relative container text-white">
    <h2>Riepilogo </h2>
        <div class="position-absolute start-50 translate-middle-x">
        <?php if (!empty($inseriti)): ?>
            <h2>✅Acquisto avvenuto con successo:</h2>
            <ul>
                <?php foreach ($inseriti as $p): ?>
                    <h4>Fila <?= $p['fila'] ?>, Numero <?= $p['numero'] ?>, Settore <?= $p['settore'] ?></h4>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($occupati)): ?>
            <h2>⚠️Acquisto non andato a buon fine</h2>
            <br>
            <br>
            <p>Sembra che il posto da lei scelto:</p>
            <ul>
                <?php foreach ($occupati as $p): ?>
                    <h4> Fila <?= $p['fila'] ?>, Numero <?= $p['numero'] ?>, Settore <?= $p['settore'] ?></h4>
                <?php endforeach; ?>
            </ul>
            <p>è stato scelto da un altro utente o al momento non è disponibile.<span style="bold"> Le preghiamo di riprovare più tardi</span></p>
        <?php endif; ?>
        <br>
        <br>  
        <br>
        <br>
        <a href="../index.php"><button class="btn btn-success" >HOME</button> </a> 
        </div>
       
    </div>
        

  <br> 
  <br> 
  <br> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html> 