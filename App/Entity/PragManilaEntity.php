<?php

    class PragManilaEntity{
        private $conn;

        function __construct($conn){
            $this->conn=$conn;
        }

        function Human_ViewList(){
            $stmt = $this->conn->prepare('CALL Human_ViewList()');

            $stmt->execute();
            if($stmt->errorCode()=='00000'){
                return $stmt->fetchAll();
            }else if($stmt->errorCode()=='42000'){
                http_response_code(400);
                $array = array('message'=>$stmt->errorInfo());
                error_log(json_encode($array));
                echo json_encode($array);
                die();
            }else{
                http_response_code(500);
                $array = array('message'=>'An internal server error occured.');
                error_log(json_encode($stmt->errorInfo()));
                die();
            }
        }
        function Human_getById(int $id){
            $stmt = $this->conn->prepare('CALL Human_getById(?)');

            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            $stmt->execute();
            if($stmt->errorCode()=='00000'){
                return $stmt->fetchAll();
            }else if($stmt->errorCode()=='42000'){
                http_response_code(400);
                $array = array('message'=>$stmt->errorInfo());
                error_log(json_encode($array));
                echo json_encode($array);
                die();
            }else{
                http_response_code(500);
                $array = array('message'=>'An internal server error occured.');
                error_log(json_encode($stmt->errorInfo()));
                die();
            }
        }
        function Human_add(string $firstName, string $lastName){
            $stmt = $this->conn->prepare('CALL Human_add(?,?)');

            $stmt->bindParam(1, $firstName);
            $stmt->bindParam(2, $lastName);

            $stmt->execute();
            if($stmt->errorCode()=='00000'){
                return $stmt->fetchAll();
            }else if($stmt->errorCode()=='42000'){
                http_response_code(400);
                $array = array('message'=>$stmt->errorInfo());
                error_log(json_encode($array));
                echo json_encode($array);
                die();
            }else{
                http_response_code(500);
                $array = array('message'=>'An internal server error occured.');
                error_log(json_encode($stmt->errorInfo()));
                die();
            }
        }
    }

?>