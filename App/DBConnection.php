<?php

    class DBConnection{

        private $dbCredentials;

        function __construct(array $dbCredentials){
            $this->dbCredentials=$dbCredentials;
        }

        function connect(){
            $conn = null;
            try{

                $host=$this->dbCredentials['host'];
                $port=$this->dbCredentials['port'];
                $username=$this->dbCredentials['username'];
                $password=$this->dbCredentials['password'];
                $database=$this->dbCredentials['database'];

                $conn = new PDO("mysql:host=$host;port=$port;dbname=$database;",$username,$password);
                
                if($conn){
                    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    $conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
                    return $conn;
                }else{
                    throw new Exception("Unable to connect to database");
                }

            }catch(Exception $e){
                http_response_code(500);
                error_log($e->getMessage());
                $array=array('message'=>'An internal server error occured');
                echo json_encode($array);
                die();
            }
        }
    }

?>