<?php
require_once __DIR__ . "/../../config/sesion.php";

echo "<h1>Contenido actual de \$_SESSION</h1>";

if (empty($_SESSION)) {
    echo "<p>La sesión está vacía.</p>";
    exit;
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
