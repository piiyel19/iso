<?php if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
    class Config{
        function url(){
			$protocole = $_SERVER['REQUEST_SCHEME'].'://';
			$host = $_SERVER['HTTP_HOST'] . '/';
			$project = explode('/', $_SERVER['REQUEST_URI'])[1];
			return $protocole . $host . $project;
		}



		function database()
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "test_framework";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
			  die("Connection failed: " . mysqli_connect_error());
			}	

			return $conn;

		}


		function database_name()
		{
			return 'test_framework';
		}


		function folder_project()
		{
			$folder_project = 'piiyel19';
			return $folder_project;
		}

		function root_source()
		{
			$root_source = $_SERVER['DOCUMENT_ROOT'];
			return $root_source.'/'.$this->folder_project();
		}

		function base_url()
		{
			$base = 'http://localhost/';
			$base_url = $base.$this->folder_project();
		}


		function redirect($path)
		{
			header("Location: http://localhost/piiyel19/".$path); 
            exit; // <- don't forget this!
		}



		function api_key()
		{
			return '123';
		}


		function view()
		{
			$source = $this->root_source();
			$source = $source.'/views/templates/ui-bank/';
			return $source;
		}

        
    }
        
?>