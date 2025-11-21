<?php
// backend/src/db/import_products.php

// Debug de errores (puedes quitarlo cuando funcione)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// 1. Seguridad: Solo usuarios logueados
if (empty($_SESSION['user_id'])) {
    header('Location: ../../../frontend/templates/login.php');
    exit;
}

// 2. Carga de librería Excel (OBLIGATORIO)
// Si esta línea falla, es que no has hecho 'composer install' en la carpeta backend
$autoloadPath = __DIR__ . '/../../vendor/autoload.php';

if (!file_exists($autoloadPath)) {
    die("<h1>Error:</h1><p>No se encuentra la carpeta <code>vendor</code>. Tienes que entrar en la carpeta <code>backend</code> y ejecutar el comando <code>composer install</code> para poder leer Excels.</p>");
}

require_once $autoloadPath;
use PhpOffice\PhpSpreadsheet\IOFactory;

// 3. Rutas de archivos
$excelPath = __DIR__ . '/../../../uploads/productes.xlsx';
$jsonPath  = __DIR__ . '/../../../data/db.json';

// Verificar que existe el Excel
if (!file_exists($excelPath)) {
    $_SESSION['error_import'] = "Error: No se encuentra el archivo uploads/productes.xlsx";
    header('Location: ../../../frontend/templates/profile.php');
    exit;
}

try {
    // 4. Leer el Excel
    $spreadsheet = IOFactory::load($excelPath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Extraer encabezados (primera fila) y normalizarlos a minúsculas
    $headers = array_map('strtolower', array_map('trim', array_shift($rows)));

    $newProducts = [];

    // 5. Procesar filas
    foreach ($rows as $row) {
        // Ignorar filas que no tengan el mismo número de columnas que el encabezado
        if (count($row) !== count($headers)) continue;

        // Combinar encabezados con valores
        $item = array_combine($headers, $row);

        // Validación básica: Si no tiene ID, lo saltamos
        if (empty($item['id'])) continue;

        // Aseguramos tipos de datos correctos para el JSON
        // (El Excel a veces devuelve números como strings)
        $item['id'] = (int)$item['id']; 
        if (isset($item['estoc'])) $item['estoc'] = (int)$item['estoc'];
        // if (isset($item['preu'])) $item['preu'] = (float)$item['preu']; // Opcional si lo quieres numérico

        $newProducts[] = $item;
    }

    // 6. Leer el JSON actual (para no borrar los usuarios)
    if (file_exists($jsonPath)) {
        $currentData = json_decode(file_get_contents($jsonPath), true);
    } else {
        $currentData = [];
    }

    // Si el JSON estaba vacío o corrupto, inicializamos estructura
    if (!is_array($currentData)) {
        $currentData = ['products' => [], 'users' => []]; // O 'usuaris'
    }

    // 7. Reemplazar SOLO los productos
    $currentData['products'] = $newProducts;

    // 8. Guardar cambios en db.json
    // JSON_PRETTY_PRINT para que sea legible, UNESCAPED_UNICODE para tildes
    file_put_contents($jsonPath, json_encode($currentData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $_SESSION['success_import'] = "✅ Productos importados del Excel al JSON correctamente.";

} catch (Exception $e) {
    $_SESSION['error_import'] = "Error al procesar: " . $e->getMessage();
}

// Volver al perfil
header('Location: ../../../frontend/templates/profile.php');
exit;