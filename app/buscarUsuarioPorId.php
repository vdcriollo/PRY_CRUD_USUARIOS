<?php 

    require_once '../conexion/db.php';
    // recibir datos por json
    $request =  json_decode(file_get_contents("php://input"), true);

    $id= $request['id'];

    // prepara mi query
    $consulta = "SELECT * FROM usuarios WHERE id = :id";
    // ejecutar la consulta
    $stmt = $pdo->prepare($consulta);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    // obtener el resultado
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // imprimir datos recibidos
    echo json_encode($usuario);


?>