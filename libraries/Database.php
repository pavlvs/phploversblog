<?php
include 'config/config.inc.php';

class Database
{
    public $host = DB_HOST;
    public $username = DB_USER;
    public $password = DB_PASS;
    public $dbName = DB_NAME;

    public $db;
    public $error;

    /*
    * Class constructor
    */
    public function __construct()
    {
        // Call connect function
        $this->connect();
    }

    /*
    * Connector
    */
    private function connect()
    {
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->dbName);

        if (!$this->db) {
            $this->error = 'Connection failed: ' . $this->db->connect_error;
            return false;
        }
    }

    /**
     * Select
     */
    public function select($sql)
    {
        $result = $this->db->query($sql) or die($this->db->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Insert
     */
    public function insert($sql)
    {
        $insertRow = $this->db->query($sql) or die($this->db->error . __LINE__);

        // validate insert
        if ($insertRow) {
            header("Location: index.php?msg=" . urlencode('Record added.'));
            exit();
        } else {
            die('Error: (' . $this->db->errno . ') ' . $this->db->error);
        }
    }

    /**
     * Update
     */
    public function update($sql)
    {
        $updateRow = $this->db->query($sql) or die($this->db->error . __LINE__);

        // validate update
        if ($updateRow) {
            header("Location: index.php?msg=" . urlencode('Record updated.'));
            exit();
        } else {
            die('Error: (' . $this->db->errno . ') ' . $this->db->error);
        }
    }

    /**
     * Delete
     */
    public function delete($sql)
    {
        $deleteRow = $this->db->query($sql) or die($this->db->error . __LINE__);

        // validate delete
        if ($deleteRow) {
            header("Location: index.php?msg=" . urlencode('Record deleted.'));
            exit();
        } else {
            die('Error: (' . $this->db->errno . ') ' . $this->db->error);
        }
    }
}
