<?php
    class FormProcessor_SmeImage extends FormProcessor
    {
        protected $user_id;
        public $image;
        protected $_uploadedFile;   
        public $fullPath;
        public $altTitle;

        public function __construct($db, $user_id)
        {
            parent::__construct();

            $this->db = $db;

            $this->user = new DatabaseObject_User($db);
            $this->user->load($user_id);
						
        }

        public function process(Zend_Controller_Request_Abstract $request)
        {
            if (!isset($_FILES['image']) || !is_array($_FILES['image'])) {
                $this->addError('image', 'Invalid upload data');
                return false;
            }

            $file = $_FILES['image'];

            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    // success
                    break;

                case UPLOAD_ERR_FORM_SIZE:
                    // only used if MAX_FILE_SIZE specified in form
                case UPLOAD_ERR_INI_SIZE:
                    $this->addError('image', 'The uploaded file was too large');
                    break;

                case UPLOAD_ERR_PARTIAL:
                    $this->addError('image', 'File was only partially uploaded');
                    break;

                case UPLOAD_ERR_NO_FILE:
                    $this->addError('image', 'No file was uploaded');
                    break;

                case UPLOAD_ERR_NO_TMP_DIR:
                    $this->addError('image', 'Temporary folder not found');
                    break;

                case UPLOAD_ERR_CANT_WRITE:
                    $this->addError('image', 'Unable to write file');
                    break;

                case UPLOAD_ERR_EXTENSION:
                    $this->addError('image', 'Invalid file extension');
                    break;

                default:
                    $this->addError('image', 'Unknown error code');
            }

            if ($this->hasError())
                return false;

            $info = getImageSize($file['tmp_name']);
            if (!$info) {
                $this->addError('type', 'Uploaded file was not an image');
                return false;
            }

            switch ($info[2]) {
                case IMAGETYPE_PNG:
                case IMAGETYPE_GIF:
                case IMAGETYPE_JPEG:
                    break;

                default:
                    $this->addError('type', 'Invalid image type uploaded');
                    return false;
            }
            // if no errors have occurred, save the image
            if (!$this->hasError()) {
                $this->uploadFile($file['tmp_name']);
                $this->filename = basename($file['name']);
                
                $path = $this->getFullPath();
                $this->fullPath = $path.'/'.$this->user->username.'.jpeg';
                move_uploaded_file($this->_uploadedFile,
                                          $this->fullPath);
                $this->altTitle = $this->user->username.'.jpeg';                          
                $this->user->profile->images = $this->user->username.'.jpeg';
                $this->user->profile->save();
            }

            return !$this->hasError();
        }
       
       	public function uploadFile($path)
        {
            if (!file_exists($path) || !is_file($path))
                throw new Exception('Unable to find uploaded file');

            if (!is_readable($path))
                throw new Exception('Unable to read uploaded file');

            $this->_uploadedFile = $path;
        }
              
        public function getFullPath()
        {
            return sprintf('%s', self::GetUploadPath());
        }       
 
 		public function getImageName(){
 			
 			return $this->fullPath;
 		}

 		public function getAltTitle(){
 			
 			return $this->altTitle;
 		}
 
        public static function GetUploadPath()
        {
            $config = Zend_Registry::get('config');

            return sprintf('%s/uploaded-files', $config->paths->data);
        } 
        
    }
?>