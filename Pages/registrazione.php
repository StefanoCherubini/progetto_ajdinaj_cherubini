<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrazione</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../CSS/style.css"> 
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
    
      <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

      <?php if (isset($_GET['okk'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              Registrazione avvenuta con successo!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      <?php endif; ?>
    <br />
      <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center text-white mb-4">Registrazione Utente</h2>

            <form action="../Controlli/controllo_registrazione.php" method="POST">
              <div class="form-floating mb-3">
                  <input type="text" name="nome" class="form-control" id="floatingNome" placeholder="Nome" required>
                  <label for="floatingNome">Nome</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="text" name="cognome" class="form-control" id="floatingCognome" placeholder="Cognome" required>
                  <label for="floatingCognome">Cognome</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="date" name="data_nascita" class="form-control" id="floatingData" required>
                  <label for="floatingData">Data di Nascita</label>
              </div>

              <div class="form-floating mb-3">
                  <select name="sesso" class="form-select" id="floatingSesso" required>
                      <option value="">Seleziona</option>
                      <option value="M">Maschio</option>
                      <option value="F">Femmina</option>
                      <option value="Altro">Altro</option>
                  </select>
                  <label for="floatingSesso">Sesso</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="text" name="indirizzo" class="form-control" id="floatingIndirizzo" placeholder="Via..." required>
                  <label for="floatingIndirizzo">Indirizzo</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="text" name="civico" class="form-control" id="floatingCivico" placeholder="Civico" required>
                  <label for="floatingCivico">Civico</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="text" name="citta" class="form-control" id="floatingCitta" placeholder="Città" required>
                  <label for="floatingCitta">Città</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username" required>
                  <label for="floatingUsername">Username</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>
                  <label for="floatingEmail">Email</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                  <label for="floatingPassword">Password</label>
              </div>

              <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" name="abbonato" id="checkAbbonato" value="1">
                  <label class="form-check-label text-white" for="checkAbbonato">
                      Sono un abbonato
                  </label>
              </div>

              <div class="row g-3 mb-3">
                  <div class="col-md-6">
                      <div class="form-floating">
                          <input type="text" name="fila" class="form-control" id="floatingFila" placeholder="Fila" maxlength="1">
                          <label for="floatingFila">Fila (opzionale)</label>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-floating">
                          <input type="number" name="num_posto" class="form-control" id="floatingPosto" placeholder="Numero Posto">
                          <label for="floatingPosto">Numero Posto (opzionale)</label>
                      </div>
                  </div>
              </div>

              <button class="btn btn-primary w-100 mb-3" type="submit" name="register">Registrati</button>
              <p class="text-center text-white">Hai già un account? <a href="./profilo.php">Accedi</a></p>
          </form>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
