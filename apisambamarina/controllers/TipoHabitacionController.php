<?php
class tipoHabitacion
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $tipoHabitacion = new TipoHabitacionModel();
            $result = $tipoHabitacion->all();

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
            $tipoHabitacion = new TipoHabitacionModel();
            $result = $tipoHabitacion->get($param);
            
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
            $tipoHabitacion = new TipoHabitacionModel();

            //Acción del modelo a ejecutar
            $result = $tipoHabitacion->create($inputJSON);

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
            $tipoHabitacion = new TipoHabitacionModel();

            //Acción del modelo a ejecutar
            $result = $tipoHabitacion->update($inputJSON);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}