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
<?php  include("../db.php"); ?>

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
  const popup = document.getElementById("popup");
  let postiSelezionati = [];

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
          if (postiSelezionati.length >= 3) {
            alert("Puoi selezionare al massimo 3 posti.");
            return;
          }

          if (postiSelezionati.find(p => p.fila === fila && p.numero === numero)) {
            alert("Hai già selezionato questo posto.");
            return;
          }

          this.classList.remove("libero");
          this.classList.add("selezionato");

          postiSelezionati.push({ fila, numero, costo: 15 });
          aggiornaForm();
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

  function aggiornaForm() {
    const container = document.getElementById("postiSelezionati");
    container.innerHTML = "";

    let totale = 0;

    postiSelezionati.forEach(p => {
      totale += p.costo;

      const wrapper = document.createElement("div");
      wrapper.className = "row g-2";
      wrapper.innerHTML = `
        <div class="col-md-2">
          <label class="form-label">Fila</label>
          <input type="text" class="form-control" name="fila[]" value="${p.fila}" readonly>
        </div>
        <div class="col-md-2">
          <label class="form-label">Numero</label>
          <input type="text" class="form-control" name="numero[]" value="${p.numero}" readonly>
        </div>
      `;
      container.appendChild(wrapper);
    });

    document.getElementById("costoBiglietto").value = totale + "€";
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

<div class="container text-start bg-body-tertiary p-5">
<form class="row g-3" method="post" action="../Controlli/controllo_acquisti.php">
  <div class="col-md-6">
    <label for="inputname" class="form-label">Nome</label>
    <input type="text" class="form-control" id="inputname" required>
  </div>
  <div class="col-md-6">
    <label for="inputsurname" class="form-label">Cognome</label>
    <input type="text" class="form-control" id="inputsurname" required>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4" required>
  </div>

  <h3>Indirizzo</h3>

  <div class="col-4">
    <label for="inputAddress" class="form-label">Via/Piazza</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="via del filarete"required>
  </div>
  <div class="col-4">
    <label for="inputAddress2" class="form-label">Civico/Interno</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="5/a, interno 38"required>
  </div>
  <div class="col-md-4">
    <label for="inputCity" class="form-label">Città</label>
    <input type="text" class="form-control" id="inputCity"required>
  </div>

  <h3>Posto</h3>

  <div id="postiSelezionati" class="row g-3"></div>

  <div class="col-md-2">
    <label for="costoBiglietto" class="form-label">Costo</label>
    <input type="text" class="form-control" id="costoBiglietto"> 
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-success">Conferma</button>
    <a><button class="btn btn-danger" href="./">Annulla</button></a>
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