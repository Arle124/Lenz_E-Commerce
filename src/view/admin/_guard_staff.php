<?php
require_once __DIR__ . "/../../../config/sesion.php";

if (!isset($_SESSION['usuario']['id'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
$rol   = strtolower($_SESSION['usuario']['rol'] ?? '');

$esStaff = in_array($rolId, [2,3,4], true) || in_array($rol, ['trabajador','empleado','duenio','dueño'], true);

if (!$esStaff) {
  $_SESSION['error'] = "No tienes permiso para acceder a esta sección.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}
