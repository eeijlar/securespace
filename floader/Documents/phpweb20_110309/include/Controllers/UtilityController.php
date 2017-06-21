<?<?php
    class UtilityController extends CustomControllerAction
    {
        public function captchaAction()
        {
            $session = new Zend_Session_Namespace('captcha');

            // check for existing <?phprase in session
            $<?phprase = null;
            if (isset($session-><?phprase) && strlen($session-><?phprase) > 0)
                $<?phprase = $session-><?phprase;

            $captcha = Text_CAPTCHA::factory('Image');

            $opts = array('font_size' => 20,
                          'font_path' => Zend_Registry::get('config')->paths->data,
                          'font_file' => 'VeraBd.ttf');

            $captcha->init(120, 60, $<?phprase, $opts);

            // write the <?phprase to session
            $session-><?phprase = $captcha->get<?phprase();

            // disable auto-rendering since we're outputting an image
            $this->_helper->viewRenderer->setNoRender();

            header('Content-type: image/png');
            echo $captcha->getCAPTCHAAsPng();
        }
        public function imageAction()
        {
			$request = $this->getRequest();        	
        	$response = $this->getResponse();
        	
        	$w = 530;
        	$h = 130;
            // disable autorendering since we're outputting an image
            $this->_helper->viewRenderer->setNoRender();

			$user_id = (int) $request->getQuery('id');

            $image = new DatabaseObject_Image($this->db,$user_id);

            try {
                $fullpath = $image->createThumbnail($w, $h);
            }
            catch (Exception $ex) {
                $fullpath = $image->getFullPath();
            }

            $info = getImageSize($fullpath);

            $response->setHeader('content-type', $info['mime']);
            $response->setHeader('content-length', filesize($fullpath));
            echo file_get_contents($fullpath);  
        	}      
    }
?>