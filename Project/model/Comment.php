<?php
class Comment {
    private \PDO $conn;

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }

    public function getCommentsByPostId($postId): false|array
    {
        $stmt = $this->conn->prepare("SELECT comment.*, user.username FROM comment LEFT JOIN user ON comment.user_id = user.id WHERE article_id = :article_id ORDER BY created_at DESC");
        $stmt->bindParam(':article_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($postId, $userId, $guestName, $content): void
    {
        $stmt = $this->conn->prepare("INSERT INTO comment (article_id, user_id, guest_name, content) VALUES (:article_id, :user_id, :guest_name, :content)");
        $stmt->bindParam(':article_id', $postId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':guest_name', $guestName);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
    }
}