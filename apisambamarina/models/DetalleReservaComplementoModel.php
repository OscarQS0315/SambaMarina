<?php
class DetalleReservaComplementoModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "DetalleReservaComplemento" en la base de datos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM detallereservacomplemento;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "DetalleReservaComplemento" con respecto al id brindado
    public function get($id)
    {
        try {
            //Consulta sql
			$vSql = "SELECT * FROM detallereservacomplemento where id=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            
			// Retornar el objeto
			return $vResultado[0];
		} catch (Exception $e) {
            handleException($e);
        }
    }
}
