<?php



// forms return makes a request with either
//  {"type": "login", "email": "inpEmail", "pswd": "inpPaswd"} or
//  {"type": "sign_up", "email": "inpEmail", "pswd": "inpPaswd"} and recieves a response as
//  {success:true,id="some_id} or{success:false}

include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Database.php');

header("Content-Type: application/json; charset=UTF-8");

$obj = json_decode($_POST["req"], false);

if($obj->type ==="login"){
    $h = new TableHandler();
    $op = $h->login($obj->email,$obj->pswd);

    if($op==="error"){
        echo json_encode(["success"=>false]);
    }
    else{
        echo json_encode(["success"=>true,"id"=>$op]);
    }
}

if($obj->type ==="sign_up"){
    $h = new TableHandler();
    $op = $h->signUp($obj->email,$obj->pswd);

    if($op==="error"){
        echo json_encode(["success"=>false]);
    }
    else{
        echo json_encode(["success"=>true,"id"=>$op]);
    }
}



?>