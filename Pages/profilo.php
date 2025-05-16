<?php
  session_start();
  include("../db.php"); // connessione al DB

  // Se l'utente è loggato
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT id_utenti, cognome, nome, data_nascita, sesso, indirizzo, civico, citta, username, email, abbonato, fila, num_posto
              FROM utenti WHERE email = ?";
    $stmt = mysqli_prepare($connessione, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $utente = mysqli_fetch_assoc($result);

    // Aggiungi l'id nella sessione
    $_SESSION['id_utenti'] = $utente['id_utenti'];
    
  
    $id_utente = $utente['id_utenti']; // recupera ID dalla sessione o dall'array utente

    $query_biglietti = "SELECT * FROM biglietti WHERE id_utente = $id_utente ORDER BY id_biglietto DESC";
    $result_biglietti = mysqli_query($connessione, $query_biglietti);
  }
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PROFILO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../CSS/style.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/x-icon" href="../Images/logo.png">
</head>
<body class="pag2">
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
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./stagione.php">Stagione</a>
              </li>
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./rosa.php">Rosa</a>
              </li>
              <li class="nav-item dropdown fs-4">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Biglietti
                </a>
                <ul class="dropdown-menu ">
                  <li><a class="dropdown-item" href="./acquisti.php">Acquista un biglietto</a></li>
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
      <div class="mt-5 container text-white">
          <?php if (isset($utente)) : ?>
            <h2 class="text-center mb-4">Profilo Utente</h2>
            <div class="row justify-content-center">
              <!-- Colonna dati utente -->
              <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                <?php
                    foreach ($utente as $chiave => $valore) {
                        // Ignora 'password' e 'id_utenti'
                        if (in_array($chiave, ['password', 'id_utenti'])) continue;

                        if ($chiave === 'sesso') {
                            $valore = ($valore === 'M') ? 'Uomo' : (($valore === 'F') ? 'Donna' : $valore);
                        }

                        if ($chiave === 'abbonato') {
                            if ($valore == 1) {
                                $valore = "⭐💜";
                            } else {
                                $valore = "NO";
                            }

                            echo "<p class='h5 mb-3 text-dark'><strong>Abbonato:</strong> " . htmlspecialchars($valore) . "</p>";
                            continue;
                        }

                        // Se l'utente NON è abbonato, salta i campi 'fila' e 'num_posto'
                        if ($utente['abbonato'] == 0 && in_array($chiave, ['fila', 'num_posto'])) {
                            continue;
                        }

                        
                        echo "<p class='h5 mb-3 text-dark'><strong>" . ucfirst(str_replace("_", " ", $chiave)) . ":</strong> " . htmlspecialchars($valore ?: '') . "</p>";
                    }
                    ?>

                  <div class="text-center mt-4">
                    <a href="../controlli/controllo_logout.php" class="btn btn-danger">Logout</a>
                  </div>
                </div>
              </div>

              <!-- Colonna storico biglietti -->
              <div class="col-md-6">
                <div class="p-3  ">
                  <h4 class="text-center mb-3">Storico Biglietti</h4>
                  <?php if (mysqli_num_rows($result_biglietti) > 0): ?>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                          <tr>
                            <th>Fila</th>
                            <th>Numero</th>
                            <th>Settore</th>
                            <th>Data</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while ($biglietto = mysqli_fetch_assoc($result_biglietti)): ?>
                            <tr class="bg-light">
                              <td><?= htmlspecialchars($biglietto['fila']) ?></td>
                              <td><?= htmlspecialchars($biglietto['num_posto']) ?></td>
                              <td><?= htmlspecialchars($biglietto['settore']) ?></td>
                              <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($biglietto['data_acquisto']))) ?></td>
                            </tr>
                          <?php endwhile; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php else: ?>
                    <p>Nessun biglietto acquistato al momento.</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          <?php else: ?>
            <!-- Form login se non loggato -->
            <br />
            <form class="form-signin w-100 m-auto mt-5" action="../Controlli/controllo_login.php" method="POST">
              <h1 class="h3 mb-3 fw-normal text-white">Accedi al profilo</h1>
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput" class="text-dark">Indirizzo Email</label>
              </div>
              <br>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword" class="text-dark">Password</label>
              </div>
              <br>
              <p>Se non hai un account, <a href="./registrazione.php">registrati</a></p>
              <button class="btn btn-secondary w-100 py-2" type="submit">Accedi</button>
            </form>
              
          <?php endif; ?>
    </div>


<br />

<br />

<br />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
