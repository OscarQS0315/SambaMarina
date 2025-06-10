<?php
class ImagenBarcoModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "ImagenBarco" en la base de datos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM imagenbarco;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "ImagenBarco" con respecto al id brindado
    public function get($id)
    {
        try {
            //Consulta sql
			$vSql = "SELECT * FROM imagenbarco where id=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            
			// Retornar el objeto
			return $vResultado[0];
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función getImagenes
    // Obtiene las imágenes que pertenecen a un Barco
    public function getImagenes($id)
    {
        try {
            //Consulta sql
			$vSql = "SELECT * FROM imagenbarco where idBarco=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función create
    // Crea un registro de "ImagenBarco" en la base de datos
    public function create($objeto){
        try {
            // Consulta sql
            $vSql = "Insert into imagenbarco (imagen, idBarco) values ('$objeto->imagen', '$objeto->idBarco')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last( $vSql);

            // Retornar el objeto creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
