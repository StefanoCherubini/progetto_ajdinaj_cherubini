<?php
session_start();
include("../db.php"); // connessione al DB

// Gestione della registrazione
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Recupera i dati dal form di registrazione
    $nome = mysqli_real_escape_string($connessione, $_POST['nome']);
    $cognome = mysqli_real_escape_string($connessione, $_POST['cognome']);
    $email = mysqli_real_escape_string($connessione, $_POST['email']);
    $password = mysqli_real_escape_string($connessione, $_POST['password']);
    $sesso = mysqli_real_escape_string($connessione, $_POST['sesso']);
    $data_nascita = mysqli_real_escape_string($connessione, $_POST['data_nascita']);
    
    // Verifica se l'email è già registrata
    $query_check_email = "SELECT * FROM utenti WHERE email = ?";
    $stmt_check = mysqli_prepare($connessione, $query_check_email);
    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        $error_message = "L'email è già in uso. Scegli un'altra email.";
    } else {
        // Hash della password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Inserimento dei dati nel database
        $query_register = "INSERT INTO utenti (nome, cognome, email, password, sesso, data_nascita) 
                           VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_register = mysqli_prepare($connessione, $query_register);
        mysqli_stmt_bind_param($stmt_register, "ssssss", $nome, $cognome, $email, $password_hash, $sesso, $data_nascita);
        if (mysqli_stmt_execute($stmt_register)) {
            // Redirect alla pagina di login dopo la registrazione
            header("Location: ./login.php");
            exit();
        } else {
            $error_message = "Errore durante la registrazione. Riprova più tardi.";
        }
    }
}
?>

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

    <div class="container mt-5 text-white">
        <h2 class="text-center mb-4">Registrazione Utente</h2>

        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form action="registrazione.php" method="POST" class="form-signin">
            <div class="form-floating">
                <input type="text" name="nome" class="form-control" id="floatingNome" placeholder="Nome" required>
                <label for="floatingNome" class="text-dark">Nome</label>
            </div>
            <div class="form-floating">
                <input type="text" name="cognome" class="form-control" id="floatingCognome" placeholder="Cognome" required>
                <label for="floatingCognome" class="text-dark">Cognome</label>
            </div>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>
                <label for="floatingEmail" class="text-dark">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword" class="text-dark">Password</label>
            </div>
            <div class="form-floating">
                <input type="date" name="data_nascita" class="form-control" id="floatingData" placeholder="Data di Nascita" required>
                <label for="floatingData" class="text-dark">Data di Nascita</label>
            </div>
            <div class="form-floating">
                <select name="sesso" class="form-control" id="floatingSesso" required>
                    <option value="M">Maschio</option>
                    <option value="F">Femmina</option>
                </select>
                <label for="floatingSesso" class="text-dark">Sesso</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit" name="register">Registrati</button>
        </form>
        <p class="mt-3">Hai già un account? <a href="./login.php">Accedi</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
