<?php
// ============================================
// CONFIGURACIÓN GENERAL
// ============================================

// ← CAMBIA esto por tu número de WhatsApp (código de país + número, sin +)
define('WHATSAPP_NUMERO', '593990000000');
define('WHATSAPP_LINK', 'https://wa.me/' . WHATSAPP_NUMERO);

// ← Datos de conexión a la base de datos
// En XAMPP local: usuario 'root', contraseña vacía.
// En InfinityFree u otro hosting: usa los datos que te da el panel.
$DB_HOST = 'localhost';
$DB_NAME = 'tienda_natural';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}

// Escapa texto para evitar problemas de seguridad (XSS)
function e(?string $s): string {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

// Formatea precios
function precio(float $n): string {
    return '$' . number_format($n, 2);
}
