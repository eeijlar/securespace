<?php
    function smarty_function_imagefilename($params, $smarty)
    {
        require_once $smarty->_get_plugin_filepath('function', 'geturl');
		
		if(!isset($params['id']))
			$params['id'] = 0;

        $options = array(
            'controller' => 'utility',
            'action'     => 'image'
        );

        return sprintf(
            '%s?id=%d',
            smarty_function_geturl($options, $smarty),
            $params['id']
        );
    }
?>