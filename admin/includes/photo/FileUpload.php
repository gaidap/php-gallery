<?php
    
    // TODO This class will abstract the super gloabl $FILES
    // and give it an interface to extract information from the uploaded
    // file which will be used in the PhotoFactory to create a Photo entry
    // Also it will encapsulate the logic for the actual upload process
    
    class FileUpload {
        
        private const upload_errors = [
            UPLOAD_ERR_INI_SIZE => "Selected file exceeds the maximal upload file size directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "Selected file exceeds the maximal upload file size directive in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was selected.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "IO error. Cannot write to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
        ];
        
        private const upload_dir = 'uploaded_files';
        
        static function uploadFile() {
            if (!move_uploaded_file(self::getSourceDir(), self::getTargetDir())) {
                setMessage(self::upload_errors[$_FILES['file_upload']['error']]);
            } else {
                setMessage("Upload successful.");
            }
        }
        
        private static function getSourceDir(): string {
            return $_FILES['file_upload']['tmp_name'];
        }
        
        private static function getTargetDir(): string {
            return realpath("..") . DIRECTORY_SEPARATOR . self::upload_dir . DIRECTORY_SEPARATOR . $_FILES['file_upload']['name'];
        }
    }
