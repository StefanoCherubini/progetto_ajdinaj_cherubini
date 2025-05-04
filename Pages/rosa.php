<!DOCTYPE html>
<html lang="en">
    <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ROSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/logo.png">
</head>
<body>
    <?php  include("../db.php");?>

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


    <div class="container " id="rosa"> 
      <br>
          <h3 >PORTIERI</h3>
          <br> 
          <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php
            $sql = "SELECT id, nome, cognome, link_imm FROM giocatori WHERE ruolo = 'Portiere'";
            $result = $connessione->query($sql);
            if ($result->num_rows > 0) {
                // Stampiamo ogni giocatore nel formato HTML richiesto
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col">
                            <div class="card card-hover rounded card-ts h-100 " style="width: 18rem;">
                                <div class="position-relative"></div>
                                <a href="./dettagli_giocatore.php?id='. $row['id'] .'"><img src="' . $row["link_imm"] . '" class="card-img-top rounded"></a> 
                                <div class="card-body" id="card-body-viola">
                                    <h5 class="card-title text-center text-white">' . $row["nome"] . ' ' . $row["cognome"] . '</h5> 
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "<p class='text-center'>Nessun giocatore trovato.</p>";
            }
          ?>
          </div>
          
          <br> 
          <h3>DIFENSORI</h3>
          <div class="row row-cols-1 row-cols-md-3 g-4">
          <br> 
          <?php
            $sql = "SELECT id, nome, cognome, link_imm FROM giocatori WHERE ruolo = 'Difensore'";
            $result = $connessione->query($sql);
            if ($result->num_rows > 0) {
                // Stampiamo ogni giocatore nel formato HTML richiesto
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col">
                            <div class="card rounded card-ts h-100 " style="width: 18rem;">
                                <div class="position-relative"></div>
                                <a href="./dettagli_giocatore.php?id='. $row['id'] .'"><img src="' . $row["link_imm"] . '" class="card-img-top rounded"></a> 
                                <div class="card-body" id="card-body-viola">
                                    <h5 class="card-title text-center text-white">' . $row["nome"] . ' ' . $row["cognome"] . '</h5> 
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "<p class='text-center'>Nessun giocatore trovato.</p>";
            }
            ?>
          </div>

            <br>
            <h3>CENTROCAMPISTI</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
            <br> 
          <?php
            $sql = "SELECT id, nome, cognome, link_imm FROM giocatori WHERE ruolo = 'Centrocampista'";
            $result = $connessione->query($sql);
            if ($result->num_rows > 0) {
                // Stampiamo ogni giocatore nel formato HTML richiesto
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col">
                            <div class="card rounded card-ts h-100 " style="width: 18rem;">
                                <div class="position-relative"></div>
                                <a href="./dettagli_giocatore.php?id='. $row['id'] .'"><img src="' . $row["link_imm"] . '" class="card-img-top rounded"></a> 
                                <div class="card-body " id="card-body-viola">
                                    <h5 class="card-title text-center text-white">' . $row["nome"] . ' ' . $row["cognome"] . '</h5> 
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "<p class='text-center'>Nessun giocatore trovato.</p>";
            }
            ?>
            </div>
          <br> 
          <h3>ATTACCANTI</h3>
          <div class="row row-cols-1 row-cols-md-3 g-4">
          <br> 
          <?php
            $sql = "SELECT id, nome, cognome, link_imm FROM giocatori WHERE ruolo = 'Attaccante'";
            $result = $connessione->query($sql);
            if ($result->num_rows > 0) {
                // Stampiamo ogni giocatore nel formato HTML richiesto
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col">
                            <div class="card rounded card-ts h-100 " style="width: 18rem;">
                                <div class="position-relative"></div>
                                <a href="./dettagli_giocatore.php?id='. $row['id'] .'"><img src="' . $row["link_imm"] . '" class="card-img-top rounded"></a> 
                                <div class="card-body" id="card-body-viola">
                                    <h5 class="card-title text-center text-white">' . $row["nome"] . ' ' . $row["cognome"] . '</h5> 
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "<p class='text-center'>Nessun giocatore trovato.</p>";
            }
            // Chiudiamo la connessione
            $connessione->close();
            ?>     
        </div> 
      </div>
    </div>
    <br>
<br>
<br>
<footer class="container-fluid justify-content-between  py-3" >
    
    <div class="row row-cols-1 row-cols-md-3 g-4 row ">
      <div class="col"> 
        <ul class="social-list"> 
          <li> <p> TERMINI E CONDIZIONI </p> </li>
          <li> <p> PRIVACY  </p> </li>
          <li> <p> LAVORA CON NOI  </p> </li>
          <li> <p> RIVENDITA ABBONAMENTO </p> </li>
          <li> <p> DIRITTI DI GARANZIA </p> </li>
        </ul>
      </div>

      <div class="col">
        <div class="social-cont ">    
          <ul class="social-list">
          <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/facebook-icon.png"  title="facebook" alt="Facebook icon"></a></li>
          <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/instagram-icon.png" title="Instagram" alt="Instagram icon"></a></li>
          <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/pinterest-icon.png" title="pinterest" alt="Instagram icon"></a></li>
          </ul>
        </div> 
      </div>

        <div class="col"> 
          <ul class="social-list"> 
            <li> <p> sito realizzato da </p> </li>
            <li> <p> Stefano Cherubini © 2023 </p> </li>
          </ul>
        </div>
	</footer>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html> 