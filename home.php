<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$isUserLoggedIn = isset($_SESSION['username']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css?v=<?php echo filemtime('menu.css'); ?>">
    
</head>
<body>
    
<nav class="menu">
      
    <div class="logo white-border"></div>
   <span class="neon-text" style="margin-left: 10px; <?php if ($isUserLoggedIn) echo 'margin-left: 3px; font-size: 20px;'; ?>">ANE 2023</span>

    <ul class="menu_items">
        <li class="menu_item">
            <a href="home.php" class="menu_item-link">Inicio</a>
        </li>
        <li class="menu_item">
            <a href="https://www.suin-juriscol.gov.co/imagenes//22/11/2023/1700681786391_Diario%2052567%20-%20Resolucion%20773%20-%20Anexo%201.pdf"  target="_blank" class="menu_item-link">Resolución ANE 773</a>
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
        <?php
           if ($isUserLoggedIn) {
                echo '<li class="menu_item">
                          <form action="CerrarSesion.php" method="post">
                             <a href="CerrarSesion.php" class="menu_item-link">Cerrar sesión </a>
                          </form>
                      </li>';
            }
        ?>
    </ul>
</nav>


<div class="card">
<h2>¡Bienvenido!</h2>
    <p>Esta página está dedicada a proporcionarte información relevante sobre la Resolución ANE 773, gráficos, y servicios de telecomunicaciones además de comentar su experiencia en la página. Siéntete libre de explorar y utilizar los recursos disponibles.</p>
</div>

</body>
<footer>
    <!-- Pie de página con créditos y enlaces -->
    <p><a href="https://www.udistrital.edu.co/inicio">&copy; Universidad Distrital Francisco José de caldas</a></p>
    <p><a href="https://ftecnologica.udistrital.edu.co/">&copy; Facultad Tecnologica</a></p>
    <p>Materia: Redes Inalambricas </p>
    <p>Docente: <a href="mailto:marlonpb@udistrital.edu.co">Marlon Patiño Bernal</a></p>
    <p>Autores: <a href="jyduarteb@udistrital.edu.co">Jhonathan Yesid Duarte Bello</a> - <a href="sagutierrezb@udistrital.edu.co">Santiago Alejandro Gutiérrez Barrero</a> </p>
    <p>Fecha: [29/03/2024]</p>
</footer>
</html>
