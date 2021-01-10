<?php

    class APIResponse{
        function ok(array $array){
            http_response_code(200);
            echo json_encode($array);
        }
        function methodNotAllowed(array $array){
            http_response_code(405);
            echo json_encode($array);
        }
        function badRequest(array $array){
            http_response_code(400);
            echo json_encode($array);
        }
        function unauthorized(array $array){
            http_response_code(401);
            echo json_encode($array);
        }
        function internalServerError(array $array){
            http_response_code(500);
            echo json_encode($array);
        }
        function unprocessableEntity(array $array){
            http_response_code(422);
            echo json_encode($array);
        }
    }

?>