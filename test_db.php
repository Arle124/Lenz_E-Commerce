<?php
require_once __DIR__ . "/config/sesion.php";

echo "<h2>Contenido de \$_SESSION:</h2>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
foreach ($_SESSION['usuario']['roles'] as $rol) {
    echo $rol . "<br>";
}
implode(", ", $u['roles']);

 

