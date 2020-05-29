<?php



/*todo :1. read comments in 1st commit
        2.read php pdo : https://www.w3resource.com/php/pdo/php-pdo.php*/

class SMSTableHandler{
    const SERVER="localhost";
    const S_NAME="root";
    const S_PASSWORD="admin";
    const DB_NAME="save_my_string_db";
    const TABLE_NAME ="strings_table";
    const COL_2 = "secret_key";
    const COL_3 = "usr_data";

    /** @var mysqli **/
    var $_conn=null;


    public function __construct(){
        $this->buildConnectionObject();
        $this->buildTable();
    }


    private function buildConnectionObject():void {
        //note the db of name DB_NAME must be created via php my admin before
        // running this function, else there will always be an error

        $server=self::SERVER;
        $server_name=self::S_NAME;
        $server_password=self::S_PASSWORD;
        $db_name=self::DB_NAME;
        $conn_successful = mysqli_connect($server,$server_name,$server_password,$db_name);
        if($conn_successful){
            $this->_conn =$conn_successful;
        }
        else {
            $this->_conn =null;
            die("Connection FAILED. ".$conn_successful->connect_error);
        }
    }
    private function closeConnectionObj():void{
        if($this->_conn != null) {
            $this->_conn->close();
            $this->_conn =null;
        }
    }

    private function buildTable() :void {
        $this->buildConnectionObject();
        $conn_object = $this->_conn;
        if($conn_object != null) {
            $name = self::TABLE_NAME;
            $col2 = self::COL_2;
            $col3 = self::COL_3;

            $sql = "CREATE TABLE IF NOT EXISTS $name (
                        $col2 VARCHAR(32) NOT NULL PRIMARY KEY,
                        $col3 VARCHAR(300) NOT NULL
                        )";
            $result = $conn_object->query($sql);
            if ($result === true) {
//                echo "build table success";

                $this->closeConnectionObj();
            } else {
//                echo("Could not execute the table creation query".$conn_object->error);
                $this->closeConnectionObj();
            }

        }

    }

    public function insertData($key,$value):bool {
        $this->buildConnectionObject();
        $conn_object = $this->_conn;
        if($conn_object===null || $conn_object->connect_error){
//            die("Could not create a connection object");
            return false;
        }
        else{

            $key = mysqli_real_escape_string($conn_object,$key);
            $value = mysqli_real_escape_string($conn_object,$value);  //for preventing sql injection. should be done for every user input
//            echo "recieved data = $key,$value";

            $name = self::TABLE_NAME;
            $col2 = self::COL_2;
            $col3 = self::COL_3;

            $query = "INSERT INTO $name ( $col2, $col3) ";
            $query= $query."VALUES ('$key' ,'$value')";
            $query= $query."ON DUPLICATE KEY UPDATE $col2='$key', $col3='$value'";
            $result_successful = mysqli_query($conn_object,$query);

            if($result_successful){
                $this->closeConnectionObj();
                return true;
            }
            else {
                $this->closeConnectionObj();
                return false;
            }

        }

    }
    public function getData($key):string {
        $this->buildConnectionObject();

        $conn_object = $this->_conn;
        if($conn_object !== null && !$conn_object->connect_error) {

            $key = mysqli_real_escape_string($conn_object, $key);

            $name = self::TABLE_NAME;
            $col_secret_key = self::COL_2;
            $col_value = self::COL_3;


            $sql = "SELECT $col_value FROM $name WHERE $col_secret_key ='$key'";
            $result = $conn_object->query($sql);

            $r = "placeholder";
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $r = $row[$col_value];
                    break;
                }
            } else {
                $r = "No results for  $key";
            }
            $this->closeConnectionObj();
            return $r;
        }

        return  "We cannot provide a search at this time, check back later";


    }
}


