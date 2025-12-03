<?php
require_once __DIR__ . "/../../config/sesion.php";

require_once "../model/UsuarioModel.php";

require_once __DIR__ . '/../../config/config.php';

class UsuarioController {

    private $model;

    public function __construct() {
        // session_start();
        $this->model = new UsuarioModel();
    }

    // =====================================================
    // REGISTRAR USUARIO
    // =====================================================
    public function registrar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $correo = trim($_POST['correo']);
            $telefono = trim($_POST['telefono'] ?? '');
            $password = trim($_POST['password']);
            $password_confirm = trim($_POST['password_confirm']);

            // Validar campos
            if (empty($nombre) || empty($apellido) || empty($correo) || empty($password)) {
                $_SESSION['error'] = "Todos los campos son obligatorios.";
                header("Location: ../view/login_register.php");
                exit();
            }

            // Validar confirmación
            if ($password !== $password_confirm) {
                $_SESSION['error'] = "Las contraseñas no coinciden.";
                header("Location: ../view/login_register.php");
                exit();
            }

            // Encriptar contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Registrar usuario
            $idNuevo = $this->model->registrar($nombre, $apellido, $correo, $passwordHash, $telefono);

            if ($idNuevo === "correo_existente") {
                $_SESSION['error'] = "El correo ya está registrado.";
            } elseif ($idNuevo) {
                $_SESSION['success'] = "¡Cuenta creada correctamente! Ahora puedes iniciar sesión.";
            } else {
                $_SESSION['error'] = "No se pudo registrar el usuario.";
            }

            header("Location: ../view/login_register.php");
            exit();
        }
    }

    // =====================================================
    // LOGIN USUARIO
    // =====================================================
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);

            if (empty($correo) || empty($password)) {
                $_SESSION['error'] = "Debes ingresar correo y contraseña.";
                header("Location: ../view/login_register.php");
                exit();
            }

            $usuario = $this->model->login($correo);

            if (!$usuario) {
                $_SESSION['error'] = "Correo no registrado.";
                header("Location: ../view/login_register.php");
                exit();
            }

            if ($usuario['estado'] !== 'activo') {
                $_SESSION['error'] = "Tu usuario se encuentra inactivo.";
                header("Location: ../view/login_register.php");
                exit();
            }

            // Verificar contraseña
            if (!password_verify($password, $usuario['clave'])) {
                $_SESSION['error'] = "Contraseña incorrecta.";
                header("Location: ../view/login_register.php");
                exit();
            }
            $rolesBD = $this->model->obtenerRoles($usuario['id_usuario']);

            // Convertir [[rol],[rol]] → ["cliente", "duenio"]
            $rolesSoloNombres = array_map(function($r) {
                return $r["rol"];
            }, $rolesBD);

            $_SESSION['usuario'] = [
                'id'       => $usuario['id_usuario'],
                'nombre'   => $usuario['nombres'],
                'apellido' => $usuario['apellidos'],
                'correo'   => $usuario['correo'],
                'telefono' => $usuario['telefono'],
                'roles'    => $rolesSoloNombres // <--- SOLO STRINGS
            ];


            header("Location: ../../index.php");
            exit();
        }

    }

    // =====================================================
    // LOGOUT
    // =====================================================
    public function logout() {
        session_unset();    // limpia variables
        session_destroy();  // destruye la sesión
        header("Location: ../view/login_register.php");
        exit();
    }
    

    // =====================================================
    // LISTAR USUARIOS (ADMIN)
    // =====================================================
    public function listarUsuarios() {
        $usuarios = $this->model->listar();
        return $usuarios; // útil para usar en una vista admin
    }

    // =====================================================
    // OBTENER USUARIO POR ID
    // =====================================================
    public function obtenerUsuario() {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "ID no enviado.";
            header("Location: ../view/admin/usuarios.php");
            exit();
        }

        $id = intval($_GET['id']);
        return $this->model->obtenerPorId($id);
    }

    // =====================================================
    // CAMBIAR ESTADO (ADMIN)
    // =====================================================
    public function cambiarEstado() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = intval($_POST['id']);
            $estado = $_POST['estado']; // "activo" o "inactivo"

            $res = $this->model->cambiarEstado($id, $estado);

            $_SESSION['success'] = "Estado actualizado correctamente.";
            header("Location: ../view/admin/usuarios.php");
            exit();
        }
    }

    // =====================================================
    // ASIGNAR ROL (ADMIN)
    // =====================================================
    public function asignarRol() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $idUsuario = intval($_POST['id_usuario']);
            $idRol = intval($_POST['id_rol']);

            $this->model->asignarRol($idUsuario, $idRol);

            $_SESSION['success'] = "Rol asignado correctamente.";
            header("Location: ../view/admin/usuarios.php");
            exit();
        }
    }
    
    // =====================================================
    // ACTUALIZAR PERFIL (nombre, apellido, correo, telefono)
    // =====================================================
   public function actualizarPerfil(): void {
        if (!isset($_SESSION['usuario']['id'])) {
            $_SESSION['error'] = "Sesión inválida.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        $id = (int)$_SESSION['usuario']['id'];

        $nombre   = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo   = trim($_POST['correo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        if ($nombre === '' || $apellido === '' || $correo === '') {
            $_SESSION['error'] = "Completa nombre, apellido y correo.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        $this->model->actualizarPerfil($id, $nombre, $apellido, $correo, $telefono);

        // ✅ actualizar sesión para que se refleje inmediatamente en la vista
        $_SESSION['usuario']['nombre']   = $nombre;
        $_SESSION['usuario']['apellido'] = $apellido;
        $_SESSION['usuario']['correo']   = $correo;
        $_SESSION['usuario']['telefono'] = $telefono;

        $_SESSION['success'] = "Perfil actualizado correctamente.";
        header("Location: " . BASE_URL . "src/view/account.php#settings");
        exit;
    }
    // =====================================================
    // ACTUALIZAR PASSWORD
    // =====================================================
    public function actualizarPassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ../view/account.php#settings");
            exit;
        }

        if (!isset($_SESSION['usuario']['id'])) {
            $_SESSION['error'] = "No hay sesión activa.";
            header("Location: ../view/account.php#settings");
            exit;
        }

        $id = (int)$_SESSION['usuario']['id'];

        $actual  = $_POST['password_actual'] ?? '';
        $nueva   = $_POST['password_nuevo'] ?? '';
        $confirm = $_POST['password_confirm'] ?? '';

        if ($actual === '' || $nueva === '' || $confirm === '') {
            $_SESSION['error'] = "Completa los 3 campos de contraseña.";
            header("Location: ../view/account.php#settings");
            exit;
        }

        if ($nueva !== $confirm) {
            $_SESSION['error'] = "La nueva contraseña y la confirmación no coinciden.";
            header("Location: ../view/account.php#settings");
            exit;
        }

        require_once __DIR__ . '/../model/UsuarioModel.php';
        $model = new UsuarioModel();

        try {
            // 1) Trae hash actual
            $u = $model->obtenerUsuarioPorId($id);
            $hashActual = $u['clave'] ?? '';

            // 2) Valida password actual
            if (!$hashActual || !password_verify($actual, $hashActual)) {
                $_SESSION['error'] = "La contraseña actual es incorrecta.";
                header("Location: ../view/account.php#settings");
                exit;
            }

            // 3) Genera hash nuevo y manda al SP
            $hashNuevo = password_hash($nueva, PASSWORD_BCRYPT);

            $ok = $model->actualizarPasswordSP($id, $hashNuevo);

            if ($ok) {
                $_SESSION['success'] = "Contraseña actualizada correctamente.";
            } else {
                $_SESSION['error'] = "No se pudo actualizar la contraseña.";
            }

        } catch (Throwable $e) {
            $_SESSION['error'] = "Error al actualizar contraseña: " . $e->getMessage();
        }

        header("Location: ../view/account.php#settings");
        exit;
    }
    // =====================================================
    // ELIMINAR CUENTA
    // =====================================================
    public function eliminarCuenta(): void {
        if (!isset($_SESSION['usuario']['id'])) {
            $_SESSION['error'] = "Sesión inválida.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        $idUsuario = (int)$_SESSION['usuario']['id'];
        $password = trim($_POST['password_actual'] ?? '');

        if ($password === '') {
            $_SESSION['error'] = "Debes confirmar tu contraseña.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        $hash = $this->model->obtenerHashPassword($idUsuario);

        if (!$hash || !password_verify($password, $hash)) {
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        $ok = $this->model->eliminarUsuario($idUsuario);

        if (!$ok) {
            $_SESSION['error'] = "No se pudo eliminar la cuenta.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        session_unset();
        session_destroy();

        header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
        exit;
    }


    
}
// Ejecutar acción recibida por GET
$controller = new UsuarioController();
    $action = $_POST['action'] ?? $_GET['action'] ?? '';
    if ($action) {
        switch ($action) {
            case 'registrar': $controller->registrar(); break;
            case 'login': $controller->login(); break;
            case 'logout': $controller->logout(); break;
            case 'listar': $controller->listarUsuarios(); break;
            case 'obtener': $controller->obtenerUsuario(); break;
            case 'estado': $controller->cambiarEstado(); break;
            case 'rol': $controller->asignarRol(); break;
            case 'actualizar_perfil': $controller->actualizarPerfil(); break;
            case 'actualizar_password': $controller->actualizarPassword(); break;
            case 'eliminar_cuenta': $controller->eliminarCuenta(); break;
            default:
                $_SESSION['error'] = "Acción no válida.";
                header("Location: ../view/login_register.php");
                exit();
        }
    }
    
?>