<?php
// Configuración de la conexión a la BDD
$servername = "localhost";
$username = "root"; // usuario predeterminada de XAMPP para MySQL
$password = ""; // contraseña predeterminada de XAMPP para MySQL (vacío)
$dbname = "autobahn";
$port = 3316; // Puerto del servicio MySQL en XAMPP

// Crear Conexión
$db = new mysqli($servername, $username, $password, $dbname, $port);

// Validar que la conexión haya sido exitosa
if ($db->connect_error) {
   die("Connection failed: " . $db->connect_error);
}

// Manejar el envío del formulario para agregar un registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $marca = $_POST['marca'];
   $modelo = $_POST['modelo'];
   $año = $_POST['año'];
   $precio = $_POST['precio'];
   $estado = $_POST['estado'];
   $disponibilidad = $_POST['disponibilidad'];

   if ($_POST['action'] == 'add') {
      $sql = "INSERT INTO inventario (marca, modelo, año, precio, estado, disponibilidad)
               VALUES ('$marca', '$modelo', '$año', '$precio', '$estado', '$disponibilidad')";
      $successMessage = "Vehículo agregado con éxito!";
   } elseif ($_POST['action'] == 'delete') {
      $id = $_POST['vehicleId'];
      $sql = "DELETE FROM inventario WHERE id = $id";
      $successMessage = "Vehículo eliminado con éxito!";
   } else {
      $id = $_POST['vehicleId'];
      $sql = "UPDATE inventario 
               SET marca='$marca', modelo='$modelo', año='$año', 
                   precio='$precio', estado='$estado', disponibilidad='$disponibilidad'
               WHERE id=$id";
      $successMessage = "Vehículo actualizado con éxito!";
   }

   if ($db->query($sql) === TRUE) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
               $successMessage
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
             </div>";
      echo "<script>document.getElementById('addForm').classList.add('d-none');
                     document.getElementById('toggleButton').textContent = 'Añadir vehículo';</script>";
   } else {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
               Error: " . $db->error . "
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
             </div>";
   }
}

// Obtener registros de la tabla 'inventario'
$sql = "SELECT * FROM inventario";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inventario - Autobahn</title>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
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
   <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
         <a class="navbar-brand" href="#">Autobahn</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="catalogo.html">Catálogo</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="inventario.php">Inventario</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="testdrive.html">Test Drive</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   <div class="container mt-3">
      <div id="alertContainer"></div>
   </div>
   <div class="container table-container">
      <h1 class="text-center mb-4">Inventario</h1>

      <!-- Botón para agregar registro -->
      <div class="d-flex justify-content-center mb-4">
         <button id="toggleButton" class="btn btn-gold" onclick="toggleForm()">Añadir vehículo</button>
      </div>

      <!-- Formulario para agregar registro -->
      <div class="form-container d-none" id="addForm">
         <form method="POST" action="inventario.php">
            <input type="hidden" name="action" value="add" id="formAction">
            <input type="hidden" name="vehicleId" id="vehicleId">
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
                  <label for="precio" class="form-label">Precio</label>
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

            <button type="submit" class="btn btn-gold px-4 mb-4 mx-auto d-block" id="submitButton">
               Añadir vehículo
            </button>
         </form>
      </div>

      <!-- Tabla con los registros del inventario-->
      <table class="table table-dark table-striped table-hover">
         <thead>
            <tr>
               <th>Marca</th>
               <th>Modelo</th>
               <th>Año</th>
               <th>Precio</th>
               <th>Estado</th>
               <th>Disponibilidad</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            <?php
            // Validar si la query trajo algún resultado
            if ($result->num_rows > 0) {
               // Mostrar cada resultado
               while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['año']) . "</td>";
                  echo "<td>$" . number_format($row['precio'], 2) . "</td>";
                  echo "<td>" . ucfirst(htmlspecialchars($row['estado'])) . "</td>";
                  echo "<td>" . ucfirst(htmlspecialchars($row['disponibilidad'])) . "</td>";
                  echo "<td>
                          <button class='btn btn-gold btn-sm' onclick='editVehicle(this)' 
                              data-id='" . $row['id'] . "'
                              data-marca='" . htmlspecialchars($row['marca']) . "'
                              data-modelo='" . htmlspecialchars($row['modelo']) . "'
                              data-año='" . htmlspecialchars($row['año']) . "'
                              data-precio='" . htmlspecialchars($row['precio']) . "'
                              data-estado='" . htmlspecialchars($row['estado']) . "'
                              data-disponibilidad='" . htmlspecialchars($row['disponibilidad']) . "'>
                              Editar
                          </button>
                          <button class='btn btn-danger btn-sm' onclick='deleteVehicle(" . $row['id'] . ", \"" . htmlspecialchars($row['marca']) . " " . htmlspecialchars($row['modelo']) . "\")'>
                                 Eliminar
                           </button>
                        </td>";
                  echo "</tr>";
               }
            } else {
               echo "<tr><td colspan='7' class='text-center'>No hay vehículos en el inventario</td></tr>";
            }

            // Cerrar la conexión
            $db->close();
            ?>
         </tbody>
      </table>
   </div>
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      // Auto-hide alerts after 5 seconds
      document.addEventListener('DOMContentLoaded', function() {
         // Get all alerts
         const alerts = document.querySelectorAll('.alert');

         alerts.forEach(function(alert) {
            // Add fade out after 5 seconds
            setTimeout(function() {
               const bsAlert = new bootstrap.Alert(alert);
               bsAlert.close();
            }, 5000);
         });
      });

      function editVehicle(button) {
         // Get form elements
         const form = document.getElementById('vehicleForm');
         const formAction = document.getElementById('formAction');
         const vehicleId = document.getElementById('vehicleId');
         const submitButton = document.getElementById('submitButton');
         const toggleButton = document.getElementById('toggleButton');

         // Set form to edit mode
         formAction.value = 'edit';
         vehicleId.value = button.dataset.id;

         // Fill form fields with vehicle data
         document.getElementById('marca').value = button.dataset.marca;
         document.getElementById('modelo').value = button.dataset.modelo;
         document.getElementById('año').value = button.dataset.año;
         document.getElementById('precio').value = button.dataset.precio;
         document.getElementById('estado').value = button.dataset.estado;
         document.getElementById('disponibilidad').value = button.dataset.disponibilidad;

         // Change button text
         submitButton.textContent = 'Actualizar Registro';
         toggleButton.textContent = 'Cancelar';

         // Show form if hidden
         const formContainer = document.getElementById('addForm');
         formContainer.classList.remove('d-none');

         // Scroll to form
         formContainer.scrollIntoView({
            behavior: 'smooth'
         });
      }

      // Update the toggleForm function to handle reset properly
      function toggleForm() {
         const formContainer = document.getElementById('addForm');
         const toggleButton = document.getElementById('toggleButton');
         const submitButton = document.getElementById('submitButton');
         const formAction = document.getElementById('formAction');
         const vehicleId = document.getElementById('vehicleId');

         if (formContainer.classList.contains('d-none')) {
            formContainer.classList.remove('d-none');
            toggleButton.textContent = 'Cancelar';
         } else {
            formContainer.classList.add('d-none');
            toggleButton.textContent = 'Añadir vehículo';
            // Reset the form
            document.getElementById('vehicleForm').reset();
            // Reset to add mode
            formAction.value = 'add';
            vehicleId.value = '';
            submitButton.textContent = 'Agregar Registro';
         }
      }

      function deleteVehicle(id, vehicleInfo) {
         if (confirm(`¿Está seguro que desea eliminar el vehículo ${vehicleInfo}?`)) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'inventario.php';

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'delete';

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'vehicleId';
            idInput.value = id;

            form.appendChild(actionInput);
            form.appendChild(idInput);
            document.body.appendChild(form);
            form.submit();
         }
      }
   </script>
</body>

</html>