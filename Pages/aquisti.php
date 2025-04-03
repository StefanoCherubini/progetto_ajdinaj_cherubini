<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcquistiBiglietti</title>
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
    
    /* Stile per il popup */
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
<?php  include("../db.php");?>
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
  <div class="container">
    <svg id="svgArea" width="900" height="600"></svg>
  </div>
  <div id="popup"></div>
  
  <script>
    (function() {
      const svgNS = "http://www.w3.org/2000/svg";
      const svg = document.getElementById("svgArea");
      
      // Parametri per la disposizione dei posti
      const rowCount = 8;        // 0-8
      const maxSeatsPerRow = 100; // Numero massimo di posti nella fila più esterna
      const baseRadius = 200;     // Raggio della prima fila (posti) attuale
      const deltaRadius = 22;      // Incremento del raggio per ogni fila
      const centerX = 420;        // Centro X dell'arco
      const centerY = 400;        // Centro Y: posizionato per far aprire l'arco verso il basso
      const angleMin = Math.PI;   // 180°: parte da sinistra
      const angleMax = 2*Math.PI;         // 0°: arriva a destra
      
      // Disegna l'arco principale (fila più esterna)
      const outerRadius = baseRadius + (rowCount - 1) * deltaRadius;
      const startX = centerX + outerRadius * Math.cos(angleMin);
      const startY = centerY + outerRadius * Math.sin(angleMin);
      const endX   = centerX + outerRadius * Math.cos(angleMax);
      const endY   = centerY + outerRadius * Math.sin(angleMax);
      const path = document.createElementNS(svgNS, "path");
      path.setAttribute("d", `M ${startX} ${startY} A ${outerRadius} ${outerRadius} 0 0 1 ${endX} ${endY}`);
      path.setAttribute("fill", "none");
      path.setAttribute("stroke", "white");
      path.setAttribute("stroke-width", "2");
      svg.appendChild(path);
      
      // Disegna un arco aggiuntivo più piccolo, distante dalla prima fila
      const innerArcRadius = baseRadius - 30;
      const innerStartX = centerX + innerArcRadius * Math.cos(angleMin);
      const innerStartY = centerY + innerArcRadius * Math.sin(angleMin);
      const innerEndX   = centerX + innerArcRadius * Math.cos(angleMax);
      const innerEndY   = centerY + innerArcRadius * Math.sin(angleMax);
      const innerPath = document.createElementNS(svgNS, "path");
      innerPath.setAttribute("d", `M ${innerStartX} ${innerStartY} A ${innerArcRadius} ${innerArcRadius} 0 0 1 ${innerEndX} ${innerEndY}`);
      innerPath.setAttribute("fill", "none");
      innerPath.setAttribute("stroke", "blue");
      innerPath.setAttribute("stroke-width", "2");
      svg.appendChild(innerPath);
      
      // Funzione per creare un posto
      function creaPosto(fila, num, cx, cy, disponibile = true) {
        const circle = document.createElementNS(svgNS, "circle");
        circle.setAttribute("cx", cx);
        circle.setAttribute("cy", cy);
        circle.setAttribute("r", 4);
        circle.setAttribute("data-fila", fila);
        circle.setAttribute("data-numero", num);
        if (disponibile) {
          circle.classList.add("posto", "libero");
          circle.addEventListener("click", function(e) {
            // Evita che l'evento si propaghi
            e.stopPropagation();
            // Mostra il popup con le informazioni del posto
            const popup = document.getElementById('popup');
            popup.innerHTML = `<strong>Posto selezionato:</strong> Fila ${this.dataset.fila}, Numero ${this.dataset.numero}<br><button id="chiudiPopup">Chiudi</button>`;
            // Posiziona il popup vicino al puntatore
            popup.style.left = (e.clientX + 10) + 'px';
            popup.style.top = (e.clientY + 10) + 'px';
            popup.style.display = 'block';
            // Aggiungi listener per chiudere il popup
            document.getElementById('chiudiPopup').addEventListener('click', function(ev) {
              popup.style.display = 'none';
              ev.stopPropagation();
            });
          });
        } else {
          circle.classList.add("posto", "occupato");
        }
        svg.appendChild(circle);
      }
      
      // Genera i posti per ogni fila e per ogni posto in quella fila
      for (let i = 0; i < rowCount; i++) {
        const fila = String.fromCharCode(65 + i);
        const radius = baseRadius + i * deltaRadius;
        const seatsInRow = Math.floor(maxSeatsPerRow * (radius / (baseRadius + (rowCount - 1) * deltaRadius)));
        for (let j = 0; j < seatsInRow; j++) {
          const angle = angleMin + j * (angleMax - angleMin) / (seatsInRow - 1);
          const cx = centerX + radius * Math.cos(angle);
          const cy = centerY + radius * Math.sin(angle);
          creaPosto(fila, j + 1, cx, cy, true);
        }
      }
      
      // Chiudi il popup se si clicca fuori
      document.addEventListener('click', function() {
        document.getElementById('popup').style.display = 'none';
      });
    })();
  </script>

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
</body>
</html>