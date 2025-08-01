<?php 

// recibir datos por json
$request =  json_decode(file_get_contents("php://input"), true);

// imprimir datos recibidos
echo json_encode("DATOS RECIBIDOS: ");


?>