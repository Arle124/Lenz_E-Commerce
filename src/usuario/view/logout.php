<?php
require_once "../../../../config/config.php";

session_start();
session_destroy();

// debo revisar despues esta ruta porque no se si es correcta
header("Location: " . BASE_URL . "src/usuario/view/login_register.php"); 
exit();

?>