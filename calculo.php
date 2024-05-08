
<?php
session_start();
$isUserLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculo</title>
    <link rel="stylesheet" href="menu.css?v=<?php echo filemtime('menu.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="calcular.css?v=1.2">
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
</head>
<body>
    <style>
 
    </style>
<nav class="menu">
    <div class="logo white-border"></div>

    <span class="neon-text" style="margin-left: 10px; <?php if ($isUserLoggedIn) echo 'margin-left: 3px; font-size: 20px;'; ?>">ANE 2023</span>
    <ul class="menu_items">
        <li class="menu_item">
            <a href="home.php" class="menu_item-link">Inicio</a>
        </li>
        <li class="menu_item">
            <a href="https://www.suin-juriscol.gov.co/imagenes//22/11/2023/1700681786391_Diario%2052567%20-%20Resolucion%20773%20-%20Anexo%201.pdf" target="_blank" class="menu_item-link">Resolución ANE 773</a>
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
    <!-- Primer contenedor para calcular r -->
    <div class="row">
        <div class="col-md-6">
            <form class="form-group" id="calcularRForm">
                <div class="card-rounded">
                    <h5 class="card-title">Evaluación de la estación</h5>
                    <p>Ingresa los siguientes datos:</p>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="potencia" class="form-label custom-label">Potencia (W):</label>
                        </div>
                        <div class="col">
                            <input type="number" step="any" class="form-control form-control-sm custom-input" id="potencia" name="potencia" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="frecuencia" class="form-label custom-label">Frecuencia (MHz):</label>
                        </div>
                        <div class="col">
                            <input type="number" step="any" class="form-control form-control-sm custom-input" id="frecuencia" name="frecuencia" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipoTabla" class="form-label custom-label">Selecciona la tabla correspondiente:</label>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm custom-input" id="tipoTabla" name="tipoTabla">
                                <option value="1">Exposicion del Publico en General</option>
                                <option value="2">Exposicion Ocupacional</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipoPotencia" class="form-label custom-label">Tipo de Potencia(PIRE - PIR):</label>
                        </div>
                        <div class="col">
                            <select class="form-control form-control-sm custom-input" id="tipoPotencia" name="tipoPotencia">
                                <option value="pir">PIR</option>
                                <option value="pire">PIRE</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" value="Calcular r" class="custom-button"  onclick="mostrarResultadoR()">
                </div>
            </form>
        </div>
        
        <div class="col-md-6">
            <form class="form-group" id="calcularDyAForm">
                <div class="card-rounded">
                    <h5 class="card-title">Cálculo de distancias horizontales y verticales</h5>
                    <p>Ingresa los siguientes datos:</p>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="distanciaR" class="form-label custom-label">Distancia desde la antena (r) (metros):</label>
                        </div>
                        <div class="col">
                            <input type="number" step="any" class="form-control form-control-sm custom-input" id="distanciaR" name="distanciaR" required>
                        </div>
                    </div>

                  

                    <input type="submit" value="Calcular d" class="custom-button" onclick="mostrarResultado()">
                </div>
            </form>
        </div>
    </div>
    
    <!-- Resultado -->
    <div class="row mt-2" style="clear: both;display: none; " id="resultado">
        <div class="col-md-6" id="resultadoContenido"></div>
    </div>
    <div class="row mt-2" style="clear: both; display: none;" id="resultadoDA">
        <div class="col-md-6" id="resultadoContenido"></div>
    </div>
   
 <div id="triangulo" class="triangulo">
 <h2 class="titulo-grafico">Gráfico</h2>
<div id="a">d</div>
<div id="b">a</div>
<div id="r">r</div>
<img src="hombre.png" alt="Imagen en la punta del triángulo">
</div>




<div class="container">
    
      <div class="row justify-content-end mt-5">
        <div class="col-md-6">
          <!-- Tarjeta de información -->
          <div class="card card-custom3">
            <div class="card-header">
              <h5 class="card-title">Información Adicional</h5>
            </div>
            <div class="card-body">
              <ul>
              <ul>
               <li><small class="form-text text-muted justify-text">d: Mínima distancia horizontal a la estructura de soporte de la antena o sistema irradiante, en metros.</small></li>
                <li><small class="form-text text-muted justify-text">r: Mínima distancia a la antena o sistema irradiante, en metros.</small></li>
                 <li><small class="form-text text-muted justify-text">a: Distancia vertical desde la altura de una persona a la antena o sistema irradiante, para estandarizar se define en 2 metros.</small></li>
                 <div id="equation">
                 \[ d = \sqrt{r^2 - a^2} \]
              </div>
              </ul>
              <style>
                .justify-text {
                 text-align: justify;
                 }
                  </style>
              </ul>
            </div>
          </div>
        </div>
    </div>
</div>




<script>
    document.getElementById('calcularRForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var potencia = parseFloat(document.getElementById('potencia').value);
        var frecuencia = parseFloat(document.getElementById('frecuencia').value);
        var tipoTabla = parseInt(document.getElementById('tipoTabla').value);
        var tipoPotencia = document.getElementById('tipoPotencia').value;

        var r = 0;

        if (frecuencia >= 30 && frecuencia <= 300000) {
            if (tipoTabla === 1) { // Tabla 1
                if (tipoPotencia === 'pir') {
                    if (frecuencia >= 30 && frecuencia <= 400) {
                        r = 0.319 * Math.sqrt(potencia);
                    } else if (frecuencia > 400 && frecuencia <= 2000) {
                        r = 6.38 * Math.sqrt(potencia / frecuencia);
                    } else if (frecuencia > 2000 && frecuencia <= 300000) {
                        r = 0.143 * Math.sqrt(potencia);
                    }
                } else if (tipoPotencia === 'pire') {
                    if (frecuencia >= 30 && frecuencia <= 400) {
                        r = 0.409 * Math.sqrt(potencia);
                    } else if (frecuencia > 400 && frecuencia <= 2000) {
                        r = 8.16 * Math.sqrt(potencia / frecuencia);
                    } else if (frecuencia > 2000 && frecuencia <= 300000) {
                        r = 0.184 * Math.sqrt(potencia);
                    }
                }
            } else if (tipoTabla === 2) { // Tabla 2
                if (tipoPotencia === 'pir') {
                    if (frecuencia >= 30 && frecuencia <= 400) {
                        r = 0.143 * Math.sqrt(potencia);
                    } else if (frecuencia > 400 && frecuencia <= 2000) {
                        r = 2.92 * Math.sqrt(potencia / frecuencia);
                    } else if (frecuencia > 2000 && frecuencia <= 300000) {
                        r = 0.0638 * Math.sqrt(potencia);
                    }
                } else if (tipoPotencia === 'pire') {
                    if (frecuencia >= 30 && frecuencia <= 400) {
                        r = 0.184 * Math.sqrt(potencia);
                    } else if (frecuencia > 400 && frecuencia <= 2000) {
                        r = 3.74 * Math.sqrt(potencia / frecuencia);
                    } else if (frecuencia > 2000 && frecuencia <= 300000) {
                        r = 0.0819 * Math.sqrt(potencia);
                    }
                }
            }

            document.getElementById('resultado').innerHTML = 'La distancia mínima desde la antena es: r=' + r.toFixed(2) + ' metros.';

            // Agregar condición para determinar si la estación es normalmente conforme
            if (document.getElementById('alturaAntena') && parseFloat(document.getElementById('alturaAntena').value) >= r) {
                document.getElementById('resultado').innerHTML += "<br>La estación es normalmente conforme ya que 'a' es mayor o igual que 'r', por lo tanto no es necesario calcular 'd'.";
            }
        } else {
            document.getElementById('resultado').innerHTML = 'La frecuencia ingresada está fuera del rango permitido (30 MHz - 300 GHz)';
        }
    });

    // JavaScript para calcular d y a
    document.getElementById('calcularDyAForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var r = parseFloat(document.getElementById('distanciaR').value);
        var alturaAntena = 2;
        
        if (isNaN(r) || isNaN(alturaAntena) || r < 0 || alturaAntena < 0) {
            alert("Por favor ingrese valores válidos para 'r'");
            return;
        }

        var d = Math.sqrt(Math.pow(r, 2) - Math.pow(alturaAntena, 2));
        var a = alturaAntena - 2; // Considerando que la altura de una persona es de 2 metros

        if (isNaN(d) || isNaN(a) || d < 0 || a < 0) {
            document.getElementById('resultadoDA').innerHTML = 'No es posible calcular la distancia horizontal debido a que la altura de la antena supera la distancia desde la antena.';
            return;
        }

        // Agregar condiciones para determinar si la estación es normalmente conforme
        if (a >= r && d >= r) {
            document.getElementById('resultadoDA').innerHTML = 'La estación es normalmente conforme ya que no hay acceso de personas a una distancia menor a r y d.';
        } else if (a >= r && isNaN(d)) {
            document.getElementById('resultadoDA').innerHTML = "La estación es normalmente conforme ya que 'a' es mayor que 'r', por lo tanto no es posible calcular 'd'.";
        } else {
            document.getElementById('resultadoDA').innerHTML = 'La distancia horizontal (d) es: ' + d.toFixed(2) + ' metros ';
        }
    });

    function mostrarResultado() {
    var resultadoDiv = document.getElementById("resultadoDA");
    resultadoDiv.style.display = "block";
}
    function mostrarResultadoR(){
    var resultadoDiv = document.getElementById("resultado");
    resultadoDiv.style.display = "block";
    }
</script>

</body>
</html>







