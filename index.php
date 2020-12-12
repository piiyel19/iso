<?php

    $url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'],'/')) : '/';

    //var_dump($_SERVER['DOCUMENT_ROOT']); exit();

    /* SET SYSTEM REQUIREMENT */
    include_once('System/Config.php');
    $config = '';
    $base_url = '';
    $root = '';
    $config = new Config();
    $root = $config->root_source();
    $base_url = $config->base_url();
    //var_dump($root.'/Views/templates/ui-engine/Template.php');exit();
    include_once($root.'/System/Query.php');
    include_once($root.'/System/Security.php');
    include_once($root.'/Views/templates/ui-engine/Template.php'); 
    include_once($root.'/System/View.php');
    include_once($root.'/System/BlockChain.php');
    include_once($root.'/Migrations/Migration.php');
    /* END */



    //var_dump($url[0]); //exit();
    
    if ($url[0] == '')
    {
        //echo 'a';
        // This is the home page
        // Initiate the home controller
        // and render the home view

        require_once __DIR__.'/Models/index_model.php';
        require_once __DIR__.'/Controllers/index_controller.php';
        require_once __DIR__.'/Views/index_view.php';

        $indexModel = New IndexModel();
        $indexController = New IndexController($indexModel);
        $indexView = New IndexView($indexController, $indexModel);

        

        print $indexView->index();

    }else{
        
        
        // This is not home page
        // Initiate the appropriate controller
        // and render the required view

        //The first element should be a controller
        $requestedController = $url[0]; 

        // If a second part is added in the URI, 
        // it should be a method
        $requestedAction = isset($url[1])? $url[1] :'';

        // The remain parts are considered as 
        // arguments of the method
        $requestedParams = array_slice($url, 2); 

        // Check if controller exists. NB: 
        // You have to do that for the model and the view too
        $ctrlPath = __DIR__.'/Controllers/'.$requestedController.'_controller.php';


        



        if (file_exists($ctrlPath))
        {

            require_once __DIR__.'/Models/'.$requestedController.'_model.php';
            require_once __DIR__.'/Controllers/'.$requestedController.'_controller.php';
            require_once __DIR__.'/Views/'.$requestedController.'_view.php';

            $modelName      = ucfirst($requestedController).'Model';
            $controllerName = ucfirst($requestedController).'Controller';
            $viewName       = ucfirst($requestedController).'View';

            $controllerObj  = new $controllerName( new $modelName );
            $viewObj        = new $viewName( $controllerObj, new $modelName );


            // If there is a method - Second parameter
            if ($requestedAction != '')
            {
                // then we call the method via the view
                // dynamic call of the view
                print $viewObj->$requestedAction($requestedParams);

            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The file - '.$ctrlPath.' - not found');
            //require the 404 controller and initiate it
            //Display its view
        }
    }
