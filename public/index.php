<?php
require "../bootstrap.php";
use Src\Controller\PMSInterface;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (!isset($uri[1]) || $uri[1] !== 'v2' || !isset($uri[2]) ) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

if( $requestMethod == "GET" ){
    if (!isset($_GET["clientKey"]) || !isset($_GET["patientKey"]) ) {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
    
    $clientKey = $_GET["clientKey"];
    $patientKey = $_GET["patientKey"];
    $controller = new PMSInterface($dbConnection, $clientKey);
    $controller->read_patient($patientKey);
    
}else if( $requestMethod == "POST"){
    // $input = json_decode( $_POST() );
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    $controller = new PMSInterface($dbConnection, $input["clientKey"]);
    if( $controller->validateAppointment($input)){
        return $controller->unprocessableEntityResponse();
    }
    $controller->create_appointment($input["patientID"], $input["appointmentDate"]);
}else{
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>
