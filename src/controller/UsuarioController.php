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
            default:
                $_SESSION['error'] = "Acción no válida.";
                header("Location: ../view/login_register.php");
                exit();
        }
    }
?>