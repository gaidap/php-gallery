<?php
    
    class PhotoService {
        
        private PhotoRepository $repo;
        
        function __construct() {
            $this->repo = new PhotoRepository();
        }
        
        private const upload_errors = [
            UPLOAD_ERR_INI_SIZE => "Selected file exceeds the maximal upload file size directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "Selected file exceeds the maximal upload file size directive in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was selected.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "IO error. Cannot write to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
        ];
        
        function deletePhotoFile($id): bool|string {
            if ($this->isIdValid($id)) {
                setMessage("ID must be a valid int.");
                return false;
            }
            $photo = PhotoFactory::castToPhoto($this->repo->findById($id));
            if (!$photo) {
                setMessage("Photo not exists in database.");
                return false;
            }
            $delete_result = $this->repo->delete($photo);
            $file = ['name' => $photo->getFileName()];
            if ($delete_result) {
                setMessage('Photo deleted.');
                $this->cleanUpAndSetErrorMsg($delete_result, $file);
            }
            return $delete_result;
        }
        
        private function isIdValid($id): bool {
            return is_numeric($id) && !is_int($id + 0);
        }
        
        function updatePhoto($post): bool {
            $photo = PhotoFactory::castToPhoto($this->repo->findById($post['photo-id']));
            if (!$post['title'] || !is_string($post['title']) || empty($post['title'])) {
                setMessage('The photo must have a title.');
                redirect('edit_photo.php?id=' . $photo->getId());
                return false;
            }
            if (!$post['alternate-text'] || !is_string($post['alternate-text']) || empty($post['alternate-text'])) {
                setMessage('The photo must have an alternate text.');
                redirect('edit_photo.php?id=' . $photo->getId());
                return false;
            }
            $photo->setTitle($post['title'])
                ->setAlternateText(empty($post['alternate-text']) ? '' : $post['alternate-text'])
                ->setCaption(empty($post['caption']) ? null : $post['caption'])
                ->setDescription(empty($post['description']) ? null : $post['description']);
            $result = $this->repo->save($photo);
            if (is_string($result)) {
                setMessage($result);
                redirect('edit_photo.php?id=' . $photo->getId());
                return false;
            }
            return true;
        }
        
        function savePhotoFile($file, $title): bool {
            if (!$title || !is_string($title) || empty($title)) {
                setMessage('The photo must have a title.');
                return false;
            }
            if (!$file || !is_array($file) || empty($file)) {
                setMessage('File invalid or no file selected.');
                return false;
            }
            if (!Photo::isFileSupported($this->getFileType($file))) {
                setMessage('File type not supported.');
                return false;
            }
            $result = null;
            $current_user = (new UserRepository())->findByUsername(Session::getInstance()->getUsername());
            if (!$current_user) {
                setMessage('User not logged in correctly.');
                return false;
            }
            if ($this->moveFile($file)) {
                $photo = PhotoFactory::createNewPhoto(
                    $current_user->getId(),
                    $this->getFileName($file),
                    $title,
                    $this->getFileType($file),
                    $this->getFileSize($file),
                    $this->getFileName($file)
                );
                $result = $this->repo->save($photo);
            }
            return $this->wasSaveSuccessful($result, $file);
        }
        
        private function moveFile($file): bool {
            if (!move_uploaded_file(self::getSourceDir($file), self::getTargetDir($file))) {
                setMessage(self::upload_errors[$this->getFileError($file)]);
                return false;
            }
            setMessage("Upload successful.");
            return true;
            
        }
        
        private function getSourceDir($file): string {
            return $file['tmp_name'];
        }
        
        private function getTargetDir($file): string {
            return UPLOAD_PATH . DS . $this->getFileName($file);
        }
        
        private function getFileName($file): string {
            return basename($file['name']);
        }
        
        private function getFileSize($file): int {
            return basename($file['size']);
        }
        
        private function getFileType($file): string {
            return basename($file['type']);
        }
        
        private function getFileError($file): int {
            return $file['error'];
        }
        
        private function wasSaveSuccessful(mixed $result, $file): bool {
            $save_successful = $result instanceof Photo && !is_null($result->getId());
            if (!$save_successful) {
                $this->cleanUpAndSetErrorMsg($result, $file);
            }
            return $save_successful;
        }
        
        private function cleanUpAndSetErrorMsg(mixed $result, $file): void {
            if (file_exists($this->getTargetDir($file))) {
                unlink($this->getTargetDir($file));
            }
            if (is_string($result)) {
                setMessage($result);
            }
        }
    }
