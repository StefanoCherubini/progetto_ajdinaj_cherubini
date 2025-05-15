<?php 
session_start();
include("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $sesso = $_POST['sesso'];
    $data_nascita = $_POST['data_nascita'];
    $indirizzo = trim($_POST['indirizzo']);
    $civico = trim($_POST['civico']);
    $citta = trim($_POST['citta']);
    $abbonato = isset($_POST['abbonato']) ? 1 : 0;
    $fila = !empty($_POST['fila']) ? $_POST['fila'] : null;
    $num_posto = !empty($_POST['num_posto']) ? intval($_POST['num_posto']) : null;

    // Controllo duplicati su email e username
    $stmt_check = $connessione->prepare("SELECT * FROM utenti WHERE email = ? OR username = ?");
    $stmt_check->bind_param("ss", $email, $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($result_check->num_rows > 0) {
        $error_message = "Email o username già in uso.";
        header("Location: ../Pages/registrazione.php?error=" . urlencode($error_message));
        exit;
    }

    // Verifica se il posto è già occupato
    if ($fila && $num_posto) {
        $stmt_verifica = $connessione->prepare("SELECT * FROM posti WHERE fila = ? AND num_posto = ?");
        $stmt_verifica->bind_param("si", $fila, $num_posto);
        $stmt_verifica->execute();
        $result = $stmt_verifica->get_result();
        if ($result->num_rows > 0) {
            $error_message = "Il posto fila $fila numero $num_posto è già occupato.";
            header("Location: ../Pages/registrazione.php?error=" . urlencode($error_message));
            exit;
        }
    }

    // Inizio transazione
    $connessione->begin_transaction();

    try {
        // Inserisci il posto se specificato
        if ($fila && $num_posto) {
            $settore = ($fila >= 'A' && $fila <= 'C') ? 'GIU' : 'SU';
            $disponibile = 0;
            $stmt_posto = $connessione->prepare("INSERT INTO posti (fila, num_posto, settore, disponibile) VALUES (?, ?, ?, ?)");
            $stmt_posto->bind_param("sisi", $fila, $num_posto, $settore, $disponibile);
            $stmt_posto->execute();
        }

        // Inserisci utente
        $stmt_user = $connessione->prepare("INSERT INTO utenti 
            (nome, cognome, email, username, password, sesso, data_nascita, indirizzo, civico, citta, abbonato, fila, num_posto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_user->bind_param(
            "ssssssssssisi",
            $nome,
            $cognome,
            $email,
            $username,
            $password,
            $sesso,
            $data_nascita,
            $indirizzo,
            $civico,
            $citta,
            $abbonato,
            $fila,
            $num_posto
        );
        $stmt_user->execute();

        // Commit
        $connessione->commit();
        header("Location: ../Pages/registrazione.php?okk");
        exit;

    } catch (Exception $e) {
        $connessione->rollback(); // annulla tutto
        $error_message = "Errore durante la registrazione: " . $e->getMessage();
        header("Location: ../Pages/registrazione.php?error=" . urlencode($error_message));
        exit;
    }
}
?>