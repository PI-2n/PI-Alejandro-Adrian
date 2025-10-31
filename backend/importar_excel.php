<?php
require __DIR__ . '/vendor/autoload.php'; // Composer autoload

use PhpOffice\PhpSpreadsheet\IOFactory;

// Configuración MySQL
$host = 'db';
$dbname = 'pi_db';
$user = 'pi_user';
$pass = 'pi_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tabla si no existe
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY,
            sku VARCHAR(20) NOT NULL,
            nom VARCHAR(100) NOT NULL,
            descripcio TEXT,
            img VARCHAR(255),
            preu DECIMAL(10,2),
            estoc INT
        );
    ";
    $pdo->exec($createTableSQL);

    // Vaciar tabla antes de importar
    $pdo->exec("TRUNCATE TABLE products");

} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Ruta al archivo Excel
$archivoExcel = __DIR__ . '/../uploads/productes.xlsx';

if (!file_exists($archivoExcel)) {
    die("Archivo Excel no encontrado en uploads/productes.xlsx\n");
}

// Cargar Excel
$spreadsheet = IOFactory::load($archivoExcel);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();

// Primera fila: encabezados
$headers = array_map('strtolower', array_map('trim', array_shift($rows)));

// Preparar SQL dinámico con INSERT IGNORE
$columns = implode(',', $headers);
$placeholders = ':' . implode(',:', $headers);
$sql = "INSERT IGNORE INTO products ($columns) VALUES ($placeholders)";
$stmt = $pdo->prepare($sql);

// Insertar filas válidas
foreach ($rows as $row) {
    if (count($row) !== count($headers)) {
        continue; // Ignorar filas incompletas
    }
    $data = array_combine($headers, $row);

    // Ignorar si el ID está vacío
    if (empty($data['id'])) {
        continue;
    }

    $stmt->execute($data);
}

// Generar JSON para json-server
$jsonData = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0777, true);
}
file_put_contents($dataDir . '/products.json', json_encode(['productes' => $jsonData], JSON_PRETTY_PRINT));

echo "Importación completada correctamente. JSON generado en data/products.json\n";
