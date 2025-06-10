<?php
class ItinerarioModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Itinerario" en la base de datos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM itinerario;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "Itinerario" con respecto al id brindado
    public function get($id)
    {
        try {
            $puertoModel = new PuertoModel();
            //Consulta sql
			$vSql = "SELECT * FROM itinerario where id=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            $vResultado = $vResultado[0];
            $vResultado -> puertoSalida = $puertoModel -> get($vResultado -> idPuertoSalida);
            $vResultado -> puertoLlegada = $puertoModel -> get($vResultado -> idPuertoDestino);
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    public function getIdCrucero($id)
    {
        try {
            $puertoModel = new PuertoModel();
            //Consulta sql
			$vSql = "SELECT * FROM itinerario where idCrucero=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            $vResultado = $vResultado[0];
            $vResultado -> puertoSalida = $puertoModel -> get($vResultado -> idPuertoSalida);
            $vResultado -> puertoLlegada = $puertoModel -> get($vResultado -> idPuertoDestino);
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
}
