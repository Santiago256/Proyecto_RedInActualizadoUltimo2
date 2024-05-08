<?php
include("conexionBD.php");

// Paso 2: Recibir el ID del comentario a eliminar
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    $idComentario = $_POST['id'];

    // Paso 3: Ejecutar la consulta SQL para eliminar el comentario
    $query = "DELETE FROM comentarios WHERE id = $idComentario";
    $result = $conn->query($query);

    // Paso 4: Manejar cualquier error que pueda ocurrir durante el proceso
    if($result) {
        // Comentario eliminado correctamente
        echo "success";
    } else {
        // Error al eliminar el comentario
        echo "Error al intentar eliminar el comentario: " . $conn->error;
    }
} else {
    // ID de comentario no válido
    echo "ID de comentario no válido";
}

// Cerrar la conexión
$conn->close();
?>
