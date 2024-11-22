<?php
// Inicia la sesión
session_start();

// Recupera el nombre desde la sesión
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';

// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<div style='text-align: center; margin-top: 50px;'>";
    echo "<h2>Datos del Registro</h2>";
    
    // Recorre los campos del formulario
    $keys = array_keys($_POST);
    for ($i = 0; $i < count($keys); $i++) {
        $campo = $keys[$i];
        $valor = $_POST[$campo];
        echo ucfirst($campo) . ": " . htmlspecialchars($valor) . "<br>";
    }
    
    echo "</div>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Completo - Autobahn</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2C2C2C;
            color: #F5F5F5;
        }
        .form-container {
            min-height: 80vh;
            margin-top: 10vh;
            margin-bottom: 10vh;
            display: flex;
            justify-content: center;
            align-items: center;
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
        .form-control[readonly] {
            background-color: #3C3C3C;
            color: #F5F5F5;
            opacity: 0.5;
            cursor: default;
        }
    </style>
</head>
<body>
    <div class="container form-container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Autobahn</h1>
                    <h4 class="card-title text-center mb-4">Complete su información</h4>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Ingrese su correo electrónico">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required placeholder="Ingrese su teléfono">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirme su contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-gold w-100">Completar Registro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
