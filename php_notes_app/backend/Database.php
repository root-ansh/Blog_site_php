<?php /** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnused */
/** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnusedPrivateMethodInspection */
/** @noinspection PhpUnusedLocalVariableInspection */
/** @noinspection SqlNoDataSourceInspection */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 todo:
    1.  builder pattern for tablequeries: i think a table object would work:{t_name = "<>", cols = {}
    2.  encryption prevention from sql injection
    3. use bind parameters for mysqli to prevent injections :https://stackoverflow.com/a/60496/7500651
    4. update is working badly
    5. something crazy: alternative project:. remove all the class crap. make it super functional and responsive.
       like, remove  classes/shared vars, there will be only functions and every function will create conn object /db/tables
        , perform operation, genrate reponse ad fuckung return it! to make it worse, make no responses but directly code html in php and make it as current page.
     super repetiion. that would increase speeds i guess
    6. manage email and password size on the front end. my email is 34 chars long and wo varchar(32)cols ko faad deta h
 * */


//========================helpers================================
function returnConnectOrDie():mysqli{
    $HOST = "localhost"; $USER = "root"; $PWD = "admin" ; $DB_NAME = "login_notes";
    $conn = new mysqli($HOST, $USER, $PWD);
    if ($conn->error) {
        die("die : Connection failed: " . $conn->error);
    }

    $db_available = $conn->select_db($DB_NAME);
    if($db_available){
        printCool("DB Already exists");
        return $conn;
    }

    $sql = "CREATE DATABASE $DB_NAME";
    $db_query_result = $conn->query($sql);

    if ($db_query_result) {
        printCool("Database $DB_NAME created successfully");
        $conn->select_db($DB_NAME);
        return $conn;
    }
    else {
        printCool("Error creating database:" . $conn->connect_error);
        die("die: Error creating database:" . $conn->connect_error);
    }



}
function printCool(...$args){
//    $s = "<br>";
//    foreach ($args as $i){
//        $s.=$i."<br>";
//    }
//    echo $s;
}
function gen_uuid_32char():string {
    $val = sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
    printCool("new id generated:$val");
    return $val;

}
function getCurrentTimeStamp():int{
    return time();
}
function timeStampToString(int $time):string {
    return ''.date('Y-m-d H:i:s', $time);
}
function getResponseForSingleRowArrQuery(string $sql, mysqli $conn, string $resp_key,string $resp_val):string {
    $query_res =$conn->query($sql);
    if($query_res){
        while ($row = $query_res->fetch_assoc()){

            $resp_val =$row;
            return json_encode([$resp_key=>$resp_val]);
        }
        $resp_val =null;
        return json_encode([$resp_key=>$resp_val]);
    }
    else{
        printCool("error occured for query:".$conn->error);
    }

    $resp_val =null;
    return json_encode([$resp_key=>$resp_val]);


}

class TableHandler{
    //============================<variables>======================================
    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    private string $TABLE1_NAME = "users";
    private string $T1_COL_1P = "uid",      $T1_ATTRS_1P = "VARCHAR(255)  NOT NULL ";
    private string $T1_COL_2  = "email",    $T1_ATTRS_2  = "VARCHAR(255) NOT NULL";
    private string $T1_COL_3  = "password", $T1_ATTRS_3  = "VARCHAR(255) NOT NULL";
    //------------------------------------------------------------------------
    private string $TABLE2_NAME = "notes";

    private string $T2_COL_1P = "nid",      $T2_ATTRS_1P = "VARCHAR(255) NOT NULL ";
    private string $T2_COL_2 = "timestamp", $T2_ATTRS_2  = "VARCHAR(255) NOT NULL";
    private string $T2_COL_3 = "note",      $T2_ATTRS_3  = "MEDIUMTEXT   NOT NULL";

    //--------------------------------------------------------------------------
    private string $TABLE_REL_NAME = "rel";
    //details in creation only
    //============================</variables>======================================
    public function __construct(){

        if ($this->buildTablesIfNotExist()) {
            printCool( "Successfully created all tables");
            printCool("=============constructor_close=============================");
        } else {
            die("die:Could not create all tables.");
        }

    }

    private function buildTablesIfNotExist(): bool{
        $conn =returnConnectOrDie();
        $sqlT1  = "CREATE TABLE IF NOT EXISTS   $this->TABLE1_NAME    ($this->T1_COL_1P   $this->T1_ATTRS_1P ,$this->T1_COL_2    $this->T1_ATTRS_2 ,$this->T1_COL_3    $this->T1_ATTRS_3,  PRIMARY KEY($this->T1_COL_1P) )";
        $sqlT2  = "CREATE TABLE IF NOT EXISTS   $this->TABLE2_NAME    ($this->T2_COL_1P   $this->T2_ATTRS_1P ,$this->T2_COL_2    $this->T2_ATTRS_2  ,$this->T2_COL_3    $this->T2_ATTRS_3, PRIMARY KEY($this->T2_COL_1P))";
        $sqlRel = "CREATE TABLE IF NOT EXISTS   $this->TABLE_REL_NAME ($this->T1_COL_1P   $this->T1_ATTRS_1P ,$this->T2_COL_1P   $this->T2_ATTRS_1P ,                                      PRIMARY KEY($this->T1_COL_1P,$this->T2_COL_1P))";

        $q1Result = $conn->query($sqlT1);

        if ($q1Result) {
            printCool("successfully build table $this->TABLE1_NAME");
        } else {
            printCool("echo :table 1 creation failed:" . ($conn->error) );
            die("echo :table 1 creation failed:" . ($conn->error) );
        }

        $q2Result = $conn->query($sqlT2);

        if ($q2Result) {
            printCool("successfully build table $this->TABLE2_NAME");
        } else {
            printCool("echo :table 2 creation failed:" . ($conn->error) );
            die("echo :table 2 creation failed:" . ($conn->error) );
        }

        $q3Result = $conn->query($sqlRel);

        if ($q3Result) {
            printCool("successfully build table $this->TABLE_REL_NAME");
        
            return true;
        } else {
            printCool("echo :table 3 creation failed:" . ($conn->error));
            die("echo :table 3 creation failed:" . ($conn->error));
        }

    }                               //not returning json

    //user related
    private function checkIfUserExists(string $email,string $pwd):bool{
        $conn =returnConnectOrDie();
        $query = "
                SELECT * FROM $this->TABLE1_NAME 
                    WHERE $this->T1_COL_2 = '$email' AND $this->T1_COL_3 = '$pwd'
        ";
        $sqliResult = $conn->query($query);

        if(!$sqliResult){
            printCool("error happened :".$conn->error);
        
            return false;
        }
    
        return $sqliResult->num_rows >0;

    }
    public function getIdFromExistingUserDetails($email,$pwd):string {
        $conn=returnConnectOrDie();
        $query =
            "SELECT $this->T1_COL_1P FROM $this->TABLE1_NAME  
                    WHERE $this->T1_COL_2 = '$email' AND $this->T1_COL_3 = '$pwd'";

        $sqliResult = $conn->query($query);
        if(!$sqliResult){
            printCool("error happened :".$conn->error);
            return "error";
        }

        while ($row = $sqliResult->fetch_assoc()) {
        
            return $row[$this->T1_COL_1P]; //return id of first result
        }
    
        return "no entries found";
    }             //not returning json

    private function checkIfUserIDExists(string $user_id):bool{
        $conn = returnConnectOrDie();
        $query = "SELECT * FROM $this->TABLE1_NAME WHERE $this->T1_COL_1P = '$user_id' ";
        $sqliResult = $conn->query($query);

        if(!$sqliResult){
            printCool("error happened :".$conn->error);
            return false;
        }
        
        printCool($sqliResult->num_rows);

        return ($sqliResult->num_rows ) >= 1; //if there are more than 1 rows that means we user id exists

    }  //not returning json
    public function  getUserDetailsFromID(string $user_id):string {
        $conn =returnConnectOrDie();
        $sql = "SELECT * FROM $this->TABLE1_NAME  WHERE $this->T1_COL_1P = '$user_id'";
        $resp_key = "user_details";
        $resp_val = "{}";
        return getResponseForSingleRowArrQuery($sql,$conn,$resp_key,$resp_val);

    }

    private function createNewUserAndReturnID($email,$pwd):string {
        $conn=returnConnectOrDie();

        $userid = gen_uuid_32char();
        $sql = sprintf(
            "INSERT INTO %s (%s, %s, %s) VALUES ('%s', '%s', '%s')",
                        $this->TABLE1_NAME, $this->T1_COL_1P, $this->T1_COL_2, $this->T1_COL_3,
                        $userid, $email, $pwd);

        $sqlResult = $conn->query($sql);

        if($sqlResult){
        
            return  $userid;
        }
        else{
            printCool("error happened :".$conn->error);
        
            return "error:$conn->error";
        }

    }                //not returning json

    public function login(string $email, string $pwd):string {                  //not returning json
        if($this->checkIfUserExists($email,$pwd)){
            $id= $this->getIdFromExistingUserDetails($email,$pwd); //id
        }
        else{
            $id= "error";
        }
        return $id;


    }
    public function signUp(string $email, string $pwd):string {                  //not returning json
//        if($this->checkIfUserExists($email,$pwd)){
//            $id= "error"; //$this->getIdFromExistingUserDetails($email,$pwd); // it should rather give the exists key but this is also alrighty
//        }
//        else{
//            $id =  $this->createNewUserAndReturnID($email,$pwd);
//        }
        $id =  $this->createNewUserAndReturnID($email,$pwd);
        return $id;// "{signup_resp:$str}";
    }

    private function updateOrInsertUserDetails($userid,$new_email,$new_password){
        //todo
//        $conn =returnConnectOrDie();
//        $sql= sprintf(
//            "INSERT INTO %s (%s, %s, %s) VALUES('%s', '%s', '%s') ON DUPLICATE KEY UPDATE    %s='%s', %s ='%s'",
//            $this->TABLE1_NAME, $this->T1_COL_1P, $this->T1_COL_2, $this->T1_COL_3,
//            $userid, $new_email, $new_password,
//            $this->T1_COL_2, $new_email,
//            $this->T1_COL_3, $new_password
//        );
//        $sqlResult = $conn->query($sql);
//
//        if($sqlResult){
//            return  json_encode(["update"=>"success"]);
//        }
//        else{
//            printCool("error happened :".$conn->error);
//
//            return json_encode(["update"=>"error"]);
//
//        }

    }
    public function removeUserByID($uid):string {
        $conn =returnConnectOrDie();
        //todo:
        //  $sql0 = select nid from table rel where uid = userid
        //  $sql1 = delete from table 2 where nid = [results of sql0]

        $sql2 =" DELETE FROM $this->TABLE_REL_NAME WHERE $this->T1_COL_1P = '$uid' ";
        $sqliResult = $conn->query($sql2);
        if(!$sqliResult){
            printCool("error happened :".$conn->error);
        
            return json_encode(["remove_user_resp"=>"error happenned"]);
        }

        $sql3 =" DELETE FROM $this->TABLE1_NAME WHERE $this->T1_COL_1P = '$uid' ";
        $sqliResult = $conn->query($sql3);
        if(!$sqliResult){
            printCool("error happened :".$conn->error);
        
            return json_encode(["remove_user_resp"=>"error happenned"]);
        }

    
        return json_encode(["remove_user_resp"=>true]);//"{remove_user_resp:true}";

    }

    //note(only) related
    private function getNoteDetailByNoteID($note_id){
        $resp_key = "note";
        $resp_val = "[]";
        $conn =returnConnectOrDie();

        $sql = "SELECT * FROM $this->TABLE2_NAME WHERE $this->T2_COL_1P = '$note_id' ";
        return getResponseForSingleRowArrQuery($sql,$conn,$resp_key,$resp_val);
    }
    private function removeNoteByNoteID($note_id){
        //todo
    }
    
    //note AND USER Related
    public function createNewNoteForUser($user_id, $note_text):string {
        $resp_key = "create_note_resp";
        $resp_val = false;
        //= adding relation into
        $conn = returnConnectOrDie();

        $userExists=$this->checkIfUserIDExists($user_id);
        printCool("user exists= $userExists");

        if($userExists){
            $note_id = gen_uuid_32char();
            $time = ''.time();
            $conn->begin_transaction();


            $sql_prep_stmt_1 = $conn->prepare("INSERT INTO $this->TABLE_REL_NAME ($this->T1_COL_1P,$this->T2_COL_1P) VALUES (?,?)");
            $sql_prep_stmt_2 = $conn->prepare("INSERT INTO $this->TABLE2_NAME ($this->T2_COL_1P, $this->T2_COL_2, $this->T2_COL_3) VALUES (?, ?, ?)");
            $sql_prep_stmt_1->bind_param("ss", $user_id, $note_id);
            $sql_prep_stmt_2->bind_param("sss", $note_id, $time,$note_text);

            $res1 = $sql_prep_stmt_1->execute();
            $res2 = $sql_prep_stmt_2->execute();


            if($res1 && $res2){
                printCool("Transaction successful. commiting ");
                $conn->commit();
            
                $resp_val=true;
                return json_encode([$resp_key=>$resp_val]);
            }
            else{
                printCool("Transaction failed for either 1st or 2nd query. rolling back".($conn->error_list));
                $conn->rollback();
            
                $resp_val =false;
                return json_encode([$resp_key=>$resp_val]);
            }

        }
        else{
            printCool("user does not exist");
            $resp_val=false;
            return json_encode([$resp_key=>$resp_val]);

        }



    }
    public function updateNote($userid,$noteid, $new_text){
        //todo
        //note: not checking if the relation exists or not.
    }
    public function  removeParticularNoteByID($user_id,$_note_id){
        //todo
    }
    public function removeAllNotesForUserID($user_id){
        //todo
    }
    
    public function getAllNotesForUserID($user_id):string {
        $resp_key = "all_notes_list";
        $resp_val = null;//or "{a:b,... array of notes obj}";
        $conn =returnConnectOrDie();

        $sql1 = "SELECT $this->T2_COL_1P FROM $this->TABLE_REL_NAME WHERE $this->T1_COL_1P = '$user_id'";

        $query_res = $conn->query($sql1);
        if($query_res){
            $resp_val =[];
            while ($row = $query_res->fetch_assoc()){ //$row= [nid=>sfedgrt435]
                $curr_note_id = $row[$this->T2_COL_1P];
                $note_for_curr_id = $this->getNoteDetailByNoteID($curr_note_id) ;
                $note_decoded = json_decode($note_for_curr_id,true);
                $note_value_decoded = json_decode($note_for_curr_id,true)["note"]; //using key of getNoteByIDTo get response
                array_push($resp_val,$note_value_decoded);
            }
            return json_encode([$resp_key=>$resp_val]);
        }
        else{
            printCool("error retrieving notes ids from rel:".$conn->error);
            return json_encode([$resp_key=>$resp_val]);
        }

    }
    public function getUserDetailsAndAllNotesByID($userID):string {
        $user_details =$this->getUserDetailsFromID($userID);
        $notes_list = $this->getAllNotesForUserID($userID);

        return
            "{
                {$user_details} ,
                {$notes_list}
            }";

    } //warning :json decode every query except this. use it a straigh string
    
    //not much useful
    public function checkIFNoteExists(string $user_id,string $note_id){
        $conn = returnConnectOrDie();
        $query = "SELECT * FROM $this->TABLE_REL_NAME WHERE $this->T1_COL_1P = '$user_id' AND $this->T2_COL_1P = '$note_id'";
        $sqliResult = $conn->query($query);

        if(!$sqliResult){
            printCool(">>>error happened :".$conn->error);
        
            return false;
        }
    
        return $sqliResult->num_rows >0;

    }
    
}





