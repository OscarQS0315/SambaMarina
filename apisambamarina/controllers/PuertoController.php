<?php
class puerto
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $puertos = new PuertoModel();
            $result = $puertos->all();

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
            $puerto = new PuertoModel();
            $result = $puerto->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
