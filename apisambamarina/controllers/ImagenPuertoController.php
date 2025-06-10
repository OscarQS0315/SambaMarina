<?php
class imagenpuerto
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $imagenes = new ImagenPuertoModel();
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
            $imagen = new ImagenPuertoModel();
            $result = $imagen->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
