<?php

	class DataBase {
		// Properties
		public $con;
		protected $table_name;
		protected $sql_str;
		public $query;
		
		// Methods
		protected function __construct()
		{
			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if ($this->con->connect_errno) {
				echo "Failed to connect to MySQL: " . $this->con->connect_error;
				exit();
			}
		}
		
		// Clean Post
		public function cleanPost($data)
		{
			$data = trim($data);
			$data = htmlspecialchars($data);
			$data = mysqli_real_escape_string($this->con, $data);
			return $data;
		}
		
		// SELECT
		public function select()
		{
			$this->sql_str = 'SELECT * FROM ' . $this->table_name;
			return $this;
		}
		
		// JOIN
		public function join($table_name)
		{
			$foreign_key = ''. substr_replace($table_name ,"",-1) . '_id';
			$this->sql_str .= ' JOIN '. $table_name . ' ON ' . $this->table_name . '.' . $foreign_key . ' = ' . $table_name . '.id';
			return $this;
		}
		
		// WHERE
		public function where($field_name, $operator, $value) 
		{
			if (strpos($this->sql_str, 'WHERE') === false) {
				$this->sql_str .= " WHERE " . $field_name . $operator . "'" . $value . "'";
			} else {
				$this->sql_str .= " AND " . $field_name . $operator . "'" . $value . "'";
			}
			
			return $this;
		}
		
		// num_rows
		public function numRows() 
		{
			$num = mysqli_num_rows($this->query);
			return $num;
		}
		
		// fetch_row
		public function fetch_row()
		{
			$fetch = mysqli_fetch_assoc($this->query);
			return $fetch;
		}
		
		// fetch_all
		public function fetch_all()
		{
			$array = [];
			while($fetch = mysqli_fetch_assoc($this->query)){
				array_push($array, $fetch);
			}
			return $array;
		}
		
		// Order By
		public function order($fild , $by) 
		{
			$this->sql_str .= " ORDER BY " . $fild . " " . $by;
			return $this;
		}
		
		// Insert 
		public function insert($data)
		{
			$string = "INSERT INTO ".$this->table_name." (";
			$string .= implode(",", array_keys($data)) . ') VALUES (';
			$string .= "'" .implode("','", array_values($data)) . "')";
			$this->sql_str = $string;
			
			return $this;
		}
		
		// Delete
		public function delete_row()
		{
			$this->sql_str = "DELETE FROM " . $this->table_name; 
			return $this;
		}
		
		// Edite
		public function update_row($data)
		{
			if (array_is_list($data) == false) {
				$string = "UPDATE ".$this->table_name." SET ";
				$keys = array_keys($data);
				foreach($keys as $index => $key) {
					$string .= "$key = '$data[$key]', ";
				}
				$string = rtrim($string, " ,");
				$this->sql_str = $string;
			} else {
				foreach ( $data as $key => $value ) { 
					$key++;
					$string = "UPDATE ".$this->table_name." SET ";
					$string .= "order_by_num = '$key', ";
					$string = rtrim($string, " ,");
					$string .= " WHERE id = '$value'";
					$this->sql_str = $string;
					$update = mysqli_query($this->con, $this->sql_str);
					$string = '';
				}
				
			}
		
			return $this;
		}
		
		// Вывод значения
		public function execute()
		{
			$this->query = mysqli_query($this->con, $this->sql_str);

			return $this;
		}

	}

?>