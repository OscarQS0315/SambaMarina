<?php
class complemento
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $complementos = new ComplementoModel();
            $result = $complementos->all();

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
            $complemento = new ComplementoModel();
            $result = $complemento->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
