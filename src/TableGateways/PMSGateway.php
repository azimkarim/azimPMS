<?php
namespace Src\TableGateways;

class PMSGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function find($patientKey)
    {
        // $statement = "
        //     SELECT
        //         id, patientKey, patientFirstName, patientLastName, patientEmail, patientMobileNumber, patientStatus
        //     FROM
        //         patients
        //     WHERE patientKey = ?;
        // ";

        // try {
        //     $statement = $this->db->prepare($statement);
        //     $statement->execute(array($patientKey));
        //     $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        //     return $result;
        // } catch (\PDOException $e) {
        //     exit($e->getMessage());
        // }

        return Array(
            "patientID"=> "346633",
            "patientKey"=> "pk-001",
            "patientFirstName"=> "Todd",
            "patientLastName"=> "Crowe",
            "patientEmail"=> "todd@reviewwave.com",
            "patientMobileNumber"=> "5038011168",
            "patientStatus"=> "active",
            "patientAddDate"=> strtotime("2020-11-10 16:07:31"),
            "patientSyncDate"=> strtotime("2020-11-10 16:07:31"),
            "patientDOB"=> strtotime("1968-05-05 00:00:00"),
        );
    }

    public function insert(Array $input)
    {
        // $statement = "
        //     INSERT INTO appointments
        //         (patientID, clientKey, appointmentDate, appointmentKey)
        //     VALUES
        //         (:patientID, :clientKey, :appointmentDate, :appointmentKey);
        // ";

        // try {
        //     $statement = $this->db->prepare($statement);
        //     $statement->execute(array(
        //         'patientID' => $input['patientID'],
        //         'clientKey'  => $input['clientKey'],
        //         'appointmentKey' => $input['appointmentKey'],
        //         'appointmentDate' => $input['appointmentDate'],
        //     ));
        //     return $statement->rowCount();
        // } catch (\PDOException $e) {
        //     exit($e->getMessage());
        // }
        return null;
    }

}