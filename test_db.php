<?php
require_once "src/model/UsuarioModel.php";

$model = new UsuarioModel();

// 1. Listar usuarios
echo "<h2>Usuarios:</h2>";
$usuarios = $model->listar();
echo "<pre>"; print_r($usuarios); echo "</pre>";

// // 2. Registrar un usuario (solo si quieres probar el registro)
// $idNuevo = $model->registrar("Test", "Usuario", "test@example.com", password_hash("123456", PASSWORD_DEFAULT), "1234567890");
// echo "<h2>ID Nuevo Usuario:</h2>";
// echo "<pre>"; print_r($idNuevo); echo "</pre>";

// 3. Login usuario
$usuario = $model->login("javierrico040602@gmail.com");
echo "<h2>Login Usuario:</h2>";
echo "<pre>"; print_r($usuario); echo "</pre>";

// 4. Obtener roles del usuario
$roles = $model->obtenerRoles($usuario['id_usuario'] ?? 0);
echo "<h2>Roles del Usuario:</h2>";
echo "<pre>"; print_r($roles); echo "</pre>";
?>
