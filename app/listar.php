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
        <table class="table table-striped table-bordered" id="tabla-usuarios">
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
                            <button
                                type="button"
                                class="btn btn-primary btn-editar-usuario"
                                data-id="<?php echo $user['id']; ?>"
                            >
                                Editar
                            </button>
                            
                            
                            <a href="" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    
                <?php endforeach; ?>



            </tbody>

        </table>
           
    </div>


    
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Editar Usuario
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="id">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="nombre" 
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        required>
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="edad" 
                        required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-actualizar-usuario">
                    Actualizar
                </button>
            </div>
            </div>
        </div>
    </div>


    <script src="../public/bootstrap/js/bootstrap.min.js"></script>

    <script>

        // llamra a nuestro modal
        const modalEditarUsuario = new bootstrap.Modal(
            document.getElementById('modalEditarUsuario'), {
                keyboard: false
            }
        )
        

        var tablaUsuarios = document.getElementById('tabla-usuarios');
        tablaUsuarios.addEventListener('click', function(event) {
            if(event.target.classList.contains('btn-editar-usuario')) {
               var id = event.target.dataset.id;

                fetch('buscarUsuarioPorId.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                }).then(function(response) {
                    return response.json();
                }).then(function(request) {
                    // mostrar el modal
                    modalEditarUsuario.show();
                    // llenar los campos del modal con los datos del usuario desde el server
                    document.getElementById('id').value = request.id;
                    document.getElementById('nombre').value = request.nombre;
                    document.getElementById('email').value = request.email;
                    document.getElementById('edad').value = request.edad;
                })
            }
        });


        // codifo pra actualizar el usuario
        var btnActualizarUsuario = document.getElementById('btn-actualizar-usuario');
        btnActualizarUsuario.addEventListener('click', function() {
           
            let id = document.getElementById('id').value;
            let nombre = document.getElementById('nombre').value;
            let email = document.getElementById('email').value;
            let edad = document.getElementById('edad').value;


            fetch('actualizarUsuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    { 
                        id: id,
                        nombre: nombre,
                        email: email,
                        edad: edad
                    }
                )
            }).then(function(response) {
                return response.json();
            }).then(function(request) {
                // mostrar el modal
                modalEditarUsuario.hide();
                location.reload();
            })
            

        });

    </script>

    
</body>
</html>