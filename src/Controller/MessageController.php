<?php

namespace App\Controller;

use App\Model\MessageManager;

class MessageController extends AbstractController
{
    public function message(): string
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }
        $messageManager = new MessageManager();
        $messages = $messageManager->selectAllMessages();

        return $this->twig->render('Dashboard/dashboardMessages.html.twig', ['messages' => $messages]);
    }

    public function showMessage(int $id): string
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }
        $messageManager = new MessageManager();
        $message = $messageManager->messageById($id);

        return $this->twig->render('Dashboard/dashboardShowMessage.html.twig', ['message' => $message]);
    }

    public function deleteMessage(): void
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = trim($_GET['id']);
            $messageManager = new MessageManager();
            $messageManager->deleteMessage((int)$id);
            header('Location: /dashboard/messages');
        }
    }
}
