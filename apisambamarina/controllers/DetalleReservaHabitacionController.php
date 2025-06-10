<?php
class detallereservahabitacion
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $detalles = new DetalleReservaHabitacionModel();
            $result = $detalles->all();

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
            $detalle = new DetalleReservaHabitacionModel();

            $result = $detalle->get($param);
            
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
