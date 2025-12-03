<?php
require_once __DIR__ . "/../../../config/sesion.php";
require_once __DIR__ . "/../../../config/config.php";

if (!isset($_SESSION['usuario']['id'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
if ($rolId !== 3) {
  $_SESSION['error'] = "Solo el dueño puede acceder aquí.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}
