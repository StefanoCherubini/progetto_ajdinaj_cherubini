<?php
        session_start(); 
        include("../db.php");

        $email = $_POST['email'];
        $password = $_POST['password'];

        // prepared per sicurezza (evitare SQL injection)
        $stmt = $connessione->prepare("SELECT * FROM utenti WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Login riuscito: salva in sessione
            $_SESSION['email'] = $row['email'];
            $_SESSION['nome'] = $row['nome']; // se c'è
            header("Location: ../Pages/profilo.php");
            exit;
        } else {
            header("Location: ../Pages/profilo.php?ERROR=true");
            exit;
        }
?>