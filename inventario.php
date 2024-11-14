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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
   $marca = $_POST['marca'];
   $modelo = $_POST['modelo'];
   $año = $_POST['año'];
   $precio = $_POST['precio'];
   $estado =  strtolower($_POST['estado']);
   $disponibilidad =  strtolower($_POST['disponibilidad']);

   $sql = "INSERT INTO inventario (marca, modelo, año, precio, estado, disponibilidad)
           VALUES ('$marca', '$modelo', '$año', '$precio', '$estado', '$disponibilidad')";

   if ($db->query($sql) === TRUE) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Vehículo agregado con éxito!
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
            <input type="hidden" name="add" value="1">
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

            <button type="submit" class="btn btn-gold w-auto px-4 mb-4 mx-auto d-block">Añadir vehículo</button>
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
                               <button class='btn btn-gold btn-sm'>Editar</button>
                               <button class='btn btn-danger btn-sm'>Eliminar</button>
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

// Update the toggleForm function to reset the form when hiding
function toggleForm() {
    const formContainer = document.getElementById("addForm");
    const toggleButton = document.getElementById("toggleButton");
    
    if (formContainer.classList.contains("d-none")) {
        formContainer.classList.remove("d-none");
        toggleButton.textContent = "Cancelar";
    } else {
        formContainer.classList.add("d-none");
        toggleButton.textContent = "Añadir vehículo";
        // Reset the form
        formContainer.querySelector('form').reset();
    }
}
   </script>
</body>

</html>