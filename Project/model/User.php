<?php
class User {
    private \PDO $conn;
    private $username;
    private $password;
    private $email;
    private $role;

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function addUser(): void
    {
        $stmt = $this->conn->prepare("INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $this->role);
        $stmt->execute();
    }

    public function usernameExists($username): bool {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function authenticateUser($identifier, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = :identifier OR email = :identifier");
        $stmt->bindParam(':identifier', $identifier);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(): false|array
    {
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserPasswordById($id, $newPassword): void
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE user SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteUserById($id): void
    {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function changeUserRoleById($id, $role): void
    {
        $stmt = $this->conn->prepare("UPDATE user SET role = :role WHERE id = :id");
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}