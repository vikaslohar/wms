<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class DB_Connect {
    private $conn_main;
	private $conn_vnr;
	private $conn_ps;
    // Connecting to database
    public function connect_main() {
        require_once 'include/Config.php';
        
        // Connecting to mysql database
        $this->conn_main = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_MAIN);
        
        // return database handler
        return $this->conn_main;
    }
	 public function connect_vnr() {
        require_once 'include/Config.php';
        
        // Connecting to mysql database
        $this->conn_vnr = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_VNR);
        
        // return database handler
        return $this->conn_vnr;
    }
	 public function connect_ps() {
        require_once 'include/Config.php';
        
        // Connecting to mysql database
        $this->conn_ps = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_PS);
        
        // return database handler
        return $this->conn_ps;
    }
}

?>
