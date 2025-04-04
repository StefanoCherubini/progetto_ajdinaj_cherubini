<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FiesoleNews</title>
</head>
<body>
<?php
    include("../db.php");

    $query = "SELECT *
              FROM utenti 
              WHERE email = '$_POST[email]' and password = '$_POST[password]' ";

    $result = mysqli_query($connessione,$query)
    or die("Errore " . mysqli_error($connessione) . mysqli_errno($connessione));

    if(mysqli_num_rows($result) > 0){
       
    }
    else{
        header("Location: ../Pages/profilo.php?ERROR=true");
    }

    ?>
        <h2>BENVENUTO </h2>
       <p>per tornare alla home</p>
       <a href="index.php"><button>HOME</button></a>
</body>
</html>