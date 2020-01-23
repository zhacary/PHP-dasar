<?php 
    class DB{
        protected $connection;
        protected $query;

        //cukup ubah disini saja jika berpindah server
        var $dbhost = "localhost";
        var $dbname = "member";
        var $dbuser = "root";
        var $dbpass = "";
        var $dbcharset = "utf8";

        public function __construct(){
            $this->connection = new mysqli($this->dbhost, 
                                            $this->dbuser,
                                            $this->dbpass,
                                            $this->dbname);
            if($this->connection->connect_error){
                die("Error connection: ".$this->connection->connect_error);
            }

            $this->connection->set_charset($this->dbcharset);
        }


    function query($query){
        if($this->query = $this->connection->prepare($query)){
            $this->query->execute();

            if($this->query->errno){
                die("Error execution: ".$this->query->error);
            }
        }else{
            die("Error execution: ".$this->query->error);
        }
    }

    function getList($query){
        if($this->query = $this->connection->prepare($query)){
            $this->query->execute();

            $result = $this->query->get_result();

            if($this->query->errno){
                // return "error";
                die("Error execution: ".$this->query->error);
            }else{
                $parameters = array();

                while($row = $result->fetch_array()){
                    $parameters[] = $row;
                }

                return $parameters;
            }
        }else{
            die("Error execution: ".$this->query->error);
        }
    }
    
    function close(){
        return $this->connection->close();
    }
}

?>