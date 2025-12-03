<?php
require_once __DIR__ . "/../../config/sesion.php";
require_once __DIR__ . "/../../config/conexion.php";

class UsuarioModel {

    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    //-----------------------------------
    // REGISTRAR USUARIO
    //-----------------------------------
    public function registrar($nombre, $apellido, $correo, $password, $telefono) {

        $sql = "CALL sp_registrar_usuario(:nombre, :apellido, :correo, :password, :telefono)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':correo' => $correo,
            ':password' => $password,
            ':telefono' => $telefono
        ]);

        // leer el resultado del SP (obligatorio)
        $res = $stmt->fetch();

        $stmt->closeCursor(); // limpiar SP

        return $res['id_nuevo_usuario'] ?? null;
    }

    //-----------------------------------
    // OBTENER USUARIO POR CORREO (LOGIN)
    //-----------------------------------
    public function login($correo) {
        $sql = "CALL sp_login_usuario(:correo)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':correo' => $correo]);

        $usuario = $stmt->fetch();

        $stmt->closeCursor(); // limpiar SP
        
        return $usuario;
    }

    //-----------------------------------
    // OBTENER USUARIO POR ID
    //-----------------------------------
    public function obtenerPorId($id) {
        $sql = "CALL sp_obtener_usuario_por_id(:id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $usuario = $stmt->fetch();

        $stmt->closeCursor(); // limpiar SP

        return $usuario;
    }

    //-----------------------------------
    // LISTAR USUARIOS
    //-----------------------------------
    public function listar() {
        $stmt = $this->conn->query("CALL sp_listar_usuarios()");
        
        $usuarios = $stmt->fetchAll();

        $stmt->closeCursor(); // limpiar SP

        return $usuarios;
    }

    //-----------------------------------
    // CAMBIAR ESTADO
    //-----------------------------------
    public function cambiarEstado($id, $estado) {
        $stmt = $this->conn->prepare("CALL sp_cambiar_estado_usuario(:id, :estado)");
        $stmt->execute([':id' => $id, ':estado' => $estado]);

        $res = $stmt->fetch();

        $stmt->closeCursor(); // limpiar SP

        return $res;
    }

    //-----------------------------------
    // ASIGNAR ROL
    //-----------------------------------
    public function asignarRol($idUsuario, $idRol) {
        $stmt = $this->conn->prepare("CALL sp_asignar_rol_usuario(:idUsuario, :idRol)");
        $stmt->execute([':idUsuario' => $idUsuario, ':idRol' => $idRol]);

        $res = $stmt->fetch();

        $stmt->closeCursor(); // limpiar SP

        return $res;
    }

    //-----------------------------------
    // OBTENER ROLES DEL USUARIO
    //-----------------------------------
    public function obtenerRoles($idUsuario) {
        $stmt = $this->conn->prepare("CALL sp_obtener_roles_usuario(:idUsuario)");
        $stmt->execute([':idUsuario' => $idUsuario]);

        $roles = $stmt->fetchAll();

        $stmt->closeCursor(); // limpiar SP

        return $roles;
    }
    public function actualizarPerfil($id, $nombre, $apellido, $correo, $telefono) {

        $sql = "CaLL sp_actualizar_usuario(:id, :nombre, :apellido, :correo, :telefono)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":correo" => $correo,
            ":telefono" => $telefono
        ]);
    }
    // -----------------------------------
    // ACTUALIZAR PASSWORD
    //-----------------------------------
    public function obtenerUsuarioPorId(int $id): array {
        $sql = "SELECT id_usuario, clave FROM usuarios WHERE id_usuario = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
    //-----------------------------------
    // ACTUALIZAR PASSWORD CON SP
    //-----------------------------------
    public function actualizarPasswordSP(int $id, string $hashNuevo): bool {
        $sql = "CALL sp_actualizar_password(:id, :hash)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':hash' => $hashNuevo
        ]);

        // El SP devuelve SELECT ROW_COUNT() AS filas_afectadas
        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();

        return ((int)($row['filas_afectadas'] ?? 0)) > 0;
    }
    // -----------------------------------
    // OBTENER HASH PASSWORD
    //-----------------------------------
    public function obtenerHashPassword(int $idUsuario): ?string {
        $sql = "SELECT clave FROM usuarios WHERE id_usuario = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['clave'] ?? null;
    }
    // -----------------------------------
    // ELIMINAR USUARIO
    //-----------------------------------
    public function eliminarUsuario(int $idUsuario): bool {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $idUsuario]);
    }


}
?>