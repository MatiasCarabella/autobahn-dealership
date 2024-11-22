<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario predeterminado de XAMPP para MySQL
$password = ""; // Contraseña predeterminada de XAMPP para MySQL (vacío)
$dbname = "autobahn"; // Nombre de la base de datos
$port = 3316; // Puerto del servicio MySQL en XAMPP

// Crear la conexión con la base de datos
$db = new mysqli($servername, $username, $password, $dbname, $port);

// Validar que la conexión haya sido exitosa
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

// Manejar el envío del formulario (crear, actualizar o eliminar registros)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $disponibilidad = $_POST['disponibilidad'];

    // Determinar la acción solicitada por el usuario
    if ($_POST['action'] == 'add') { // Agregar un nuevo vehículo
        $sql = "INSERT INTO inventario (marca, modelo, año, precio, estado, disponibilidad)
                VALUES ('$marca', '$modelo', '$año', '$precio', '$estado', '$disponibilidad')";
        $successMessage = "Vehículo agregado con éxito!";
    } elseif ($_POST['action'] == 'delete') { // Eliminar un vehículo
        $id = $_POST['vehicleId'];
        $sql = "DELETE FROM inventario WHERE id = $id";
        $successMessage = "Vehículo eliminado con éxito!";
    } else { // Actualizar un vehículo existente
        $id = $_POST['vehicleId'];
        $sql = "UPDATE inventario 
                SET marca='$marca', modelo='$modelo', año='$año', 
                    precio='$precio', estado='$estado', disponibilidad='$disponibilidad'
                WHERE id=$id";
        $successMessage = "Vehículo actualizado con éxito!";
    }

    // Ejecutar la consulta y manejar el resultado
    if ($db->query($sql) === TRUE) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 $successMessage
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>";
        // Ocultar el formulario después de la operación exitosa
        echo "<script>document.getElementById('addForm').classList.add('d-none');
                       document.getElementById('toggleButton').textContent = 'Añadir vehículo';</script>";
    } else {
        // Mostrar mensaje de error si la consulta falla
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 Error: " . $db->error . "
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
               </div>";
    }
}

// Consultar todos los registros existentes en la tabla 'inventario'
$sql = "SELECT * FROM inventario";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Autobahn</title>
    <!-- Enlace al CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #2C2C2C;
            color: #F5F5F5;
        }

        .navbar {
            background-color: #222;
        }

        .navbar-brand,
        .nav-link {
            color: #CBA135 !important;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #FFD700 !important;
        }

        .table-container {
            margin-top: 50px;
        }

        .table-dark {
            background-color: #3C3C3C;
        }

        .btn-gold {
            background-color: #CBA135;
            color: #000;
        }

        .btn-gold:hover {
            background-color: #FFD700;
        }

        .btn-danger {
            background-color: #bb2d3b;
        }

        .btn-danger:hover {
            background-color: #dc3545;
        }

        .form-container {
            margin-top: 30px;
        }

        .form-control {
            background-color: #3C3C3C;
            color: #F5F5F5;
            border: none;
        }

        .form-control:focus {
            background-color: #3C3C3C;
            color: #F5F5F5;
            border-color: #CBA135;
            box-shadow: none;
        }

        .form-select {
            background-color: #3C3C3C;
            color: #F5F5F5;
            border: none;
        }

        .form-select:focus {
            background-color: #3C3C3C;
            color: #F5F5F5;
            border-color: #CBA135;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Autobahn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="catalog.html">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="inventory.php">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="test_drive.html">Test Drive</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container table-container">
        <h1 class="text-center mb-4">Inventario</h1>

        <!-- Botón para mostrar/ocultar el formulario -->
        <div class="d-flex justify-content-center mb-4">
            <button id="toggleButton" class="btn btn-gold" onclick="toggleForm()">Añadir vehículo</button>
        </div>

        <!-- Formulario para agregar/editar vehículos -->
        <div class="form-container d-none" id="addForm">
            <form method="POST" action="inventory.php">
                <input type="hidden" name="action" value="add" id="formAction">
                <input type="hidden" name="vehicleId" id="vehicleId">
                <!-- Campos del formulario -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" required>
                    </div>
                    <div class="col-md-4">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" required>
                    </div>
                    <div class="col-md-4">
                        <label for="año" class="form-label">Año</label>
                        <input type="number" class="form-control" id="año" name="año" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="precio" class="form-label">Precio (USD)</label>
                        <input type="text" class="form-control" id="precio" name="precio" required>
                    </div>
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="nuevo">Nuevo</option>
                            <option value="usado">Usado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="disponibilidad" class="form-label">Disponibilidad</label>
                        <select class="form-control" id="disponibilidad" name="disponibilidad" required>
                            <option value="disponible">Disponible</option>
                            <option value="no disponible">No disponible</option>
                        </select>
                    </div>
                </div>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn btn-gold px-4">Guardar</button>
            </form>
        </div>

        <!-- Tabla para mostrar los vehículos existentes -->
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Precio (USD)</th>
                    <th>Estado</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['marca'] ?></td>
                            <td><?= $row['modelo'] ?></td>
                            <td><?= $row['año'] ?></td>
                            <td>$ <?= $row['precio'] ?></td>
                            <td><?= $row['estado'] ?></td>
                            <td><?= $row['disponibilidad'] ?></td>
                            <td>
                                <button class="btn btn-gold btn-sm" onclick="editVehicle(<?= htmlspecialchars(json_encode($row)) ?>)">Editar</button>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="vehicleId" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay vehículos en el inventario</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts de JavaScript -->
    <script>
        // Función para alternar la visibilidad del formulario
        function toggleForm() {
            const form = document.getElementById('addForm');
            const button = document.getElementById('toggleButton');
            if (form.classList.contains('d-none')) {
                form.classList.remove('d-none');
                button.textContent = 'Cancelar';
            } else {
                form.classList.add('d-none');
                button.textContent = 'Añadir vehículo';
            }
        }

        // Función para editar un vehículo
        function editVehicle(vehicle) {
            document.getElementById('formAction').value = 'update';
            document.getElementById('vehicleId').value = vehicle.id;
            document.getElementById('marca').value = vehicle.marca;
            document.getElementById('modelo').value = vehicle.modelo;
            document.getElementById('año').value = vehicle.año;
            document.getElementById('precio').value = vehicle.precio;
            document.getElementById('estado').value = vehicle.estado;
            document.getElementById('disponibilidad').value = vehicle.disponibilidad;

            // Mostrar el formulario en modo edición
            toggleForm();
        }
    </script>

    <!-- Enlace a los scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
