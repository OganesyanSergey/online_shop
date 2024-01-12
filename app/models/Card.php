<?php
	
	class Card extends DataBase {
		// Properties
		
		// Methods
		public function __construct()
		{
			$this->table_name = 'card';
			parent::__construct();
		}
	}
	
?>