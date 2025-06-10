<?php
class crucero
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $cruceros = new CruceroModel();
            $result = $cruceros->all();

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
            $crucero = new CruceroModel();
            $result = $crucero->get($param);

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
            $crucero = new CruceroModel();

            //Acción del modelo a ejecutar
            $result = $crucero->create($inputJSON);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
