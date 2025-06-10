<?php
class CruceroModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Crucero" en la base de datos
    public function all()
    {
        try {


            //Consulta sql
            $vSql = "SELECT c.id, c.idBarco, c.nombre, c.nombre, c.fechaInicio, c.fechaFin, c.fechaLimitePago, c.precioBase, c.imagen, b.id as idBarco, b.nombre as Barco  
                     FROM crucero c, barco b 
                     where c.idBarco = b.id;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "Crucero" con respecto al id brindado
    public function get($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM crucero where id=$id";
            $barcoModel = new BarcoModel();
            $vItinerarioModel = new ItinerarioModel();
            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            $vResultado = $vResultado[0];
            $vResultado -> itinerario = $vItinerarioModel -> getIdCrucero($id);
            $fechaInicio = new DateTime($vResultado -> fechaInicio);
            $fechFin =  new DateTime($vResultado -> fechaFin);
            
            $vResultado -> cantidadDias = $fechaInicio -> diff($fechFin) -> days;
            
            $barco = $barcoModel->get($vResultado->idBarco);
            $vResultado->barco = $barco;
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function create($objeto){
        try{
            
            $vSql = "select fechaInicio from crucero";
            $fechas_inicio_cruceros = $this->enlace->ExecuteSQL($vSql);
            if(is_array($fechas_inicio_cruceros)){
                foreach($fechas_inicio_cruceros as $fecha){
                    if ($fecha == $objeto -> fechaInicio){
                        
                        $vRetorno = "Ya hay un crucero con esta fecha de inicio";
                        return $vRetorno;
                    }
                }
            }
            $idBarco = $objeto -> idBarco;
            $nombre = $objeto -> nombre; 
            $fechaInicio = $objeto -> fechaInicio; 
            $fechaFin = $objeto -> fechaFin; 
            $fechaLimite = $objeto -> fechaLimite; 
            $precioBase = $objeto -> precioBase; 
            $imagen = $objeto -> imagen; 
            $estado = 1; 

            $vSql2 = "Insert into crucero (idBarco, nombre, fechaInicio, fechaFin, fechaLimitePago, precioBase, imagen, estado) values ('$idBarco', '$nombre', '$fechaInicio', '$fechaFin', '$fechaLimite', '$precioBase', '$imagen', '$estado')";
            $VER = $vSql2;

            $idCrucero = $this -> enlace -> executeSQL_DML_last($vSql2);

            $puertoSalida = $objeto -> idPuertoSalida; 
            $puertoLlegada = $objeto -> idPuertoLlegada; 
            $descripcion = $objeto -> descripcionItinerario; 
            $vSql3 = "Insert into itinerario (idCrucero, idPuertoSalida, idPuertoDestino, fechaLlegada, fechaSalida, descripcion) values ('$idCrucero', '$puertoSalida', '$puertoLlegada', '$fechaInicio', '$fechaFin', '$descripcion')";
            $this -> enlace -> executeSQL_DML($vSql3);
            $objeto -> id = $idCrucero;
            return $objeto; 
        }catch (Exception $e) {
            handleException($e);
        }
    }
}
