<?php
class habitacion
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $habitaciones = new HabitacionModel();
            $result = $habitaciones->all();

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    
    public function get($param)
    {
        try {
            $response = new Response();

            //Obtener el registro específico del Modelo
            $habitacion = new HabitacionModel();
            $result = $habitacion->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function create()
    {
        try {
            $request = new Request();
            $response = new Response();
            //Obtener json enviado
            $inputJSON = $request->getJSON();
            //Instancia del modelo
            $habitacion = new HabitacionModel();
            //Acción del modelo a ejecutar
            $result = $habitacion->create($inputJSON);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            
            handleException($e);
        }
    }

    public function update()
    {
        try {
            $request = new Request();
            $response = new Response();

            //Obtener json enviado
            $inputJSON = $request->getJSON();

            //Instancia del modelo
            $barco = new HabitacionModel();

            //Acción del modelo a ejecutar
            $result = $barco->update($inputJSON);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
