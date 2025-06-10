<?php
// Composer autoloader
require_once 'vendor/autoload.php';
/*Encabezada de las solicitudes*/
/*CORS*/
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');

// Manejar preflight request (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

/*--- Requerimientos Clases o librerías*/
require_once "controllers/core/Config.php";
require_once "controllers/core/HandleException.php";
require_once "controllers/core/Logger.php";
require_once "controllers/core/MySqlConnect.php";
require_once "controllers/core/Request.php";
require_once "controllers/core/Response.php";


/***--- Agregar todos los modelos*/
require_once "models/UsuarioModel.php";
require_once "models/PuertoModel.php";
require_once "models/ImagenPuertoModel.php";
require_once "models/BarcoModel.php";
require_once "models/HabitacionModel.php";
require_once "models/CruceroModel.php";
require_once "models/ItinerarioModel.php";
require_once "models/ComplementoModel.php";
require_once "models/ReservaModel.php";
require_once "models/DetalleReservaHabitacionModel.php";
require_once "models/DetalleReservaComplementoModel.php";
require_once "models/DetalleReservaHuespedModel.php";
require_once "models/PagoModel.php";
require_once "models/ImagenBarcoModel.php";
require_once "models/TipoHabitacionModel.php";

/***--- Agregar todos los controladores*/
require_once "controllers/UsuarioController.php";
require_once "controllers/PuertoController.php";
require_once "controllers/ImagenPuertoController.php";
require_once "controllers/BarcoController.php";
require_once "controllers/HabitacionController.php";
require_once "controllers/CruceroController.php";
require_once "controllers/ItinerarioController.php";
require_once "controllers/ComplementoController.php";
require_once "controllers/ReservaController.php";
require_once "controllers/DetalleReservaHabitacionController.php";
require_once "controllers/DetalleReservaComplementoController.php";
require_once "controllers/DetalleReservaHuespedController.php";
require_once "controllers/PagoController.php";
require_once "controllers/ImagenBarcoController.php";
require_once "controllers/TipoHabitacionController.php";

//Enrutador
require_once "routes/RoutesController.php";
$index = new RoutesController();
$index->index();


