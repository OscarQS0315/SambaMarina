<?php
class usuario
{
    public function index()
    {
        try {
            $response = new Response();

            // Obtener el listado del Modelo
            $usuarios = new UsuarioModel();
            $result = $usuarios->all();

            // Dar respuesta
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
            $usuario = new UsuarioModel();
            $result = $usuario->get($param);
            
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            handleException($e);
        }
    }
    //POST Crear
    public function create()
    {
        try {
            $request = new Request();
            $response = new Response();
            //Obtener json enviado
            $inputJSON = $request->getJSON();
            //Instancia del modelo
            $usuario = new UsuarioModel();
            //Acción del modelo a ejecutar
            $result = $usuario->create($inputJSON);
            //Dar respuesta
            $response->toJSON($result);
        } catch (Exception $e) {
            
            handleException($e);
        }
    }
}
