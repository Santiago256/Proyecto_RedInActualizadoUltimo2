<?php 
    $servername = "localhost";
    $username = "id22010039_santi";
    $password = "Kronox94%";
    $db_name = "id22010039_bd";  
    $conn = new mysqli($servername, $username, $password, $db_name);
    if($conn->connect_error){
        die("Conexión fallo".$conn->connect_error);
    }
    //echo "Conexión exitosa";
    
    ?>