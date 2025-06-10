<?php
class imagenbarco
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $imagenes = new ImagenBarcoModel();
            $result = $imagenes->all();

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
            $imagen = new ImagenBarcoModel();
            $result = $imagen->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function getImagenes($param)
    {
        try {
            $response = new Response();

            //Obtener el registro específico del Modelo
            $imagen = new ImagenBarcoModel();
            $result = $imagen->getImagenes($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
