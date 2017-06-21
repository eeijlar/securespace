<?php
    abstract class FormProcessor
    {
    	static $tags = array(
        	'a'      => array('href', 'target', 'name'),
            'img'    => array('src', 'alt'),
            'b'      => array(),
            'strong' => array(),
            'em'     => array(),
            'i'      => array(),
            'ul'     => array(),
            'li'     => array(),
            'ol'     => array(),
            'p'      => array(),
            'br'     => array()
        );
         
        protected $_errors = array();
        protected $_vals = array();
        private $_sanitizeChain = null;

        public function __construct()
        {

        }

        abstract function process(Zend_Controller_Request_Abstract $request);

        public function sanitize($value)
        {
            if (!$this->_sanitizeChain instanceof Zend_Filter) {
                $this->_sanitizeChain = new Zend_Filter();
                $this->_sanitizeChain->addFilter(new Zend_Filter_StringTrim())
                                     ->addFilter(new Zend_Filter_StripTags());
            }

            // filter out any line feeds / carriage returns
            $ret = preg_replace('/[\r\n]+/', ' ', $value);

            // filter using the above chain
            return $this->_sanitizeChain->filter($ret);
        }

        public function cleanHtml($html)
        {
            $chain = new Zend_Filter();
            $chain->addFilter(new Zend_Filter_StripTags(self::$tags));
            $chain->addFilter(new Zend_Filter_StringTrim());

            $html = $chain->filter($html);

            $tmp = $html;
            while (1) {
                // Try and replace an occurrence of javascript:
                $html = preg_replace('/(<[^>]*)javascript:([^>]*>)/i',
                                     '$1$2',
                                     $html);

                // If nothing changed this iteration then break the loop
                if ($html == $tmp)
                    break;

                $tmp = $html;
            }

            return $html;
        }
        public function addError($key, $val)
        {
            if (array_key_exists($key, $this->_errors)) {
                if (!is_array($this->_errors[$key]))
                    $this->_errors[$key] = array($this->_errors[$key]);

                $this->_errors[$key][] = $val;
            }
            else
                $this->_errors[$key] = $val;
        }

        public function getError($key)
        {
            if ($this->hasError($key))
                return $this->_errors[$key];

            return null;
        }

        public function getErrors()
        {
            return $this->_errors;
        }

        public function hasError($key = null)
        {
            if (strlen($key) == 0)
                return count($this->_errors) > 0;

            return array_key_exists($key, $this->_errors);
        }

        public function __set($name, $value)
        {
            $this->_vals[$name] = $value;
        }

        public function __get($name)
        {
            return array_key_exists($name, $this->_vals) ? $this->_vals[$name] : null;
        }
        
       	public function encrypt($text,$key,$iv,$bit_check) {
			$text_num =str_split($text,$bit_check);
			$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
			for ($i=0;$i<$text_num; $i++) {$text = $text . chr($text_num);}
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $key, $iv);
			$decrypted = mcrypt_generic($cipher,$text);
			mcrypt_generic_deinit($cipher);
		return base64_encode($decrypted);
	}
    }
?>