<?php
// backend/src/db/import_products.php
session_start();

// 1. Seguridad: Solo usuarios logueados
if (empty($_SESSION['user_id'])) {
    header('Location: /frontend/templates/tmp_login.php');
    exit;
}

// 2. Carga de librería Excel
$autoloadPath = __DIR__ . '/../../vendor/autoload.php';

if (!file_exists($autoloadPath)) {
    die("<h1>Error:</h1><p>No se encuentra la carpeta vendor.</p>");
}

require_once $autoloadPath;
use PhpOffice\PhpSpreadsheet\IOFactory;

// 3. Rutas de archivos
$excelPath = __DIR__ . '/../../../uploads/productes.xlsx';
$jsonPath  = __DIR__ . '/../../../data/db.json';

// Verificar que existe el Excel
if (!file_exists($excelPath)) {
    $_SESSION['error_import'] = "Error: No se encuentra el archivo uploads/productes.xlsx";
    header('Location: /backend/src/auth/profile.php');
    exit;
}

try {
    // 4. Leer el Excel
    $spreadsheet = IOFactory::load($excelPath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();
    $headers = array_map('strtolower', array_map('trim', array_shift($rows)));
    $newProducts = [];

    // 5. Procesar filas
    foreach ($rows as $row) {
        if (count($row) !== count($headers)) continue;
        $item = array_combine($headers, $row);
        if (empty($item['id'])) continue;
        
        $item['id'] = (int)$item['id']; 
        if (isset($item['estoc'])) $item['estoc'] = (int)$item['estoc'];
        $newProducts[] = $item;
    }

    // 6. Leer y actualizar JSON
    if (file_exists($jsonPath)) {
        $currentData = json_decode(file_get_contents($jsonPath), true);
    } else {
        $currentData = [];
    }
    if (!is_array($currentData)) {
        $currentData = ['products' => [], 'users' => []];
    }

    $currentData['products'] = $newProducts;

    file_put_contents($jsonPath, json_encode($currentData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $_SESSION['success_import'] = "✅ Productos importados correctamente.";

} catch (Exception $e) {
    $_SESSION['error_import'] = "Error al procesar: " . $e->getMessage();
}

// Volver al perfil (usando ruta del controlador)
header('Location: /backend/src/auth/profile.php');
exit;