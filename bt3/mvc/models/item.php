<?php

class Item
{
	protected $conn = null;
	protected $result = null;

	protected $tablename = 'mytable';

	protected $dbhost = 'localhost';
	protected $dbuser = 'root';
	protected $dbpass = '123456aA!';
	protected $db = 'data';

    public function __construct()
    {
        $this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
        if (!$this->conn) {
            echo 'Connection Failed!' . '<br/>';
            exit();
        } else {
            mysqli_select_db($this->conn, $this->db);
            mysqli_query($this->conn, "SET NAMES 'utf8'");
        }

        $sql = 'CREATE TABLE '. $this->tablename . ' (id int(6) AUTO_INCREMENT, title varchar(50), description varchar(50), image varchar(50), status int NOT NULL, create_at datetime NOT NULL, update_at datetime, PRIMARY KEY (id))';
        /*
        if (mysqli_query($this->conn, $sql)){
        	echo 'Tabe create success!' . '<br/>';
        }
        else{
        	echo 'Error: ' . $this->conn->error;
        }
        */

    }

	public function execute($sql){
		$this->result = $this->conn->query($sql);
		return $this->result;
	}

	public function num_rows(){
		if ($this->result){
			$num = mysqli_num_rows($this->result);
		}
		else{
			$num = 0;
		}
		return $num;
	}

	public function getData(){
		$sql = 'SELECT * FROM '. $this->tablename;
		$res = $this->execute($sql);
		if ($this->num_rows() == 0){
			return 0;
		}
		else {
			while ($row = mysqli_fetch_array($res)){
				$data[] = $row;
			}
		}
		return $data;
	}

	public function insertData($title, $description, $image, $status){
		$create_at = date('Y-m-d H:i:s');
		$update_at = date('Y-m-d H:i:s');
		$sql = 'INSERT INTO '. $this->tablename . " (title, description, image, status, create_at, update_at) VALUES ('$title', '$description', '$image', '$status', '$create_at', '$update_at')";
		echo $sql;
		return $this->execute($sql);  
	}

	public function updateData($id, $title, $description, $image, $status){
		$create_at = date('Y-m-d H:i:s');
		$update_at = date('Y-m-d H:i:s');
		$sql = "UPDATE ". $this->tablename . " SET title = '$title', description = '$description', image = '$image', status = '$status', create_at = '$create_at', update_at = '$update_at' WHERE id = '$id'";
		return $this->execute($sql);
	}

	public function deleteData($id){
		$sql = 'DELETE FROM '. $this->tablename . " WHERE id = '$id'";

		return $this->execute($sql);
	}

	public function getSingleData($id){
		$sql = 'SELECT * FROM ' . $this->tablename . " WHERE id = '$id'";
		$result = $this->execute($sql);

		if ($this->num_rows() == 0){
			return 0;
		}

		$data[] = mysqli_fetch_array($result);
		return $data;
	}

	public function getPageData($item_per_page, $offset){
		$sql = 'SELECT * FROM ' . $this->tablename . " ORDER BY 'id' ASC LIMIT " . $item_per_page . " OFFSET " . $offset;
		return $this->execute($sql);
	}

}
?>
