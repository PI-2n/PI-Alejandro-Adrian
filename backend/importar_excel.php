<?php
require __DIR__ . '/vendor/autoload.php'; // Composer autoload

use PhpOffice\PhpSpreadsheet\IOFactory;

// Configuración MySQL (opcional: se usa solo si quieres respaldo temporal)
$host = 'db';
$dbname = 'pi_db';
$user = 'pi_user';
$pass = 'pi_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tabla si no existe (opcional)
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
    die("❌ Error de conexión a la base de datos: " . $e->getMessage());
}

// Ruta al archivo Excel
$excelPath = __DIR__ . '/../uploads/productes.xlsx';

if (!file_exists($excelPath)) {
    die("❌ Archivo Excel no encontrado en uploads/productes.xlsx\n");
}

// Cargar Excel
$spreadsheet = IOFactory::load($excelPath);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();

// Primera fila: encabezados
$headers = array_map('strtolower', array_map('trim', array_shift($rows)));

// Preparar SQL dinámico
$columns = implode(',', $headers);
$placeholders = ':' . implode(',:', $headers);
$sql = "INSERT IGNORE INTO products ($columns) VALUES ($placeholders)";
$stmt = $pdo->prepare($sql);

// Insertar filas válidas
foreach ($rows as $row) {
    if (count($row) !== count($headers)) {
        continue;
    }

    $data = array_combine($headers, $row);

    if (empty($data['id'])) {
        continue;
    }

    $stmt->execute($data);
}

// Obtener datos finales desde la base
$jsonData = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);

// 📂 Ruta al archivo db.json
$dbFile = __DIR__ . '/../data/db.json';

// Si no existe, crear estructura básica
if (!file_exists($dbFile)) {
    $dbContent = ['products' => [], 'usuaris' => []];
} else {
    $dbContent = json_decode(file_get_contents($dbFile), true);
    if ($dbContent === null) {
        $dbContent = ['products' => [], 'usuaris' => []];
    }
}

// Actualizar solo la sección de products
$dbContent['products'] = $jsonData;

// Guardar de nuevo db.json
file_put_contents($dbFile, json_encode($dbContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "✅ Importación completada correctamente.\n";
echo "📦 Se han actualizado los productos en data/db.json\n";
