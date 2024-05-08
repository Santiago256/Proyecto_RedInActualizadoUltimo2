<?php
session_start();
$isUserLoggedIn = isset($_SESSION['username']);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Servicios</title>
    <link rel="stylesheet" href="menu.css?v=<?php echo filemtime('menu.css'); ?>">
    <link rel="stylesheet" href="styleServicios.css">
     
<body>
<nav class="menu">
      
      <div class="logo white-border"></div>
      <span class="neon-text" style="margin-left: 10px; <?php if ($isUserLoggedIn) echo 'margin-left: 3px; font-size: 20px;'; ?>">ANE 2023</span>
      <ul class="menu_items">
          <li class="menu_item">
              <a href="home.php" class="menu_item-link">Inicio</a>
          </li>
          <li class="menu_item">
                  <a href="https://www.suin-juriscol.gov.co/imagenes//22/11/2023/1700681786391_Diario%2052567%20-%20Resolucion%20773%20-%20Anexo%201.pdf" target="_blank"  class="menu_item-link">Resolución ANE 773</a>
              </li>
          <li class="menu_item">
                  <a href="grafica.php" class="menu_item-link">Señalización</a>
              </li>
           <li class="menu_item">
                  <a href="ServiciosTelecom.php" class="menu_item-link">Servicios Telecom</a>
              </li>
          <li class="menu_item">
              <a href="comentarios.php" class="menu_item-link">Comentarios </a>
          </li>
            <?php if ($isUserLoggedIn): ?>
        <li class="menu_item">
            <form action="CerrarSesion.php" method="post">
                <a href="CerrarSesion.php" class="menu_item-link">Cerrar sesión </a>
            </form>
        </li>
        <?php endif; ?>
      </ul>
  </nav>

    <h1>Seleccione el tipo de servicio</h1>

<div class="button-container">
    <ul class="options">
        <li><button class="glow-on-hover" onclick="showInfo('serviciosMoviles')">Estaciones de Servicios Móviles Convencionales</button></li>
        <li><button class="glow-on-hover" onclick="showInfo('radiodifusion')">Estaciones de Radiodifusión</button></li>
        <li><button class="glow-on-hover" onclick="showInfo('radioaficionados')">Estaciones Radioeléctricas Fuera de las Bandas IMT</button></li>
    </ul>
</div>

<div id="infoContainer" style="display: none;"></div>

<div id="serviciosMoviles" style="display:none;">
    <!-- Información sobre Estaciones de Servicios Móviles Convencionales -->
    <h2>Estaciones de Servicios Móviles Convencionales</h2>
    <p style="text-align: justify;">Esta estación no requerirá procedimientos de evaluación ni de mediciones debido a sus características:</p>
    <ul style="text-align: justify;">
        <li >Frecuencia de funcionamiento de 130 MHz a 450 MHz.</li>
        <li>PIRE menor o igual a 200W.</li>
        <li>Altura del sistema radiante (tomado desde el nivel del suelo del público en general hasta la parte media del arreglo) mayor a 5 metros.</li>
    </ul>
</div>
<div id="radiodifusion" style="display:none;">
    <!-- Información sobre Estaciones de Radiodifusión -->
    <h2>Estaciones de Radiodifusión</h2>
    <p style="text-align: justify;">Esta estación no requerirá procedimientos de evaluación ni de mediciones debido a sus características:</p>
    <ul style="text-align: justify;">
        <li>Con potencia P.R.A. menor o igual a 250W.</li>
        <li>Altura de su sistema radiante (tomado desde el nivel del suelo del público en general hasta la parte media del arreglo) mayor o igual a 8 metros.</li>
    </ul>
</div>
<div id="radioaficionados" style="display:none;">
    <!-- Información sobre Radioaficionados -->
    <h2>Estaciones Radioeléctricas Fuera de las Bandas IMT:</h2>
    <p style="text-align: justify; margin-bottom: 10px;">Se requiere un cálculo para determinar si las estaciones cumplen con las distancias de protección establecidas en el numeral 3.2 de la resolución ANE 2023.</p>
    <button class="custom-button" onclick="realizarCalculo()">Realizar cálculo</button>

</div>

<script>
  function showInfo(id) {
    // Oculta todos los elementos de información
    var allInfo = document.querySelectorAll('.container > div');
    allInfo.forEach(function(info) {
        info.style.display = 'none';
    });
    // Muestra el elemento de información correspondiente al id proporcionado
    var selectedInfo = document.getElementById(id);
    // Mueve el contenido del div de información seleccionado al div de visualización
    document.getElementById("infoContainer").innerHTML = selectedInfo.innerHTML;
    document.getElementById("infoContainer").style.display = 'block';
}

function realizarCalculo(){
        window.location.href = "calculo.php";
    }

</script>

</body>
</html>
