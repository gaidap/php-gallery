<?php
    
    
    class CommentService {
        
        private CommentRepository $repo;
        
        function __construct() {
            $this->repo = new CommentRepository();
        }
        
        function updateComment($post): bool {
            $comment = CommentFactory::castToComment($this->repo->findById($post['comment-id']));
            if (!$post['author'] || !is_string($post['author']) || empty($post['author'])) {
                setMessage('The comment must have an author.');
                redirect('edit_comment.php?id=' . $comment->getId());
                return false;
            }
            if (!$post['body'] || !is_string($post['body']) || empty($post['body'])) {
                setMessage('The comment must have a body.');
                redirect('edit_comment.php?id=' . $comment->getId());
                return false;
            }
            $comment->setAuthor($post['author'])
                    ->setBody($post['body']);
            $result = $this->repo->save($comment);
            if (is_string($result)) {
                setMessage($result);
                redirect('edit_comment.php?id=' . $comment->getId());
                return false;
            }
            return $result;
        }
    }
