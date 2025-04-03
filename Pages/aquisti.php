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

<div class="container bg-body-tertiary p-3">
  <h2>Seleziona il tuo posto nella Curva Fiesole</h2>
  <svg id="svgArea" width="900" height="400"></svg>
</div>
<div id="popup"></div>

<script>
  (function () {
    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.getElementById("svgArea");

    // Parametri generali
    const maxSeatsPerRow = 100; // Numero massimo di posti nella fila più esterna
    const centerX = 450; // Centro X dell'arco
    const centerY = 380; // Centro Y
    const angleMin = Math.PI; // 180°: parte da sinistra
    const angleMax = 2 * Math.PI; // 0°: arriva a destra

    // Parametri per il cerchio grande
    const largeRows = 8;
    const baseRadiusLarge = 200;
    const deltaRadiusLarge = 22;

    // Parametri per il cerchio piccolo (interno, blu)
    const smallRows = 3;
    const baseRadiusSmall = 120;
    const deltaRadiusSmall = 18;

    // Funzione per creare un arco
    function creaArco(radius, color) {
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

    // Disegna gli archi
    creaArco(baseRadiusLarge + (largeRows - 1) * deltaRadiusLarge); // Arco grande
    creaArco(baseRadiusSmall + (smallRows - 1) * deltaRadiusSmall); // Arco piccolo

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
        circle.addEventListener("click", function (e) {
          e.stopPropagation();
          const popup = document.getElementById("popup");
          popup.innerHTML = `<strong>Posto selezionato:</strong> Fila ${this.dataset.fila}, Numero ${this.dataset.numero}<br>
            <button id="chiudiPopup">Chiudi</button>
            <button id="confermaPosto">Conferma</button>`;
          popup.style.left = e.clientX + 10 + "px";
          popup.style.top = e.clientY + 10 + "px";
          popup.style.display = "block";

          document.getElementById("chiudiPopup").addEventListener("click", function (ev) {
            popup.style.display = "none";
            ev.stopPropagation();
          });

          document.getElementById("confermaPosto").addEventListener("click", function (ev) {
            document.getElementById("inputFila").value = circle.dataset.fila;
            document.getElementById("inputNumero").value = circle.dataset.numero;
            popup.style.display = "none";
            ev.stopPropagation();
          });
        });
      } else {
        circle.classList.add("posto", "occupato");
      }
      svg.appendChild(circle);
    }

    // Genera i posti per il cerchio piccolo (A-C)
    for (let i = 0; i < smallRows; i++) {
      const fila = String.fromCharCode(65 + i); // A, B, C
      const radius = baseRadiusSmall + i * deltaRadiusSmall;
      const seatsInRow = Math.floor(maxSeatsPerRow * (radius / (baseRadiusLarge + (largeRows - 1) * deltaRadiusLarge)));
      for (let j = 0; j < seatsInRow; j++) {
        const angle = angleMin + (j * (angleMax - angleMin)) / (seatsInRow - 1);
        const cx = centerX + radius * Math.cos(angle);
        const cy = centerY + radius * Math.sin(angle);
        creaPosto(fila, j + 1, cx, cy, true);
      }
    }

    // Genera i posti per il cerchio grande (D-M)
    for (let i = 0; i < largeRows; i++) {
      const fila = String.fromCharCode(68 + i); // D, E, F, ..., M
      const radius = baseRadiusLarge + i * deltaRadiusLarge;
      const seatsInRow = Math.floor(maxSeatsPerRow * (radius / (baseRadiusLarge + (largeRows - 1) * deltaRadiusLarge)));
      for (let j = 0; j < seatsInRow; j++) {
        const angle = angleMin + (j * (angleMax - angleMin)) / (seatsInRow - 1);
        const cx = centerX + radius * Math.cos(angle);
        const cy = centerY + radius * Math.sin(angle);
        creaPosto(fila, j + 1, cx, cy, true);
      }
    }

    document.addEventListener("click", function () {
      document.getElementById("popup").style.display = "none";
    });
  })();
</script>

<div class="container text-start bg-body-tertiary p-5">
<form class="row g-3">
  <div class="col-md-6">
    <label for="inputname" class="form-label">Nome</label>
    <input type="text" class="form-control" id="inputname">
  </div>
  <div class="col-md-6">
    <label for="inputsurname" class="form-label">Cognome</label>
    <input type="text" class="form-control" id="inputsurname">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4">
  </div>

  <h3>Indirizzo</h3>

  <div class="col-4">
    <label for="inputAddress" class="form-label">Via/Piazza</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="via del filarete">
  </div>
  <div class="col-4">
    <label for="inputAddress2" class="form-label">Civico/Interno</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="5/a, interno 38">
  </div>
  <div class="col-md-4">
    <label for="inputCity" class="form-label">Città</label>
    <input type="text" class="form-control" id="inputCity">
  </div>

  <h3>Posto</h3>

  <div class="col-md-4">
    <label for="inputCity" class="form-label">Fila</label>
    <input type="text" class="form-control" id="inputFila">
  </div>

  <div class="col-md-4">
    <label for="inputCity" class="form-label">Numero</label>
    <input type="text" class="form-control" id="inputNumero"> 
  </div>

  <div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select">
      <option selected>Choose...</option>
      <option>...</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" class="form-control" id="inputZip">
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>
</div>

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