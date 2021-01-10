<?php

    ini_set('display_errors', 1);
    header('Content-Type: application/json');
    date_default_timezone_set('Asia/Manila');

    require __DIR__ . '/App/DBConnection.php';
    require __DIR__ . '/App/Entity/PragManilaEntity.php';
    require __DIR__ . '/App/helpers/APIResponse.php';
    require __DIR__ . '/App/helpers/Validator.php';

    $appConfig = array(
        'dbConfig'=>array(
            'host'=>'localhost',
            'port'=>'3306',
            'username'=>'root',
            'password'=>'ubuntu',
            'database'=>'PragManila'
        )
    );

    $dbConnection = new DBConnection($appConfig['dbConfig']);

    $conn = $dbConnection->connect();

    $db = new PragManilaEntity($conn);

    $apiResponse = new APIResponse();

    $server=$_SERVER;

    $validator = new Validator();


?>