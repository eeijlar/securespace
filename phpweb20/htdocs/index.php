<?php
    	
    require_once('Zend/Loader.php');
    Zend_Loader::registerAutoload();
    	
    // load the application configuration
    $config = new Zend_Config_Ini('../settings.ini', 'development');
    Zend_Registry::set('config', $config);

    // create the application logger
    $logger = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
    Zend_Registry::set('logger', $logger);
    
    try {
	
    // connect to the database
    $params = array('host'     => $config->database->hostname,
                    'username' => $config->database->username,
                    'password' => $config->database->password,
                    'dbname'   => $config->database->database);

    $db = Zend_Db::factory($config->database->type, $params);
    Zend_Registry::set('db', $db);


    // setup application authentication
    $auth = Zend_Auth::getInstance();
    $auth->setStorage(new Zend_Auth_Storage_Session());

    // handle the user request
    $controller = Zend_Controller_Front::getInstance();
    $controller->setControllerDirectory($config->paths->base .
                                        '/include/Controllers');
    $controller->registerPlugin(new CustomControllerAclManager($auth));
    $controller->throwExceptions(true);

    // setup the view renderer
    $vr = new Zend_Controller_Action_Helper_ViewRenderer();
    $vr->setView(new Templater());
    $vr->setViewSuffix('tpl');
    Zend_Controller_Action_HelperBroker::addHelper($vr);
    $controller->dispatch();
    }
    
    catch (Exception $ex) {
        $logger->emerg($ex->getMessage());

        header('Location: /error.html');
        exit;
    }
?>
