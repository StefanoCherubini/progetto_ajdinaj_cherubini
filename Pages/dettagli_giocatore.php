<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ù, initial-scale=1.0">
    <title>Giocatore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="../CSS/style.css"> 

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/x-icon" href="../Images/logo.png">
</head>
<body>
    <?php
        include("../db.php");

        $query = "SELECT *
                  FROM giocatori 
                  WHERE id = '$_GET[id]'";

        $result = mysqli_query($connessione,$query)
        or die("Errore " . mysqli_error($connessione) . mysqli_errno($connessione));

        $row = $result -> fetch_assoc();
    ?>

      <nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
        <div class="container-fluid">
            <nav class="navbar bg-body-tertiary">
                <div class="container">
                  <a class="navbar-brand" href="../index.php">
                    <img src="../Images/logo.png" width="40" height="40">
                  </a>
                </div>
              </nav>
            <a class="navbar-brand" href="../index.php">FIESOLE NEWS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
              </li>
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="../News/primaPagina.html">News</a>
              </li>
              <li class="nav-item dropdown fs-4">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Biglietti
                </a>
                <ul class="dropdown-menu ">
                  <li><a class="dropdown-item" href="./aquisti.php">Acquista un biglietto</a></li>
                  <li><a class="dropdown-item" href="./ricercaPosti.php">Ricerca posto</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <ul class="nav collapse navbar-collapse justify-content-end text-dark ">
            <li class="nav-item ">
            <a href="./profilo.php" class="btn btn-dark position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </a>
          </li>
          </ul>
        </div>
      </nav>
        <div class="container my-5">

<?php
  echo '
  <div class="row gy-4 align-items-center">
    <!-- IMMAGINE GIOCATORE -->
    <div class="col-md-4 text-center">
      <div class="rounded card-ts h-100 border-0 shadow-sm rounded-4" style="width: 18rem">
        <img src="' . $row["link_imm"] . '" class="card-img-top rounded-4" alt="' . $row["nome"] . ' ' . $row["cognome"] . '">
      </div>
    </div>

    <!-- INFO PRINCIPALI -->
    <div class="col-md-8">
      <h1 class="fw-bold text-purple mb-3">
        <span class="me-2" style="font-size: 2rem; color: purple;">#' . $row["numero_maglia"] . '</span> 
        ' . $row["nome"] . ' ' . $row["cognome"] . '
      </h1>

      <div class="row row-cols-2 row-cols-md-3 g-3">
        <div><strong>Nazionalità:</strong><br>' . $row["nazionalita"] . '</div>
        <div><strong>Data di nascita:</strong><br>' . $row["data_nascita"] . '</div>
        <div><strong>Piede preferito:</strong><br>' . $row["piede_preferito"] . '</div>
        <div><strong>Altezza:</strong><br>' . $row["altezza_cm"] . ' cm</div>
        <div><strong>Peso:</strong><br>' . $row["peso_kg"] . ' kg</div>
        <div><strong>Ruolo:</strong><br>' . $row["ruolo"] . '</div>
        <div><strong>Valore di mercato:</strong><br>' . $row["valore_di_mercato"] . ' mil. di €</div>
        <div><strong>Scadenza contratto:</strong><br>' . $row["data_scadenza_contratto"] . '</div>
      </div>
    </div>
  </div>

  <!-- STATISTICHE -->
  <div class="mt-5">
    <h3 class="text-purple">Statistiche stagione</h3>
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center mt-3 shadow-sm">
        <thead class="table-light">
          <tr>
            <th>Partite</th>
            <th>Minuti</th>
            <th>Gol</th>
            <th>Assist</th>
            <th>Gialli</th>
            <th>Rossi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>' . $row["partite_giocate"] . '</td>
            <td>' . $row["minuti_giocati"] . '</td>
            <td>' . $row["gol"] . '</td>
            <td>' . $row["assist"] . '</td>
            <td>' . $row["cartellini_gialli"] . '</td>
            <td>' . $row["cartellini_rossi"] . '</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>';
?>
</div>
<br>
<br>
<br>
<br>
<br>
<br>



<footer class="container-fluid justify-content-between py-3">
      <div class="row row-cols-1 row-cols-md-3 g-4 row ">
        <div class="col"> 
          <ul class="social-list"> 
            <li> <p> TERMINI E CONDIZIONI </p> </li>
            <li> <p> PRIVACY  </p> </li>
            <li> <p> LAVORA CON NOI  </p> </li>
            <li> <p> PROCEDURA SPEDIZIONI </p> </li>
            <li> <p> DIRITTI DI GARANZIA </p> </li>
          </ul>
        </div>

        <div class="col">
          <div class="social-cont">    
            <ul class="social-list text-white">
              <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/facebook-icon.png" title="facebook" alt="Facebook icon"></a></li>
              <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/instagram-icon.png" title="Instagram" alt="Instagram icon"></a></li>
              <li><a target="_blank" href="#"><img src="../Images/icons8-whatsapp-50.png" title="Whatsapp" alt="Whatsapp icon" style="width: 20px; height: 20px;"></a></li>
            </ul>
          </div> 
        </div>

        <div class="col"> 
          <ul class="social-list"> 
            <li> <p> sito realizzato da </p> </li>
            <li> <p> Stefano Cherubini , Andrea Ajdinaj © 2025 </p> </li>
          </ul>
        </div>
      </div>
    </footer>

<style>
.text-purple {
  color: #5f259f; /* Viola ufficiale ACF Fiorentina */
}
</style>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>