<!DOCTYPE html>
<html lang="it">
    <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIESOLE NEWS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./CSS/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="./Images/logo.png">  
  </head>
  <body class="pag2"> 
      <nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
        <div class="container-fluid">
            <nav class="navbar bg-body-tertiary">
                <div class="container">
                  <a class="navbar-brand" href="index.php">
                    <img src="Images/logo.png" width="40" height="40">
                  </a>
                </div>
              </nav>
            <a class="navbar-brand" href="index.php">FIESOLE NEWS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./News/primaPagina.html">News</a>
              </li>
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./Pages/stagione.php">Stagione</a>
              </li>
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./Pages/rosa.php">Rosa</a>
              </li>
              <li class="nav-item dropdown fs-4">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Biglietti
                </a>
                <ul class="dropdown-menu ">
                  <li><a class="dropdown-item" href="./Pages/acquisti.php">Acquista un biglietto</a></li>
                  <li><a class="dropdown-item" href="./Pages/ricercaPosti.php">Ricerca posto</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <ul class="nav collapse navbar-collapse justify-content-end text-dark ">
            <li class="nav-item ">
            <a href="./Pages/profilo.php" class="btn btn-dark position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </a>
          </li>
          </ul>
        </div>
      </nav>

      <!-- NAVBAR SECONDARIA -->
      <nav class="bg-light border-top border-bottom shadow-sm">
        <div class="container">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link text-dark fs-7 " href="#novita">Novità</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark fs-7 " href="#ultimePartite">Ultime partite</a>
            </li>
          </ul>
        </div>
      </nav>

    <br /> 
    <!-- CAROSELLO NOVITA -->
    <h3 class="container text-start text-white" id="novita"> Novità </h3>
    <br />
    <div id="carouselExampleInterval" class="carousel slide container" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
              <a href="./News/Conf-semi2.html"><img src="https://imgresizer.eurosport.com/unsafe/2400x1260/filters:format(jpeg):focal(1242x335:1244x333)/origin-imgresizer.eurosport.com/2025/05/08/image-e77bfb7a-e92b-4ef7-ac96-43634b9fc8f0-85-2560-1440.jpeg" class="w-100 carousel-img" alt="..."></a>
          <div class="carousel-caption-custom">
            <p>Semifinale di ritorno di Conference League</p>
          </div>
        </div>
        <div class="carousel-item " data-bs-interval="5000">
          <a href="./News/Stagione.html"><img src="https://www.acffiorentina.com/getContentAsset/066e284b-7f66-4bdd-b8b8-9d7f6b8d4a54/fdc2628b-8d67-425c-b6d0-a02576381c81/acf-fiorentina-1a-squadfra-maschile-2024-25.webp?language=it" class="w-100 carousel-img" alt="..."></a>
          <div class="carousel-caption-custom">
            <p>Stagione 24/25</p>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
          <a href="./News/ViolaPark.html"><img src="https://www.acffiorentina.com/getContentAsset/1579881d-76d5-4258-8fb3-82544112881d/fdc2628b-8d67-425c-b6d0-a02576381c81/VP.webp?language=it" class="w-100 carousel-img" alt="..."></a>
          <div class="carousel-caption-custom">
            <p>Novità dal Viola Park</p>
          </div>
        </div>
        
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <br />
      <!-------TOAST ------->
      <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="Images/logo.png" class="rounded me-2" style="width: 30px; height: 30px; color: blueviolet;">
              <strong class="me-auto">Fiesole News</strong>
              <small>adesso</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Se hai bisogno di aiuto contattaci!
              <br>  
              <a target="_blank" href="#" class="social-list"><img src="https://www.chefstudio.it/img/instagram-icon.png" title="Instagram" alt="Instagram icon" style="width: 30px; height: 30px; filter: brightness(0) saturate(100%) invert(17%) sepia(94%) saturate(6440%) hue-rotate(265deg) brightness(95%) contrast(101%);"></a>
              <a target="_blank" href="#" class="social-list"><img src="./Images/icons8-whatsapp-50.png" title="Whatsapp" alt="Whatsapp icon" style="width: 20px; height: 20px; filter: brightness(0) saturate(100%) invert(17%) sepia(94%) saturate(6440%) hue-rotate(265deg) brightness(95%) contrast(101%);"></a>
            </div>
          </div>
        </div>
      </div>

  <div class="container ">

        <div class="row ">
          <?php
              include("./db.php");        // connessione DB
              
              $sql = "
                      SELECT 
                        P.*,
                        SC.nome AS nome_casa,
                        SC.immagine AS immagine_casa,
                        ST.nome AS nome_trasferta,
                        ST.immagine AS immagine_trasferta
                      FROM Partita P
                      INNER JOIN squadra SC ON P.id_squadra_casa = SC.id_squadra
                      INNER JOIN squadra ST ON P.id_squadra_trasferta = ST.id_squadra
                      WHERE (SC.nome = 'Fiorentina' OR ST.nome = 'Fiorentina')
                        AND P.risultato_finale != ''
                      ORDER BY P.data_partita DESC
                      LIMIT 1
                        ";
            
            
            $result = $connessione->query($sql);
            
            if ($result && $row = $result->fetch_assoc()) {
              $squadra_casa = htmlspecialchars($row["nome_casa"]);
              $squadra_trasferta = htmlspecialchars($row["nome_trasferta"]);
              $immagine_casa = htmlspecialchars($row["immagine_casa"]);
              $immagine_trasferta = htmlspecialchars($row["immagine_trasferta"]);
              $risultato = htmlspecialchars($row["risultato_finale"]);
              $competizione = htmlspecialchars($row["competizione"]);
              setlocale(LC_TIME, 'it_IT.UTF-8');
              $data = strftime("%e %B %Y", strtotime($row["data_partita"]));
              $marcatori_casa = nl2br(htmlspecialchars($row["marcatori_casa"]));
              $marcatori_trasferta = nl2br(htmlspecialchars($row["marcatori_trasferta"]));
          
                // Componi stringa marcatori
                $marcatori = [];
                if (!empty($marcatori_casa)) $marcatori[] = $marcatori_casa;
                if (!empty($marcatori_trasferta)) $marcatori[] = $marcatori_trasferta;
                $marcatori_testo = implode(', ', $marcatori);
            }
          ?>
          <!-- Ultima Partita -->
              <div class="col-12 col-md-6 mb-3" >
                <h3 class="text-white mb-3" id="ultimePartite">Ultima Partita</h3>
                <div class="card shadow-sm">
                  <div class="card-body">
                  <span class="badge bg-primary"><?= $competizione ?></span>
                    <div class="d-flex align-items-center justify-content-center  flex-wrap">
                      <img src="<?= $immagine_casa ?>" alt="<?= $squadra_casa ?>" width="42" height="42" class="me-2 rounded">
                      <span class="fw-bold fs-5"><?= $squadra_casa ?></span> 
                      <span class="mx-2 fs-5"><?= $risultato ?></span>
                      <span class="fw-bold fs-5"><?= $squadra_trasferta ?></span>
                      <img src="<?= $immagine_trasferta ?>" alt="<?= $squadra_trasferta ?>" width="42" height="42" class="ms-2 rounded">
                    </div>
                    <p class="mb-1 text-center"><?= $data ?></p>
                    <p class="mb-2"> <span class="fw-bold"> Marcatori:</span> <?= $marcatori_testo ?></p>
                  </div>
                </div>
              </div>
          
          <?php        
              $sql = "
                        SELECT 
                            P.*,
                            SC.nome AS nome_casa,
                            SC.immagine AS immagine_casa,
                            ST.nome AS nome_trasferta,
                            ST.immagine AS immagine_trasferta
                        FROM Partita P
                        INNER JOIN squadra SC ON P.id_squadra_casa = SC.id_squadra
                        INNER JOIN squadra ST ON P.id_squadra_trasferta = ST.id_squadra
                        WHERE (SC.nome = 'Fiorentina' OR ST.nome = 'Fiorentina')
                          AND P.data_partita > CURDATE()
                          AND P.risultato_finale = ''
                        ORDER BY P.data_partita ASC
                        LIMIT 1
                    ";
          
            $result = $connessione->query($sql);
          
            if ($result && $row = $result->fetch_assoc()) {
                $squadra_casa = htmlspecialchars($row["nome_casa"]);
                $squadra_trasferta = htmlspecialchars($row["nome_trasferta"]);
                $immagine_casa = htmlspecialchars($row["immagine_casa"]);
                $immagine_trasferta = htmlspecialchars($row["immagine_trasferta"]);
                $competizione = htmlspecialchars($row["competizione"]);
                setlocale(LC_TIME, 'it_IT.UTF-8');
                $data = strftime("%e %B %Y", strtotime($row["data_partita"]));
            }
          ?>

              <!-- Prossima Partita -->
              <div class="col-12 col-md-6 mb-3">
                  <h3 class="text-white mb-3">Prossima Partita</h3>
                  <div class="card shadow-sm">
                      <div class="card-body">
                      <span class="badge bg-primary"><?= $competizione ?></span>
                          <div class="d-flex align-items-center justify-content-center flex-wrap">
                              <img src="<?= $immagine_casa ?>" alt="<?= $squadra_casa ?>" width="42" height="42" class="me-2 rounded">
                              <span class="fw-bold fs-5"><?= $squadra_casa ?></span>
                              <span class="mx-2 fs-5">vs</span>
                              <span class="fw-bold fs-5"><?= $squadra_trasferta ?></span>
                              <img src="<?= $immagine_trasferta ?>" alt="<?= $squadra_trasferta ?>" width="42" height="42" class="ms-2 rounded">
                          </div>
                          <p class="mb-1 text-center"><?= $data ?></p>
                          <div class="mb-2">
                          <br /> 
                          </div>
                      </div>
                  </div>
              </div>

        </div>
        
          <!-- Card News -->
        <h2 class="my-4 text-center text-white">Ultime News</h2>
        <div class="masonry-grid">

          <!-- Card 1 -->
          <a href="./News/Stagione.html" class="text-decoration-none text-dark">
            <div class="news-card">
              <img src="https://www.acffiorentina.com/getContentAsset/066e284b-7f66-4bdd-b8b8-9d7f6b8d4a54/fdc2628b-8d67-425c-b6d0-a02576381c81/acf-fiorentina-1a-squadfra-maschile-2024-25.webp?language=it" class="news-image" alt="News 1">
              <div class="news-content">
                <div class="news-title">Stagione 2024/2025 </div>
                <div class="news-text">Rivivi la stagione.
                <br />
                  <br />
                </div>
                <div class="news-date">30 Aprile 2025</div>
              </div>
            </div>
          </a>

          <!-- Card 2 -->
          <a href="./News/ViolaPark.html" class="text-decoration-none text-dark">
            <div class="news-card">
              <img src="https://www.acffiorentina.com/getContentAsset/1579881d-76d5-4258-8fb3-82544112881d/fdc2628b-8d67-425c-b6d0-a02576381c81/VP.webp?language=it" class="news-image" alt="News 1">
              <div class="news-content">
                <div class="news-title">Viola Park</div>
                <div class="news-text">Informazioni sul viola park. Allenamenti, partite ed Eventi.</div>
                <div class="news-date">11 Aprile 2025</div>
              </div>
            </div>
          </a>

          <!-- Card 3 -->
          <a href="./News/KitAbbonato.html" class="text-decoration-none text-dark">
            <div class="news-card">
              <img src="https://www.acffiorentina.com/getContentAsset/211ca080-f61b-42d9-a631-d54f10a8730a/fdc2628b-8d67-425c-b6d0-a02576381c81/SITO.webp?language=it" class="news-image" alt="News 1">
              <div class="news-content">
                <div class="news-title">Kit dell'abbonato</div>
                <div class="news-text">Scopri il Kit dell'abbonato della stagione 2024/2025.</div>
                <div class="news-date">11 Aprile 2025</div>
              </div>
            </div>
          </a>

          <!-- Card 4 -->
          <a href="./News/maglie.html" class="text-decoration-none text-dark">
            <div class="news-card">
              <img src="https://www.ansa.it/webimages/news_base/2025/1/31/66f507d38a8f52d49d390b049642c047.jpg" class="news-image" alt="News 1">
              <div class="news-content">
                <div class="news-title">Abbigliamento ufficiale</div>
                <div class="news-text">Scopri tutte le maglie della stagione 2024/2025</div>
                <div class="news-date">6 Maggio 2025</div>
              </div>
            </div>
          </a>

        </div>

        <div class="row">
            <!-- Classifica 5°-9° -->
            <div class="col-12 col-md-6 mb-3">
              <h3 class="text-white mb-3">Classifica (5° - 9° posto)</h3>
              <div class="card shadow-sm">
                <div class="card-body">
                   <table class="table table-striped table-bordered table-sm bg-white text-dark">
                    <thead class="table-primary text-center">
                      <tr>
                        <th></th>
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
                        $sql_classifica = "SELECT s.nome, s.immagine, c.punti_tot, c.partite_giocate, c.vittorie, c.pareggi, c.sconfitte
                                          FROM classifica c
                                          JOIN squadra s ON c.id_squadra = s.id_squadra
                                          ORDER BY c.punti_tot DESC
                                          LIMIT 5 OFFSET 4";
                        $res_classifica = $connessione->query($sql_classifica);
                        if ($res_classifica->num_rows > 0) {
                          while ($row = $res_classifica->fetch_assoc()) {
                              echo "<tr>
                                      <td><img src='{$row['immagine']}' alt='{$row['nome']}' width='35' height='35' class='rounded me-2'></td>
                                      <td>{$row['nome']}</td>
                                      <td>{$row['punti_tot']}</td>
                                      <td>{$row['partite_giocate']}</td>
                                      <td>{$row['vittorie']}</td>
                                      <td>{$row['pareggi']}</td>
                                      <td>{$row['sconfitte']}</td>
                                    </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='6'>Nessun dato disponibile</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Marcatori -->
            <div class="col-12 col-md-6 mb-3 table-responsive">  
              <h3 class="text-white mb-3">Classifica Marcatori</h3>
              <table class="table table-striped table-bordered table-sm bg-white text-dark">
                <thead class="table-success text-center">
                  <tr>
                    <th></th>
                    <th>Giocatore</th>
                    <th>Goal</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <td>1°</td>
                    <td>Retegui</td>
                    <td>24</td>
                  </tr>
                  <tr id="card-body-viola">
                    <td class="text-white">2°</td>
                    <td><a href="./Pages/dettagli_giocatore.php?id=24" class="text-white">Kean</a></td>
                    <td class="text-white">17</td>
                  </tr>
                  <tr>
                    <td>3°</td>
                    <td>Lookman</td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td>4°</td>
                    <td>Thuram</td>
                    <td>14</td>
                  </tr>
                  <tr>
                    <td>5°</td>
                    <td>Orsolini</td>
                    <td>13</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>       
  </div>

<br />
<br />
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
          <li><a target="_blank" href="#"><img src="./Images/icons8-whatsapp-50.png" title="Whatsapp" alt="Whatsapp icon" style="width: 20px; height: 20px; "></a></li>
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
<script>
  window.addEventListener('DOMContentLoaded', function () {
    var toastEl = document.querySelector('.toast');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
  });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html> 