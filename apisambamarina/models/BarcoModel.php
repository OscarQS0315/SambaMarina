<?php
class BarcoModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Barco" en la base de datos
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM barco;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            if (!empty($vResultado) && is_array($vResultado)) {
                for ($i = 0; $i < count($vResultado); $i++) {
                    $vResultado[$i] = $this->get($vResultado[$i]->id);
                }
            }

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "Barco" con respecto al id brindado
    public function get($id)
    {
        try {
            $vHabitacionModel = new HabitacionModel();
            $imagenesBarcoM = new ImagenBarcoModel();

            // Consulta sql
            $vSql = "SELECT * FROM barco where id=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            if (!empty($vResultado)) {

                $vResultado = $vResultado[0];
                // Imágenes
                $listaImagenes = $imagenesBarcoM->getImagenes($vResultado->id);
                $vResultado->imagenesBarco = $listaImagenes;
                $vResultado->habitaciones = $vHabitacionModel->getIdBarco($id);
                if (is_array($vResultado->habitaciones)) {
                    $cantidadMaxHuespedes = 0;
                    $cantidadMinHuespedes = 0;
                    $pagoTotalPorHabitaciones = 0;
                    $vResultado->cantidadHabitaciones = 0;
                    for ($i = 0; $i < count($vResultado->habitaciones); $i++) {
                        $vCantidad = $vResultado->habitaciones[$i]->cantidad;
                        $vResultado->cantidadHabitaciones += $vCantidad;
                        $cantidadMaxHuespedes += ($vResultado->habitaciones[$i]->maxHuespedes * $vCantidad);
                        $vResultado->cantidadMaxHuespedes = $cantidadMaxHuespedes;

                        $cantidadMinHuespedes += ($vResultado->habitaciones[$i]->minHuespedes * $vCantidad);
                        $vResultado->cantidadMinHuespedes = $cantidadMinHuespedes;

                        $pagoTotalPorHabitaciones += $vResultado->habitaciones[$i]->precioBase * $vCantidad;
                        $vResultado->pagoTotalPorHabitaciones = $pagoTotalPorHabitaciones;
                    }
                } else {
                    $vResultado->cantidadHabitaciones = 0;
                    $vResultado->cantidadMaxHuespedes = 0;
                    $vResultado->cantidadMinHuespedes = 0;
                    $vResultado->pagoTotalPorHabitaciones = 0;
                }
            }

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función create
    // Crea un registro de "Barco" en la base de datos
    public function create($objeto)
    {
        try {
            // Consulta sql
            $vSql = "Insert into barco (nombre, descripcion,estado) values ('$objeto->nombre', '$objeto->descripcion',1)";

            // Ejecutar la consulta
            
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);
            if(is_array($objeto-> habitaciones)){
                for($i = 0; $i < count($objeto-> habitaciones); $i++){
                    $id_Habitacion = $objeto-> habitaciones[$i]->id;
                    $cantidad = $objeto-> habitaciones[$i]-> cantidad;
                    $vSql2 = "Insert into barco_habitacion values ('$vResultado', '$id_Habitacion',10)";
                    $prueba = $vSql2;
                    $this->enlace->executeSQL_DML($vSql2);
                }
            }
            $objeto -> id = $vResultado;
            // Retornar el objeto creado
            return ($objeto);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función update
    // Actualiza los datos de un registro en específico
    public function update($objeto)
    {
        try {
            //Consulta sql
            $vSql = "Update barco SET nombre ='$objeto->nombre', descripcion ='$objeto->descripcion' Where id=$objeto->id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);
            $vSql2 = "Delete from barco_habitacion where barco_id = '$objeto->id'";
            $vResultado = $this->enlace->executeSQL_DML($vSql2);
            if(is_array($objeto-> habitaciones)){
                for($i = 0; $i < count($objeto-> habitaciones); $i++){
                    $id_Habitacion = $objeto-> habitaciones[$i]->id;
                    $cantidad = $objeto-> habitaciones[$i]-> cantidad;
                    $vSql2 = "Insert into barco_habitacion values ('$objeto->id', '$id_Habitacion',10)";
                    $prueba = $vSql2;
                    $this->enlace->executeSQL_DML($vSql2);
                }
            }
            // Retornar el objeto actualizado
            return ($objeto);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
