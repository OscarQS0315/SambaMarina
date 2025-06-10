<?php
class UsuarioModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Usuario" en la base de datos
    public function all(){
        try {
            // Consulta sql
			$vSql = "SELECT * FROM usuario;";
			
            // Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    
    // Función get
    // Obtiene un registro específico de "Usuario" con respecto al id brindado
    public function get($id)
    {
        try {
            // Consulta sql
			$vSql = "SELECT * FROM usuario where id='$id'";
			
            // Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            
			// Retornar el objeto
			return $vResultado[0];
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función create
    // Crea un nuevo registro de "Usuario" en la base de datos
    public function create($data)
    {
        try {
            // Asignación de valores a variables locales para posteriormente realizar la inserción
            $id = $data->id;
            $rol = $data->rol;
            $contrasena = $data->contrasena;
            $nombre = $data->nombre;
            $apellido1 = $data->apellido1;
            $apellido2 = $data->apellido2;
            $telefono = $data->telefono;
            $correo = $data->correo;
            $nacimiento = $data->nacimiento;
            $pais = $data->pais;
            $estado = $data->estado;

            // Solicitud sql
            $vSql = "INSERT INTO usuario (id, rol, contrasena, nombre, apellido1, apellido2, telefono, correo, nacimiento, pais, estado) 
            VALUES ('$id', '$rol', '$contrasena', '$nombre', '$apellido1', '$apellido2', '$telefono', '$correo', '$nacimiento', '$pais', '$estado')";

            // Ejecutar la solicitud
            return $this->enlace->executeSQL_DML($vSql);
        } catch (Exception $e) {
            handleException($e);
        } 
    }

    // Función update
    // Actualiza un registro de "Usuario" especificado a través del id
    public function update($id, $data)
    {
        try {
            // Asignación de valores a variables locales para posteriormente realizar la inserción
            $rol = $data['rol'];
            $contrasena = $data['contrasena'];
            $nombre = $data['nombre'];
            $apellido1 = $data['apellido1'];
            $apellido2 = $data['apellido2'];
            $telefono = $data['telefono'];
            $correo = $data['correo'];
            $nacimiento = $data['nacimiento'];
            $pais = $data['pais'];
            $estado = $data['estado'];

            // Solicitud sql
            $vSql = "UPDATE usuario SET rol='$rol', contrasena='$contrasena', nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', telefono='$telefono', 
            correo='$correo', nacimiento='$nacimiento', pais='$pais', estado='$estado' WHERE id='$id'";

            // Ejecutar la solicitud
            return $this->enlace->ExecuteSQL($vSql);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función delete
    // Elimina un registro de "Usuario" de la base de datos ***Posiblemente en lugar de esta función se utilizará un update del estado***
    public function delete($id)
    {
        try {
            // Solicitud sql
            $vSql = "DELETE FROM usuario WHERE id=$id";

            // Ejecutar la solicitud
            return $this->enlace->ExecuteSQL($vSql);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
