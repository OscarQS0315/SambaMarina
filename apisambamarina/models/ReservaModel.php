<?php
class ReservaModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Reserva" en la base de datos
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM reserva;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
			if (is_array($vResultado)){
                for($i = 0; $i < count ($vResultado); $i++){
                    $vResultado[$i] = $this -> get($vResultado[$i]->id);
                }
            }	
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    
    // Función get
    // Obtiene un registro específico de "Reserva" con respecto al id brindado
    public function get($id)
    {
        try {
            $vTotalComplementos = 0;
            $vCruceroModel = new CruceroModel();
            $vComplementoModel = new ComplementoModel ();
            $vUsuarioModel = new UsuarioModel ();
            $vItinerarioModel = new ItinerarioModel();
            //Consulta sql
			$vSql = "SELECT * FROM reserva where id=$id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ( $vSql);
            $vResultado = $vResultado[0];
            $vResultado -> usuario = $vUsuarioModel -> get($vResultado -> idUsuario);
            $vResultado -> itinerario = $vItinerarioModel -> getIdCrucero($id);
            $vResultado -> complementos = $vComplementoModel -> getIdReserva($id);
            for ($i = 0; $i < count ($vResultado -> complementos); $i++){
                $vTotalComplementos += $vResultado -> complementos[$i]->precio; 
            }
            $vResultado -> totalComplementos = $vTotalComplementos;
            
            $vResultado -> crucero = $vCruceroModel -> get($vResultado -> idCrucero);
            $vResultado -> habitacionesMasComplementos = $vTotalComplementos +  $vResultado -> crucero -> barco ->pagoTotalPorHabitaciones;
            $vResultado -> impuestos = 0.13; 
            $vResultado -> total = number_format($vResultado -> habitacionesMasComplementos * (1 + $vResultado -> impuestos), 2);
            			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
}
