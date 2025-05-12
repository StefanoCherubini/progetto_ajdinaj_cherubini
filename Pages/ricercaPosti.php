<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RicercaPosto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/logo.png">
    <style>
    .container { text-align: center; }
    .posto { cursor: pointer; }
    .libero { fill: green; }
    .occupato { fill: red; }
    .selezionato { fill: yellow; stroke: black; stroke-width: 2px; }

    #popup {
      display: none;
      position: absolute;
      background: #fff;
      border: 2px solid #444;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
      z-index: 10;
    }
    #popup button {
      margin-top: 10px;
      padding: 5px 10px;
    }
  </style>
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
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./stagione.php">Stagione</a>
              </li>
              <li class="nav-item  fs-4">
                <a class="nav-link active" aria-current="page" href="./rosa.php">Rosa</a>
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

<h2 class="container">Seleziona il tuo posto nella Curva Fiesole</h2>
<div class="svg-container" style="width: 100%; overflow: hidden;">
  <svg id="svgArea" viewBox="0 0 900 400" style="width: 100%; height: auto;"></svg>
</div>
<script> 
  @media (max-width: 767px) {
    .svg-container svg {
      width: 100% !important;  /* Per dispositivi mobili */
      height: auto !important;
    }
  }

  @media (min-width: 768px) {
    .svg-container svg {
      width: 60% !important;  /* Per PC, SVG più ridotto */
      height: auto !important;
    }
  }
</script>
<div id="popup"></div>

<script>
(function () {
  const svgNS = "http://www.w3.org/2000/svg";
  const svg = document.getElementById("svgArea");
  const popup = document.getElementById("popup");

  const maxSeatsPerRowLarge = 70;
  const maxSeatsPerRowSmall = 35;

  const centerX = 450;
  const centerY = 390;
  const angleMin = Math.PI;
  const angleMax = 2 * Math.PI;

  const baseRadiusLarge = 180;
  const deltaRadiusLarge = 20;

  const baseRadiusSmall = 100;
  const deltaRadiusSmall = 16;

  function creaArco(radius) {
    const startX = centerX + radius * Math.cos(angleMin);
    const startY = centerY + radius * Math.sin(angleMin);
    const endX = centerX + radius * Math.cos(angleMax);
    const endY = centerY + radius * Math.sin(angleMax);
    const path = document.createElementNS(svgNS, "path");
    path.setAttribute("d", `M ${startX} ${startY} A ${radius} ${radius} 0 0 1 ${endX} ${endY}`);
    path.setAttribute("fill", "none");
    path.setAttribute("stroke-width", "2");
    svg.appendChild(path);
  }

  creaArco(baseRadiusLarge + 5 * deltaRadiusLarge);
  creaArco(baseRadiusSmall + 2 * deltaRadiusSmall);

  function creaPosto(fila, num, cx, cy, disponibile = true) {
    const circle = document.createElementNS(svgNS, "circle");
    circle.setAttribute("cx", cx);
    circle.setAttribute("cy", cy);
    circle.setAttribute("r", 4);
    circle.setAttribute("data-fila", fila);
    circle.setAttribute("data-numero", num);
    circle.setAttribute("data-costo", 15);

    if (disponibile) {
      circle.classList.add("posto", "libero");

      circle.addEventListener("click", function (e) {
        const fila = this.dataset.fila;
        const numero = this.dataset.numero;

        popup.innerHTML = `
          <strong>Fila:</strong> ${fila}<br>
          <strong>Posto:</strong> ${numero}<br>
          <button id="btnConferma" class="btn btn-success btn-sm mt-2">Conferma</button>
          <button id="btnAnnulla" class="btn btn-danger btn-sm mt-2">Annulla</button>
        `;

        popup.style.display = "block";
        popup.style.left = e.pageX + 10 + "px";
        popup.style.top = e.pageY + 10 + "px";

        document.getElementById("btnConferma").addEventListener("click", () => {
          this.classList.remove("libero");
          this.classList.add("selezionato");
          popup.style.display = "none";
        });

        document.getElementById("btnAnnulla").addEventListener("click", () => {
          popup.style.display = "none";
        });

        e.stopPropagation();
      });

    } else {
      circle.classList.add("posto", "occupato"); // Non cliccabile
    }

    svg.appendChild(circle);
  }

  fetch('../Controlli/getPosti.php')
    .then(response => response.json())
    .then(postiOccupati => {
      const occupatiSet = new Set(postiOccupati.map(p => `${p.fila}-${p.num_posto}`));

      const righePiccolo = ['A', 'B', 'C'];
      const righeGrande = ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'];
      const tutteLeRighe = [...righePiccolo, ...righeGrande];

      tutteLeRighe.forEach(fila => {
        const isPiccolo = righePiccolo.includes(fila);
        const index = isPiccolo ? righePiccolo.indexOf(fila) : righeGrande.indexOf(fila);
        const radius = isPiccolo
          ? baseRadiusSmall + index * deltaRadiusSmall
          : baseRadiusLarge + index * deltaRadiusLarge;
        const postiPerFila = isPiccolo ? maxSeatsPerRowSmall : maxSeatsPerRowLarge;

        for (let num = 1; num <= postiPerFila; num++) {
          const angle = angleMin + (num * (angleMax - angleMin)) / postiPerFila;
          const cx = centerX + radius * Math.cos(angle);
          const cy = centerY + radius * Math.sin(angle);

          const disponibile = !occupatiSet.has(`${fila}-${num}`);
          creaPosto(fila, num, cx, cy, disponibile);
        }
      });
    });

  document.addEventListener("click", () => {
    popup.style.display = "none";
  });
})();
</script>
<br>
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
