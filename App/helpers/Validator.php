<?php

    class Validator{
        function validateJson(string $jsonString){
            $result = json_decode($jsonString, true);
            $invalid = false;
            $error = '';
            switch(json_last_error()){
                case JSON_ERROR_DEPTH:
                    $invalid=true;
                    $error = 'The maximum stack depth has been exceeded.';
                break;
                case JSON_ERROR_STATE_MISMATCH:
                    $invalid = true;
                    $error = 'Invalid or malformed JSON.';
                break;
                case JSON_ERROR_CTRL_CHAR:
                    $invalid = true;
                    $error = 'Control character error, possibly incorrectly encoded.';
                break;
                case JSON_ERROR_SYNTAX:
                    $invalid = true;
                    $error = 'Syntax error, malformed JSON.';
                break;
                case JSON_ERROR_UTF8:
                    $invalid = true;
                    $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
                case JSON_ERROR_RECURSION:
                    $invalid = true;
                    $error = 'One or more recursive references in the value to be encoded.';
                break;
                case JSON_ERROR_INF_OR_NAN:
                    $invalid = true;
                    $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    $invalid = true;
                    $error = 'A value of a type that cannot be encoded was given.';
                break;
                case JSON_ERROR_NONE:
                    $invalid = false;
                    $error = 'No errors';
                break;
                default:
                    $invalid = true;
                    $error = 'Unknown JSON error occured';
                break;
            }
            if(!is_array($result)){
                $error='Not a valid JSON object';
                $invalid=true;
            }
            $return = array('result'=>$result,'invalid'=>$invalid,'error'=>$error);
            return $return;
        }
    }

?>