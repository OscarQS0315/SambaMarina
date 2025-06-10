<?php
class HabitacionModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    // Función all
    // Obtiene todos los registros de "Habitacion" en la base de datos
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT h.id, h.idTipoHabitacion, h.nombre, h.descripcion, h.minHuespedes, h.maxHuespedes, h.tamano, h.precioBase
                     FROM habitacion h";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            if(!empty($vResultado) && is_array($vResultado)){
                for ($i=0; $i < count($vResultado); $i++) { 
                    $vResultado[$i]->imagenes =$this->getImagenHabitacion($vResultado[$i]->id);
                }
            }
            
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función get
    // Obtiene un registro específico de "Habitacion" con respecto al id brindado
    public function get($id)
    {
        try {
            $barcoModel = new BarcoModel();
            //Consulta sql
            $vSql = "SELECT * FROM habitacion where id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            $vResultado = $vResultado[0];
            $vResultado -> imagenesHabitacion =$this->getImagenHabitacion($id);
            
            $vResultado = $vResultado;
            
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }
    public function getIdBarco($id)
    {
        try {
            $barcoModel = new BarcoModel();
            //Consulta sql
            $vSql = "SELECT * FROM barco_habitacion where barco_id=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            if(is_array($vResultado)){
                for ($i = 0; $i < count($vResultado);$i++){
                $vCantidad = $vResultado[$i] -> cantidad; 
                $vResultado[$i] = $this->get($vResultado[$i] -> habitacion_id);
                $vResultado[$i] -> cantidad = $vCantidad;
            }
            }
            
            
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }
    public function getImagenHabitacion($idHabitacion)
    {
        try {
            
            //Consulta sql
            $vSql = "SELECT * FROM ImagenHabitacion where idHabitacion=$idHabitacion";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            
            
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function create($data)
    {
        try {
            // Asignación de valores a variables locales para posteriormente realizar la inserción
        
           
            $idTipoHabitacion = $data->idTipoHabitacion;
            $nombre = $data->nombre;
            $descripcion = $data->descripcion;
            $minHuespedes = $data->minHuespedes;
            $maxHuespedes = $data->maxHuespedes;
            $tamano = $data->tamano;
            $precioBase = $data->precioBase;
            
            // Solicitud sql
            $vSql = "INSERT INTO habitacion (idTipoHabitacion, nombre, descripcion, minHuespedes, maxHuespedes, tamano, precioBase) 
            VALUES ('$idTipoHabitacion', '$nombre', '$descripcion', '$minHuespedes', '$maxHuespedes', '$tamano', '$precioBase')";

            // Ejecutar la solicitud
            $idHabitacion = $this->enlace->executeSQL_DML_last($vSql);

            if (is_array($data-> imagenes)){
                for ($i = 0; $i < count($data -> imagenes); $i++){
                    $imagen = $data -> imagenes[$i]->imagen;
                    
                    $vSql2 = "INSERT INTO imagenhabitacion (imagen, idHabitacion) 
                    VALUES ('$imagen', '$idHabitacion')";
                    $vResultado = $this->enlace->executeSQL_DML($vSql2);
                }   
            }
            
            $data -> id = $idHabitacion;
            // Retornar el objeto creado
            return ($data);
        } catch (Exception $e) {
            handleException($e);
        } 
    }

    public function update($objeto) {
        try {
            //Consulta sql
			$vSql = "Update habitacion SET idTipoHabitacion ='$objeto->idTipoHabitacion', nombre ='$objeto->nombre', 
                                        descripcion ='$objeto->descripcion',minHuespedes ='$objeto->minHuespedes',maxHuespedes ='$objeto->maxHuespedes',
                                        tamano ='$objeto->tamano',precioBase ='$objeto->precioBase'  Where id=$objeto->id";
            
            $vResultado = $this->enlace->executeSQL_DML($vSql);

             if (is_array($objeto-> imagenes)){
                 for ($i = 0; $i < count($objeto -> imagenes); $i++){
                     $imagen = $objeto -> imagenes[$i]->imagen;
                    
                     $vSql2 = "Update imagenhabitacion set imagen = '$imagen' where idHabitacion = '$objeto->id'";
                     $vResultado = $this->enlace->executeSQL_DML($vSql2);
                 }   
             }
			
            
			// Retornar el objeto actualizado
            return $this->get($objeto->id);
		} catch (Exception $e) {
            handleException($e);
        }
    }
}
