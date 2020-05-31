<?php 
    class Database{
        public $host = DB_HOST;
        public $username = DB_USER;
        public $password = DB_PASS;
        public $dbname = DB_NAME;
        
        public $link;
        public $error;
        
        
        //Class Constructor
        public function __construct(){
            //Call Connect function
            $this->connect();
        }
        
        //Connector
        private function connect(){
            $this->link = new mysqli($this->host,$this->username,$this->password,$this->dbname);
            
            if(!$this->link){
                $this->error = "Connection failed".$this->link->connect_error;
                return false;
            }
                
        }
        
        public function select($query){
            $result = $this->link->query($query) or die($this->link->error.__LINE__);
            if($result->num_rows > 0){
                return $result;
            }
            else{
                return false;
            }
        }
        
        public function insert($query){
            $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
            
            //Validate the insert
            if($insert_row){
                header('Location: index.php?msg='.urlencode('Record_added'));
                exit();
            }
            
            else{
                die('error');
            }
        }
        
        public function update($query){
            $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
            
            //Validate the insert
            if($update_row){
                header('Location: index.php?msg='.urlencode('Record updated'));
                exit();
            }
            else{
                die('Error: ('.$this->link->errno.')'.$this->link->error);
            }
        }
        
        public function delete($query){
            $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
            
            //Validate the insert
            if($delete_row){
                header('Location: index.php?msg='.urlencode('Record_deleted'));
                exit();
            }
            else{
                die('Error: ('.$this->link->errno.')'.$this->link->error);
            }
        }
        
        
        
    }
?> 