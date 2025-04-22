<!DOCTYPE html>
<html lang="en">
    <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIESOLE NEWS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/logo.png">
  </head>
  <body> 
      <nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
        <div class="container-fluid">
            <nav class="navbar bg-body-tertiary">
                <div class="container">
                  <a class="navbar-brand" href="index.html">
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
  <div class="container">

        <br />
        <br />
        <h3 class="text-start" id="stagione"> STAGIONE </h3>
        <p class="container fs-5"> Tutte le partite della stagione. </p>

        <div class="row text-center p-3 ">
        <?php 
        include("../db.php");

        $sql = " SELECT p.data_partita,
                p.competizione,
                sc.nome AS squadra_casa,
                sc.immagine AS immagine_casa,
                st.nome AS squadra_trasferta,
                st.immagine AS immagine_trasferta,
                p.risultato_finale,
                p.marcatori_casa,
                p.marcatori_trasferta,
                p.calci_rigore,
                p.risultato_rigori
            FROM Partita p
            JOIN squadra sc ON p.id_squadra_casa = sc.id_squadra
            JOIN squadra st ON p.id_squadra_trasferta = st.id_squadra;
            ";
        $result = $connessione->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $squadra_casa = htmlspecialchars($row["squadra_casa"]);
                $squadra_trasferta = htmlspecialchars($row["squadra_trasferta"]);
                 
                echo '
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card rounded shadow bg-dark text-white h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <img src="'. $row["immagine_casa"] .'" alt="' . $squadra_casa . '" width="40" height="40" class="me-2 rounded">
                                <h5 class="mb-0 fw-bold fs-5">' . $squadra_casa . '</h5>
                                <span class="mx-2">vs</span>
                                <h5 class="mb-0 fw-bold fs-5">' . $squadra_trasferta . '</h5>
                                <img src="'. $row["immagine_trasferta"] .'" alt="' . $squadra_trasferta . '" width="40" height="40" class="ms-2 rounded">
                            </div>
                         <h6 class="text-center text-white small mb-3">' . date("d M Y", strtotime($row["data_partita"])) . ' - ' . htmlspecialchars($row["competizione"]) . '</h6>

                        <p class="text-center fs-4 fw-bold">' . htmlspecialchars($row["risultato_finale"]) . '</p>

                        <div class="row text-start mt-3">
                            <div class="col">
                                ' . nl2br(htmlspecialchars($row["marcatori_casa"])) . '<br />' . '
                            </div>
                            <div class="col">
                                ' . nl2br(htmlspecialchars($row["marcatori_trasferta"])) . '<br />' . '
                            </div>
                        </div>';

            // Mostra i rigori solo se il campo esiste e non è vuoto
            if (isset($row["rigori"]) && $row["rigori"] && !empty($row["risultato_rigori"])) {
                echo '
                        <div class="alert alert-warning p-2 mt-3 text-center">
                            ' . htmlspecialchars($row["risultato_rigori"]) . '
                        </div>';
            }

            echo '
                    </div>
                </div>
            </div>';
        }
        } else {
        echo '<p class="text-white">Nessuna partita trovata.</p>';
        }
        ?>

        <br />
        <br />
        <br />
        <br />

    </div>
    
    </div>
<footer class="container-fluid justify-content-between  py-3 ">
    
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
        <div class="social-cont ">    
          <ul class="social-list text-white">
          <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/facebook-icon.png"  title="facebook" alt="Facebook icon"></a></li>
          <li><a target="_blank" href="#"><img src="https://www.chefstudio.it/img/instagram-icon.png" title="Instagram" alt="Instagram icon"></a></li>
          <li><a target="_blank" href="#"><img src="../Images/icons8-whatsapp-50.png" title="Whatsapp" alt="Whatsapp icon" style="width: 20px; height: 20px; "></a></li>
          </ul>
        </div> 
      </div>

        <div class="col"> 
          <ul class="social-list"> 
            <li> <p> sito realizzato da </p> </li>
            <li> <p> Stefano Cherubini , Andrea Ajdinaj © 2025 </p> </li>
          </ul>
        </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html> 