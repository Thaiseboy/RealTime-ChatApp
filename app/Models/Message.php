<?php
class Message
{
    private $conn;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'realtime_chat';
        $user = 'root';
        $pass = '';
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    }

    public function create($sender_name, $message)
    {
        $stmt = $this->conn->prepare("INSERT INTO messages (sender_name, message) VALUES (:name, :message)");
        $stmt->execute([':name' => htmlspecialchars($sender_name), ':message' => htmlspecialchars($message)]);
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT sender_name, message, created_at FROM messages ORDER BY created_at ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>