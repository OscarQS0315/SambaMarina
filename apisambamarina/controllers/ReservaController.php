<?php
class reserva
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $reservas = new ReservaModel();
            $result = $reservas->all();

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
            $reserva = new ReservaModel();
            $result = $reserva->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
