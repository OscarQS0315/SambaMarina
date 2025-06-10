<?php
class ComplementoModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Complemento" en la base de datos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM complemento;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    
    // Función get
    // Obtiene un registro específico de "Complemento" con respecto al id brindado
    public function get($id)
    {
        try {
            //Consulta sql
			$vSql = "SELECT * FROM complemento where id=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);

			// Retornar el objeto
			return $vResultado[0];
		} catch (Exception $e) {
            handleException($e);
        }
    }

    public function getIdReserva($id)
    {
        try {
            //Consulta sql
			$vSql = "SELECT * FROM DetalleReservaComplemento where idReserva=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            $complementos = [];
           
            if (is_array($vResultado)){
                for ($i = 0; $i < count ($vResultado); $i++){
                    $vResultado[$i] = $this -> get($vResultado[$i] -> idComplemento);
                    $complementos[] = $vResultado[$i];
                }
            }
            
			// Retornar el objeto
			return $complementos;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    
}
