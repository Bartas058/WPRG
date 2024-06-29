<?php
class Article {
    private \PDO $conn;
    private $title;
    private $content;
    private $imagePath;

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function addPost(): void
    {
        $stmt = $this->conn->prepare("INSERT INTO article (title, content, image_path) VALUES (:title, :content, :image_path)");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image_path', $this->imagePath);
        $stmt->execute();
    }

    public function deletePostById($id): void
    {
        $stmt = $this->conn->prepare("DELETE FROM article WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getPostById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM article WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPosts(): false|array
    {
        $stmt = $this->conn->prepare("SELECT * FROM article ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePostById($id, $title, $content, $imagePath, $date): void
    {
        $stmt = $this->conn->prepare("UPDATE article SET title = :title, content = :content, image_path = :imagePath, created_at = :date WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function groupPostsByDate(array $posts): array {
        $groupedPosts = [];
        foreach ($posts as $post) {
            $date = date('Y-m-d', strtotime($post['created_at']));
            $groupedPosts[$date][] = $post;
        }
        return $groupedPosts;
    }
}