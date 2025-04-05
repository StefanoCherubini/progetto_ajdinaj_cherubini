<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ù, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

        include("../db.php");

        $query = "SELECT *
                  FROM giocatori 
                  WHERE id = '$_GET[id]'";

        

        $result = mysqli_query($connessione,$query)
        or die("Errore " . mysqli_error($connessione) . mysqli_errno($connessione));




    ?>

    
</body>
</html>