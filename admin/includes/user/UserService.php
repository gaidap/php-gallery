<?php
    
    
    class UserService {
        
        private UserRepository $repo;
        
        function __construct() {
            $this->repo = new UserRepository();
        }
        
        function updateUser($post): bool {
            $user = UserFactory::castToUser($this->repo->findById($post['user_id']));
            if (!$post['username'] || !is_string($post['username']) || empty($post['username'])) {
                setMessage('The user must have a username.');
                redirect('edit_user.php?id=' . $user->getId());
                return false;
            }
            if (!$post['first-name'] || !is_string($post['first-name']) || empty($post['first-name'])) {
                setMessage('The user must have a first name.');
                redirect('edit_user.php?id=' . $user->getId());
                return false;
            }
            if (!$post['last-name'] || !is_string($post['last-name']) || empty($post['last-name'])) {
                setMessage('The user must have a last name.');
                redirect('edit_user.php?id=' . $user->getId());
                return false;
            }
            $user->setUsername($post['username'])
                ->setFirstName($post['first-name'])
                ->setLastName($post['last-name']);
            if (isset($post['password'])) {
                $user->changePassword($post['password']);
            }
            $result = $this->repo->save($user);
            if (is_string($result)) {
                setMessage($result);
                redirect('edit_user.php?id=' . $user->getId());
                return false;
            }
            return $result;
        }
    }
