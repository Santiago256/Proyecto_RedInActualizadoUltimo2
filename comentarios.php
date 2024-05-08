<?php 
ob_start();
   session_start();
  include("conexionBD.php");

   // Verificar si el usuario no está autenticado
if (!isset($_SESSION['username'])) {
    // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: index.php");
    exit();
}
    $isUserLoggedIn = isset($_SESSION['username']);
   date_default_timezone_set('America/Bogota'); // Establecer la zona horaria a Bogotá

   // Verificar si el usuario ha iniciado sesión
   if(isset($_SESSION['username'])) {

       // Si el usuario ha iniciado sesión, establecer el nombre de usuario en una variable
       $username = $_SESSION['username'];
// Obtener el id del usuario desde la sesión o desde la base de datos
    $query_usuario = "SELECT id FROM usuario WHERE BINARY username = '$username'";
    $result_usuario = mysqli_query($conn, $query_usuario);
    $row_usuario = mysqli_fetch_assoc($result_usuario);
    $usuario_id = $row_usuario['id'];
   } else {
       // Si el usuario no ha iniciado sesión, establecer un valor predeterminado o manejarlo según sea necesario
       $username = "Anónimo";
   }
   $horaActual = date('Y-m-d H:i:s');
  // Procesar el envío del formulario
if(isset($_POST['enviar'])) {
    $mensaje = trim($_POST['mensaje']); // Eliminar espacios en blanco al inicio y al final
    if(!empty($mensaje)) {
        // Insertar el comentario en la base de datos
        $query = "INSERT INTO comentarios (usuario_id, mensaje) VALUES ('$usuario_id', '$mensaje')";
        mysqli_query($conn, $query);
    } else {
        // Si el comentario está vacío, puedes mostrar un mensaje de error o simplemente ignorarlo
        echo "El comentario está vacío. Por favor ingrese un comentario válido.";
    }
}
// Obtener los comentarios de la base de datos con el nombre de usuario
$query = "SELECT comentarios.id, usuario.username, comentarios.mensaje, comentarios.fecha 
          FROM comentarios 
          INNER JOIN usuario ON comentarios.usuario_id = usuario.id 
          ORDER BY comentarios.fecha DESC";
$result = mysqli_query($conn, $query);
$comentarios = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Redes Inalámbricas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="menu.css?v=<?php echo filemtime('menu.css'); ?>">
    <style>
     
        * {
    margin: 0;
    padding: 0;
    }



.container {
    background: #fff;
    padding: 20px;
    font-family: monospace;
    width: 90%; /* Anchura del contenedor al 90% del ancho de la página */
     max-width: 900px; /* Máximo ancho del contenedor */
    box-shadow: 0 0 5px #000;
    margin-top: 50px ;
    margin-left: auto; /* Mover el contenedor a la derecha */
     margin-right: auto; 

}

.head {
    text-transform: uppercase;
    margin-bottom: 20px;
}

.text {
    margin: 10px 0;
    font-family: sans-serif;
    font-size: 0.9em;
}

.commentbox {
    display: flex;
    justify-content: space-around;
    padding: 10px;
}

.commentbox > img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    /* float: left; */
    margin-right: 20px;
    object-fit: cover;
    object-position: center;
}

.content {
    width: 100%;
}

.user {
    border: none;
    outline: none;
    margin: 5px 0;
    color: #808080;
    margin-left: 20px;
    padding: 10px;
}

.commentinput > input {
    border: none;
    padding: 10px;
    padding-left: 0;
    outline: none;
    border-bottom: 2px solid blue;
    margin-bottom: 10px;
    width: 95%;
}

.buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #808080;
}

.buttons > button {
    padding: 5px 10px;
    background: lightgrey;
    color: #808080;
    text-transform: uppercase;
    border: none;
    outline: none;
    border-radius: 3px;
    cursor: pointer;
}

.buttons > button.abled {
    background: blue;
    color: #fff;
}

.policy {
    margin: 20px 0;
    font-size: 0.8em;
    font-family: Arial, sans-serif;
    color: #808080;
}

.policy a {
    text-decoration: none;
    color: blue;
}

.notify {
    margin-right: 10px;
    display: flex;
    align-items: center;
}

.notify > input {
    margin-right: 5px;
    border: 2px solid #808080;
}

.parents {
    font-family: Arial, sans-serif;
    display: flex;
    margin-bottom: 30px;
}

.parents h1 {
    font-size: 0.9em;
}

.parents p {
    margin: 10px 0;
    font-size: 0.9em;
}

.parents > img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
    object-position: center;
}

.engagements {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.engagements img {
    width: 20px;

}

.engagements img:nth-child(1) {
    margin-right: 10px;
    width: 25px;
}

.date {
    color: #808080;
    font-size: 0.8em;
}

.eliminar-btn {
        background-color: #ff0000; /* Color de fondo */
        color: #fff; /* Color del texto */
        border: none; /* Sin borde */
        padding: 5px 10px; /* Espacio alrededor del texto */
        border-radius: 5px; /* Bordes redondeados */
        cursor: pointer; /* Cursor tipo puntero */
    }

    .eliminar-btn:hover {
        background-color: #cc0000; /* Cambiar color de fondo al pasar el ratón */
    }
    .comment-actions {
        margin-left: 10px;
    }

    .comment-content {
    flex: 1;
}
.comment {
    border: 1px solid #ccc;
    margin-bottom: 10px;
    padding: 10px;
    display: flex;
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
        <li class="menu_item">
            <form action="CerrarSesion.php" method="post">
                <a href="CerrarSesion.php" class="menu_item-link">Cerrar sesión </a>
             </form>
        </li>
    </ul>
</nav>

<div class="container">
    <div class="head"><h1>Publica un comentario</h1></div>
    <div><span id="comment">0</span> Comentarios</div>
    <div class="text"><p>Tus comentarios son importantes para nosotros</p></div>
    <div class="comments">
    <?php foreach ($comentarios as $comentario) : ?>
    <?php if (!empty($comentario['mensaje'])) : ?>
        <div class="comment" id="comment_<?php echo $comentario['id']; ?>">
        <div class="comment-content">
            <h4>Usuario: <?php echo $comentario['username']; ?></h4>
            <p>Mensaje: <?php echo $comentario['mensaje']; ?></p>
            <p>Fecha y hora: <?php echo $comentario['fecha']; ?></p>
        </div>
            <div class="comment-actions">
            <?php 
            // Verificar si el comentario pertenece al usuario logeado actualmente
            if ($comentario['username'] == $username) {
                // Si es así, mostrar el botón "Eliminar"
                echo '<button class="eliminar-btn" onclick="eliminarComentario(' . $comentario['id'] . ')">Eliminar</button>';
            }
            ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

    </div>

    <!-- Formulario para enviar comentarios -->
    <form method="post" onsubmit="return validarComentario()">
        <div class="commentbox">
            <img src="user-solid.svg" alt="">
            <div class="content">
                <h2>Usuario: <label class="user"><?php echo $username; ?></label></h2>
                <div class="commentinput">
                <input type="text"name="mensaje" placeholder="Ingrese un comentario" class="usercomment" oninput="habilitarBoton()">
                    <div class="buttons">
                        <button type="submit" name="enviar"  disabled id="publish">Publicar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>


function eliminarComentario(idComentario) {
    if (confirm("¿Estás seguro de que deseas eliminar este comentario?")) {
        $.ajax({
            type: "POST",
            url: "eliminarcomentario.php",
            data: { id: idComentario },
            success: function(response) {
                // Verificar si la respuesta indica que el comentario se eliminó correctamente
                if (response.trim() === "success") {
                    // Mostrar mensaje de éxito
                    alert("Comentario eliminado correctamente");
                         // Eliminar el comentario de la interfaz de usuario
                         $("#comment_" + idComentario).remove();
                    // Recargar la página
                    window.location.reload();
                } else {
                    // Mostrar mensaje de error
                    alert("Hubo un error al intentar eliminar el comentario RESPUESTA DEL SERVIDOR: " + response);
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                // Mostrar mensaje de error
                alert("Hubo un error al intentar eliminar el comentario error final: " + error);
                window.location.reload();
            }
        });
    }
}



function validarComentario() {
    var comentario = document.querySelector('.usercomment').value.trim();
    if (comentario === '') {
        var alerta = alert('Por favor, ingrese un comentario.');
        setTimeout(function() {
            alerta.close(); // Cierra la alerta después de 3 segundos (3000 milisegundos)
        }, 5000);
        return false; // Evita que se envíe el formulario si el comentario está vacío
    }
    return true; // Permite enviar el formulario si el comentario no está vacío
}

</script>
<script>


const horaACtual = "<?php echo $horaActual; ?>";

const USERID = {
name: null,
identity: null,
image: null,
message: null,
date: null
}

const userComment = document.querySelector(".usercomment");
const publishBtn = document.querySelector("#publish");
const comments = document.querySelector(".comments");
const userName = document.querySelector(".user");
const notify = document.querySelector(".notifyinput");

userComment.addEventListener("input", e => {
    if(!userComment.value) {
        publishBtn.setAttribute("disabled", "disabled");
        publishBtn.classList.remove("abled")
    }else {
        publishBtn.removeAttribute("disabled");
        publishBtn.classList.add("abled")
    }
})

function addPost() {
    if(!userComment.value) return;
    // Obtener el nombre de usuario del PHP directamente
    publishBtn.classList.remove("abled"); 
        USERID.name = "<?php echo $username; ?>";
    if(USERID.name === "Anonimo") {
        USERID.identity = false;
        USERID.image = "anonimo.png"
    }else {
        USERID.identity = true;
        USERID.image = "user-solid.svg"
    }

    USERID.message = userComment.value;
    USERID.date = horaACtual; // Utilizar la hora del servidor PHP colombia
    let published = 
    `<div class="parents">
        <img src="${USERID.image}">
        <div>
            <h1>${USERID.name}</h1>
            <p>${USERID.message}</p>
            <div class="engagements"><img src="share.png" alt=""></div>
            <span class="date">${USERID.date}</span>
        </div>    
    </div>`

    comments.innerHTML += published;
   // userComment.value = "";
    publishBtn.classList.remove("abled")



}

publishBtn.addEventListener("click", addPost);

</script>
<script>
    function habilitarBoton() {
        var comentario = document.querySelector('.usercomment').value.trim();
        var boton = document.getElementById('publish');
        if (comentario !== '') {
            boton.removeAttribute('disabled');
        } else {
            boton.setAttribute('disabled', 'disabled');
        }
    }

    function contarComentarios() {
            let numComments = document.querySelectorAll('.comment').length;
            document.getElementById('comment').textContent = numComments;
        }
        window.onload = contarComentarios;
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
