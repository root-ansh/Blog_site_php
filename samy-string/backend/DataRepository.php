<?php

/*
request coming from the client will be of type:

req={ "type" : "save", "secret_key" : "key", "value" :"value" }
OR
req={"type" : "get_value", "secret_key" :"key" }

Thus the final post array becomes : $_POST[ "req"=> {k:v,k2:v2,...} ]
-----------------------------------------------------------
Response will be of type :

{success:true/false} OR {success:true/false ,user_data => "data"} OR {success:true/false ,error => "true"}
 * */

include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'SMSTableHandler.php');
function saveDataAndReturnResponse(string $key,string $value):string {
    $handler = new SMSTableHandler();
    $res = $handler->insertData($key, $value);
    if ($res) {
        $obj_success = (object)['success' => true];
        $jsonStringRespSuccess = json_encode($obj_success);
        return $jsonStringRespSuccess;
    } else {
        $obj_fail = (object)['success' => false];
        $jsonStringRespFailure = json_encode($obj_fail);
        return $jsonStringRespFailure;
    }
}

function getValueAndReturnResponse(string $key):string {
    $handler = new SMSTableHandler();
    $res = $handler->getData($key);
    $obj_data = (object)['success'=> true,'user_data' => "$res"];
    $jsonStringRespdata = json_encode($obj_data);
    return $jsonStringRespdata;
}

?>


<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json; charset=UTF-8");


$obj = json_decode($_POST["req"], false);
if($obj->type ==="save"){
    echo saveDataAndReturnResponse($obj->secret_key,$obj->value);
}
elseif ($obj->type ==="get_value"){
    echo getValueAndReturnResponse($obj->secret_key);
}
else{
     echo json_encode((object)['success' => false,"error"=>true]);
}

?>









