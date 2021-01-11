<?php

    require dirname(__DIR__, 1) . '/config.php';

    $method = $server['REQUEST_METHOD'];

    if($method=='GET'){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
    
            $Human_getById_Result = $db->Human_getById($id);
    
            if(count($Human_getById_Result)>0){
                $apiResponse->ok($Human_getById_Result[0]);
            }else{
                $apiResponse->badRequest(array('message'=>'Invalid ID'));
            }
    
        }else{
            $apiResponse->badRequest(array('message'=>'Invalid parameters passed'));
        }
    }else if($method=='POST'){
        $requestBody = file_get_contents('php://input');
        
        $validatorResult = $validator->validateJson($requestBody);

        if($validatorResult['invalid']){
            $apiResponse->badRequest(array('message'=>$validatorResult['error']));
        }else{
            $requestObject = $validatorResult['result'];

            if(array_key_exists('first_name', $requestObject) && array_key_exists('last_name', $requestObject)){

                if(empty($requestObject['first_name']) && empty($requestObject['last_name'])){
                    $apiResponse->badRequest(array('message'=>'Invalid parameters passed'));    
                }else{

                    $db->Human_add($requestObject['first_name'], $requestObject['last_name']);
                    $apiResponse->ok(array());
                }
            }else{
                $apiResponse->badRequest(array('message'=>'Invalid parameters passed'));
            }
        }
    }else if($method=='DELETE'){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db->Human_delete($id);
            $apiResponse->ok(array());
        }else{
            $apiResponse->badRequest(array('message'=>'Invalid parameters passed'));
        }
    }else if ($method=='PUT'){
        $requestBody = file_get_contents('php://input');
        
        $validatorResult = $validator->validateJson($requestBody);

        if($validatorResult['invalid']){
            $apiResponse->badRequest(array('message'=>$validatorResult['error']));
        }else{
            $requestObject = $validatorResult['result'];

            if(array_key_exists('id', $requestObject) && array_key_exists('first_name', $requestObject) && array_key_exists('last_name', $requestObject)){

                if(empty($requestObject['id']) && empty($requestObject['first_name']) && empty($requestObject['last_name'])){
                    $apiResponse->badRequest(array('message'=>'Invalid parameters passed'));    
                }else{

                    $db->Human_updateById($requestObject['id'], $requestObject['first_name'], $requestObject['last_name']);
                    $apiResponse->ok(array());
                }
            }else{
                $apiResponse->badRequest(array('message'=>'Invalid parameters passed'));
            }
        }
    }else if($method=="OPTIONS"){
        $apiResponse->ok(array());
    }else{
        $apiResponse->methodNotAllowed(array());
    }

?>