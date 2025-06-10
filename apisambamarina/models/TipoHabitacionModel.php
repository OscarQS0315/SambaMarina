<?php
class TipoHabitacionModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    
  
    public function all(){
        try {
            //Consulta sql
			$vSql = "SELECT * FROM tipohabitacion;";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);

				
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }
    
 
    public function get($id)
    {
        try {
            

            // Consulta sql
			$vSql = "SELECT * FROM tipohabitacion where id=$id";
			
            // Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL ($vSql);
            
            
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
            handleException($e);
        }
    }

    
    public function create($objeto){
        try {
            // Consulta sql
            $vSql = "Insert into tipohabitacion (id, descripcion) values ('$objeto->id', '$objeto->descripcion')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last( $vSql);

            // Retornar el objeto creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    // Función update
    // Actualiza los datos de un registro en específico
    public function update($objeto) {
        try {
            //Consulta sql
			$vSql = "Update barco SET descripcion ='$objeto->descripcion' Where id=$objeto->id";
			
            //Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML( $vSql);

			// Retornar el objeto actualizado
            return $this->get($objeto->id);
		} catch (Exception $e) {
            handleException($e);
        }
    }
}