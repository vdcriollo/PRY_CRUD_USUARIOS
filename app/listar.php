<?php 

// conexion a base de datos con conexion/db.php
require_once '../conexion/db.php';
// consultar los usuarios de la base de datos
$sql = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        LISTA DE USUARIOS
    </title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
        <!-- crear tabla para listar usuario -->
        <h1 class="text-center mb-4">Lista de Usuarios</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>


                <?php foreach ($usuarios as $user): ?>

                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['nombre']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm">Editar</a>
                            <a href="" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    
                <?php endforeach; ?>



            </tbody>

        </table>
           
    </div>
</body>
</html>