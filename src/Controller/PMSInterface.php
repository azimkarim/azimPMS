<?php
namespace Src\Controller;

use Src\TableGateways\PMSGateway;

class PMSInterface {

    private $db;
    private $clientKey;

    private $pmsGateway;

    public function __construct($db, $clientKey)
    {
        $this->db = $db;
        $this->$clientKey = $clientKey;
        $this->pmsGateway = new PMSGateway($db);
    }

    public function create_appointment($patiient_id, $appointment_datetime){
        $params = Array(
            'patientID' => $patiient_id,
            'clientKey'  => $this->clientKey,
            'appointmentKey' => uniqid('AK_'),
            'appointmentDate' => $appointment_datetime,
        );
        $response['body'] = json_encode($this->pmsGateway->insert($params) );
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['status'] = 201;
        header($response['status_code_header']);
        echo $response['body'];
        return $response;
    }

    public function read_patient($patient_key){
        $result = $this->pmsGateway->find($patient_key);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        $response['status'] = 200;
        header($response['status_code_header']);
        echo $response['body'];
        return $response;
    }

    public function validateAppointment($input)
    {
        if (! isset($input['patientID'])) {
            return false;
        }
        if (! isset($input['appointmentDate'])) {
            return false;
        }
        return true;
    }

    public function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        header($response['status_code_header']);
        return $response;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['status'] = 404;
        $response['body'] = null;
        return $response;
    }
}
