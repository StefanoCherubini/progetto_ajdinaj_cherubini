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
  <div class="container  mb-3">

        <br />
        <br />
        <h3 class="text-start"> STAGIONE </h3>
        <p class="container fs-5"> Tutte le partite della stagione. </p>
         <div class="container mb-3">
            <!-- Dropdown per selezionare la competizione -->
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="competizioneDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Filtra per competizione
                </button>
                <ul class="dropdown-menu" aria-labelledby="competizioneDropdown">
                    <li><a class="dropdown-item" href="?competizione=Serie A">Serie A</a></li>
                    <li><a class="dropdown-item" href="?competizione=Conference League">UEFA Conference League</a></li>
                </ul>
             </div>
         </div>
      <div class="row text-center p-3 ">
    <?php 
        include("../db.php");

        $competizione = isset($_GET['competizione']) ? $_GET['competizione'] : 'Serie A' ; // Seleziona 'all' per tutte le competizioni

        $sql = "SELECT p.data_partita,
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
          JOIN squadra st ON p.id_squadra_trasferta = st.id_squadra"; // ← chiusura corretta

        if (!empty($competizione)) {
          $competizione = $connessione->real_escape_string($competizione);
          $sql .= " WHERE p.competizione = '$competizione'";
        }

  ?>
  <div class="container">
  <div class="row">
    <!-- Colonna sinistra: card delle partite (occupano 8 colonne in totale) -->
    <div class="col-lg-8">
      <div class="row">
        <?php
                $result = $connessione->query($sql);


        // Contatore per gestire righe da 2 card
        $i = 0;
        while ($row = $result->fetch_assoc()) {
          
          $squadra_casa =  htmlspecialchars($row["squadra_casa"]);
          $squadra_trasferta =  htmlspecialchars($row["squadra_trasferta"]);

            if ($i % 2 === 0 && $i !== 0) echo '</div><div class="row">'; // nuova riga ogni 2 card

            echo '
            <div class="col-md-6 mb-4">
              <div class="card rounded shadow bg-dark text-white h-100">
                <div class="card-body" id="card-body-viola">
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
                      ' . nl2br(htmlspecialchars($row["marcatori_casa"])) . '
                    </div>
                    <div class="col">
                      ' . nl2br(htmlspecialchars($row["marcatori_trasferta"])) . '
                    </div>
                  </div>
                </div>
              </div>
            </div>';
            $i++;
        }
        ?>
      </div>
    </div>

    <!-- Colonna destra: classifica -->
    <div class="col-lg-4">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm bg-white text-dark">
          <thead class="table-primary text-center">
            <tr>
              <th>Squadra</th>
              <th>Pt</th>
              <th>G</th>
              <th>V</th>
              <th>P</th>
              <th>S</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php
            $sql_classifica = "SELECT s.nome, c.punti_tot, c.partite_giocate, c.vittorie, c.pareggi, c.sconfitte
                               FROM classifica c
                               JOIN squadra s ON c.id_squadra = s.id_squadra
                               ORDER BY c.punti_tot DESC";
            $res_classifica = $connessione->query($sql_classifica);
            while ($row = $res_classifica->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>{$row['punti_tot']}</td>
                        <td>{$row['partite_giocate']}</td>
                        <td>{$row['vittorie']}</td>
                        <td>{$row['pareggi']}</td>
                        <td>{$row['sconfitte']}</td>
                      </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

 <br>
 <br>


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