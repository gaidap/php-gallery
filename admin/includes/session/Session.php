<?php
    
    class Session {
        
        const SESSION_NOT_STARTED = false;
        
        private static Session $instance;
        
        private bool $session_state = self::SESSION_NOT_STARTED;
        
        private function __construct() {
        }
        
        function signIn($username, $password): void {
            $database = new Database();
            $user_repo = new UserRepository($database->getConnection());
            $current_user = $user_repo->verifyUser($username, $password);
            if ($current_user) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id" => $current_user->getId(),
                    "username" => $current_user->getUsername()
                );
                redirect("index.php");
            } else {
                setMessage("Invalid password or username");
            }
        }
        
        function signOut(): void {
            self::destroySession();
            redirect('../index.php');
        }
        
        
        function isSignedIn(): bool {
            return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
        }
        
        function getUsername() {
            if (isset($_SESSION['user_data']) && isset($_SESSION['user_data']['username'])) {
                return $_SESSION['user_data']['username'];
            }
            return '';
        }
        
        static function getInstance(): Session {
            if (!isset(self::$instance)) {
                self::$instance = new Session();
            }
            self::$instance->startSession();
            return self::$instance;
        }
        
        private function startSession(): void {
            if ($this->session_state === self::SESSION_NOT_STARTED) {
                $this->session_state = session_start();
            }
            
        }
        
        private function destroySession(): void {
            $this->session_state = !session_destroy();
            unset($_SESSION);
        }
    }
    
    
