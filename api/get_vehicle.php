<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario predeterminado de XAMPP para MySQL
$password = ""; // Contraseña predeterminada de XAMPP para MySQL (vacío)
$dbname = "autobahn"; // Nombre de la base de datos
$host = 'localhost:3316'; // URL del servicio MySQL en XAMPP

// Establecer cabecera para JSON
header('Content-Type: application/json');

try {
    // Crear la conexión
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validar que se reciba el parámetro "id"
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo json_encode(['error' => 'Parámetro "id" faltante o vacío']);
        exit;
    }

    // Sanitizar el parámetro recibido
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        echo json_encode(['error' => 'El parámetro "id" debe ser un número válido']);
        exit;
    }

    // Consultar la base de datos
    $query = "SELECT * FROM inventario WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Devolver el resultado en formato JSON
        echo json_encode($result);
    } else {
        // Si no se encuentra, devolver un mensaje de error
        echo json_encode(['error' => 'No se encontró ningún vehículo con el ID proporcionado.']);
    }
} catch (PDOException $e) {
    // Manejar errores de conexión o consulta
    echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
}