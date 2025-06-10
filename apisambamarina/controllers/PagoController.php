<?php
class pago
{
    public function index()
    {
        try {
            $response = new Response();

            //Obtener el listado del Modelo
            $pagos = new PagoModel();
            $result = $pagos->all();

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
            $pago = new PagoModel();
            $result = $pago->get($param);

            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
