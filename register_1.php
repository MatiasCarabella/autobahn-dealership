<?php
// Inicia la sesión
session_start();

// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Almacena el nombre en la sesión
    $_SESSION['nombre'] = $_POST['nombre'];
    // Redirige a register_2.php
    header('Location: register_2.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Autobahn</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2C2C2C;
            color: #F5F5F5;
        }
        .form-container {
            margin-top: 100px;
        }
        .card {
            background-color: #1F1F1F;
            border: none;
        }
        .btn-gold {
            background-color: #CBA135;
            color: #000;
            font-weight: bold;
        }
        .btn-gold:hover {
            background-color: #FFD700;
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
    </style>
</head>
<body>
    <div class="container form-container d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Autobahn</h1>
                    <h4 class="card-title text-center mb-4">Registro</h4>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese su nombre">
                        </div>
                        <button type="submit" class="btn btn-gold w-100">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
