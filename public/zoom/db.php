<?php
class DB {
    // Database credentials
    // private $dbHost     = "localhost";
    // private $dbUsername = "root";
    // private $dbPassword = "";
    // private $dbName     = "zoom_api";
    
    private $dbHost     = "172.18.2.35";
    //private $dbHost     = "27.33.2.229";
    private $dbUsername = "formeeadminuser";
    //private $dbUsername = "root";
    private $dbPassword = "ForMeeAdmin*098";
    //private $dbPassword = " #fore12EX6@";
    private $dbName     = "Formee_Admin";
 
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
  
    // Check is table empty
    public function is_table_empty() {
        $result = $this->db->query("SELECT id FROM token");
        if($result->num_rows) {
            return false;
        }
  
        return true;
    }
  
    // Get access token
    public function get_access_token() {
        $sql = $this->db->query("SELECT access_token FROM token");
        $result = $sql->fetch_assoc();
        return json_decode($result['access_token']);
    }
  
    // Get referesh token
    public function get_refersh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    // Update access token
    public function update_access_token($token) {
        $this->db->query("INSERT INTO token(access_token) VALUES('$token')");
        /*
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO token(access_token) VALUES('$token')");
        } else {
            $this->db->query("UPDATE token SET access_token = '$token' WHERE id = (SELECT id FROM token)");
        }
        */
    }
    public function update_access_token_params($token,$params) {
        /*
        $this->db->query("INSERT INTO token(access_token) VALUES('$token')");
        
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO token(access_token) VALUES('$token')");
        } else {
            $this->db->query("UPDATE token SET access_token = '$token' WHERE id = (SELECT id FROM token)");
        }
        */
        $result = $this->db->query("SELECT id FROM token where user_type='$params[1]' and userid='$params[0]'");
        if($result->num_rows) 
        {
            $this->db->query("UPDATE token SET access_token = '$token',clientid = '$params[2]',clientsecret = '$params[3]' WHERE userid = '$params[0]' and user_type = '$params[1]'");
        }
        else
        {
            $this->db->query("INSERT INTO token(access_token,clientid,clientsecret,userid,user_type) VALUES('$token','$params[2]','$params[3]','$params[0]','$params[1]')"); 
        }
    }
}
?>