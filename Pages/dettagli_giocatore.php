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
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Biglietti
                </a>
                <ul class="dropdown-menu ">
                  <li><a class="dropdown-item" href="aquisti.php">Acquista un biglietto</a></li>
                  <li><a class="dropdown-item" href="ricercaPosti.php">Ricerca posto</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <ul class="nav collapse navbar-collapse justify-content-end text-dark ">
            <li class="nav-item ">
            <a href="profilo.php" class="btn btn-dark position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </a>
          </li>
          </ul>
        </div>
      </nav>

      <div class="container">
      
      <?php

      echo'
      <div class="row">
        <div class="col">
            <div class=" rounded card-ts h-100 " style="width: 18rem;">
              <div class="position-relative"></div>
              <img src="' . $row["link_imm"] . '" class="card-img-top rounded">
          </div>
        </div>

        <div class="col">
           <div>
            <h1> <span style="color: purple">' . $row["numero_maglia"] . '</span>  '. $row["nome"] .'  '. $row["cognome"] . '</h1>
           </div>
          <div class="row">

            <div class="col" >
              <h4>Nazionalità</h4><br>
              <p>'. $row["nazionalita"] .'</p>
            </div>
            <div class="col">
              <h4>Data di Nascita</h4><br>
              <p>'. $row["data_nascita"] .'</p>
            </div>
            <div class="col">
              <h4>Piede preferito</h4><br>
              <p>'. $row["piede_preferito"] .'</p>
            </div>
            <div class="col">
              <h4>Altezza</h4><br>
              <p>'. $row["altezza_cm"] .'</p>
            </div>
            <div class="col">
              <h4>Peso</h4><br>
              <p>'. $row["peso_kg"] .'</p>
            </div>

          </div>

          <div class="row"> 
            <div class="col" >
              <h4>Ruolo</h4><br>
              <p>'. $row["ruolo"] .'</p>
            </div>

            <div class="col">
              <h4>Valore di mercato</h4><br>
              <p>'. $row["valore_di_mercato"] .'</p>
            </div>

            <div class="col">
              <h4>Data di scadenza del contratto</h4><br>
              <p>'. $row["data_scadenza_contratto"] .'</p>
            </div>
        </div>
        <div>
             <table class="table">
              <tr> 
                  <td>Partite giocate </td>
                  <td>Minuti giocati </td>
                  <td>Gol </td>
                  <td>Assist </td>
                  <td>Cartellini gialli </td>
                  <td>Cartellini rossi </td>
              </tr>
              <tr>
                  <td>'. $row["partite_giocate"] .'</td>
                  <td>'. $row["minuti_giocati"] .'</td>
                  <td>'. $row["gol"] .' </td>
                  <td>'. $row["assist"] .' </td>
                  <td>'. $row["cartellini_gialli"] .' </td>
                  <td>'. $row["cartellini_rossi"] .' </td>
              </tr>
              </table>          
      </div>
       ';
      
      ?>

      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>