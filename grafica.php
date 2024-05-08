<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="menu.css?v=<?php echo filemtime('menu.css'); ?>">
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<?php
session_start();
$isUserLoggedIn = isset($_SESSION['username']);
?>
<style>

 .container{
  justify-content: space-between; 
 }
h1 {
  position:relative;
    color: white; /* Cambia el color del texto a blanco */
   text-align:center;
    margin-top: 70px;
  }
  .card-custom {
      background-color: #f8f9fa; /* Color de fondo personalizado para la tarjeta */
      max-width: 330px; /* Ancho máximo de la tarjeta */
      margin: 30px auto; /* Margen superior e inferior de 30px y centrar horizontalmente */
      padding: 20px; /* Agregar espacio interno a la tarjeta */
      border-radius: 10px; /* Agregar bordes redondeados */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Agregar una sombra */
      height: 600px;
    
    }

 
    .card-custom .card-header-first {
  margin-top: -15px;
  background: linear-gradient(0.3deg, rgb(30, 161, 239) 0.9%, rgb(49, 46, 252) 88.6%);
  box-shadow: 1px 5px 15px #a2a2a2;
  font-size: 25px;
  color: white; /* Color del texto del encabezado */
  margin-bottom: 20px;
  display: flex; /* Hacer que el contenedor sea un flexbox */
  align-items: center; /* Centrar verticalmente los elementos */
  justify-content: center; /* Centrar horizontalmente los elementos */
  text-align: center;
  border-radius: 10%; /* Hacer que los bordes sean redondos */
}


    .card-custom .card-body {
      padding: 20px 0; /* Agregar espacio interno al cuerpo de la tarjeta */
    }

    .card-custom .form-group label {
      font-weight: bold; /* Hacer el texto de las etiquetas en negrita */
    }

    .card-custom .form-group {
      margin-bottom: 30px; /* Agregar margen inferior a las cajas de texto */
    }


    .form-group label {
    margin-bottom: 10px; /* Espacio entre la etiqueta y el elemento de entrada */
    display: block; /* Para asegurarse de que cada etiqueta tenga su propia línea */
    color:black;
    }

h2{
  font-size: 23px; /* Ajusta el tamaño del texto según sea necesario */
  color:#FF3F3F; /* Cambia el color del texto según tus preferencias */
  font-weight: bold; /* Opcional: establece el peso de la fuente en negrita */
  margin-top: 10px;
}




 .imagen-aviso {
    width:40px;
    margin-top: 60px; /* Ajusta el margen superior para separarla del formulario */
    margin-left: 30px;
  }
  .card-title,
.form-text.text-muted.justify-text {
    color: black;
}

</style>
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
          <a target="_blank" href="https://www.suin-juriscol.gov.co/imagenes//22/11/2023/1700681786391_Diario%2052567%20-%20Resolucion%20773%20-%20Anexo%201.pdf" class="menu_item-link">Resolución ANE 773</a>
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


<div class="container">
<div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header  card-header-first d-flex justify-content-between">
              <h5 class="card-title">Seleccionar Tipo de Aviso</h5>
            </div>
            <div class="card-body">
    <!-- Contenido del Código 2 -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="tipo_aviso" style="color: black;">Seleccione el tipo de aviso:</label>
        <select name="tipo_aviso" id="tipo_aviso">
            <option value="ocupacional">Aviso de Zona Ocupacional</option>
            <option value="rebasamiento">Aviso de Zona de Rebasamiento</option>
        </select>
        <input type="submit" value="Mostrar Aviso">
    </form>

    <?php
    // Procesamiento del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se ha enviado el tipo de aviso
        if (isset($_POST["tipo_aviso"])) {
            // Obtener el tipo de aviso seleccionado
            $tipo_aviso = $_POST["tipo_aviso"];
            
            // Determinar la ruta de la imagen según el tipo de aviso
            $ruta_imagen = "";
            if ($tipo_aviso === "ocupacional") {
                $ruta_imagen = "Imagenes/Aviso_Zona_Ocupacional.jpg";
                $aviso = "Aviso de Zona Ocupacional";
            } elseif ($tipo_aviso === "rebasamiento") {
                $ruta_imagen = "Imagenes/Aviso_Zona_Rebasamiento.jpg";
                $aviso = "Aviso de Zona de Rebasamiento";
            } else {
                echo "<p>Tipo de aviso no válido</p>";
                exit; // Salir del script si el tipo de aviso no es válido
            }
            
            // Mostrar el título del aviso
            echo "<h2 style='color: black;'>$aviso</h2>";
            // Establecer el ancho deseado para el contenedor div
$ancho_contenedor = "200px"; // Puedes ajustar este valor según tus necesidades

        // Mostrar la imagen dentro de un div con el ancho deseado
            echo "<div style='width: $ancho_contenedor;'>";
          echo "<img src='$ruta_imagen'  style='width: 80%;  margin-left: 50px;'>";
          echo "</div>";
        } else {
            echo "<p>No se ha seleccionado ningún tipo de aviso</p>";
        }
    }
    
    ?>
    <script>

</script>

</div>
</div>
      </div>
    </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
  <script>

    




    
 document.addEventListener("DOMContentLoaded", function() {
   document.getElementById("equation").innerHTML = katex.renderToString("d = \\sqrt{r^2 - a^2}");
        });

</script>

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
