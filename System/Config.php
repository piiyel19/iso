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
			$servername = "mariadb";
			$username = "root";
			$password = "12345";
			$dbname = "iso";

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
			return 'iso';
		}


		function folder_project()
		{
			$folder_project = 'iso';
			return $folder_project;
		}

		function root_source()
		{
			$root_source = $_SERVER['DOCUMENT_ROOT'];
			//return $root_source.'/'.$this->folder_project();
			return $root_source;
		}

		function base_url()
		{
			$base = 'http://207.154.248.170/';
			// $base_url = $base.$this->folder_project().'/';
			$base_url = $base;
			return $base_url;
		}


		function redirect($path)
		{
			header("Location: http://207.154.248.170/".$path); 
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