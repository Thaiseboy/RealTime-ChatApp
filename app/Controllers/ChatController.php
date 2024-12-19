<?php
require_once '../app/Models/Message.php';

class ChatController
{
    public function index()
    {
        require_once '../views/chat.php';
    }

    public function send()
    {
        $message = new Message();
        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['sender_name']) && !empty($data['message'])) {
            $message->create($data['sender_name'], $data['message']);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Incomplete data']);
        }
    }

    public function receive()
    {
        $message = new Message();
        echo json_encode($message->getAll());
    }
}
?>