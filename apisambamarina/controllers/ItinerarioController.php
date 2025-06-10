<?php
class itinerario
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $itinerarios = new ItinerarioModel();
            $result = $itinerarios->all();

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
            $itinerario = new ItinerarioModel();
            $result = $itinerario->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
