<?php
class ImagenPuertoModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "ImagenPuerto" en la base de datos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM imagenpuerto;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "ImagenPuerto" con respecto al id brindado
    public function get($id)
    {
        try {
            //Consulta sql
			$vSql = "SELECT * FROM imagenpuerto where id=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            
			// Retornar el objeto
			return $vResultado[0];
		} catch (Exception $e) {
            handleException($e);
        }
    }
}
