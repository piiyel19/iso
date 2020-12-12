<?php if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
    class View{
        function templates($file, $vars) {
            ob_start();
            extract($vars);
            //var_dump($file );
            include '/home/www-data/www/projects/iso/views/templates/' . $file . '.php';
            $buffer = ob_get_contents();
            ob_end_clean();
            return $buffer;
        }

        
    }
        
?>