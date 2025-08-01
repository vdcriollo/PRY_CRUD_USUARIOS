<?php
// conecar a base de datos con conexion/db.php
require_once '../conexion/db.php';

// recibir los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // recbir los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $edad = $_POST['edad'] ?? '';
    
    //  ingresar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES (:nombre, :email, :edad)";
    // enviar varias con binparam para evitar inyeccion sql
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':edad', $edad);
    // ejecutar la consulta
    if ($stmt->execute()) {
        // redirigir a la pagina de listar usuarios
        header('Location: ../index.html');
        exit;
    } else {
        echo "Error al crear el usuario.";
    }
}

?>