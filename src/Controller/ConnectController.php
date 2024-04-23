<?php

namespace App\Controller;

use App\Model\ConnectManager;
use Exception;

class ConnectController extends AbstractController
{
    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $userManager = new ConnectManager();
            $user = $userManager->getOneByEmail($credentials['email']);
            if ($user && $credentials['email'] === $user['email']) {
                if ($credentials['password'] === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /');
                    exit();
                } else {
                    throw new Exception('Mauvais mot de passe');
                }
            } else {
                throw new Exception('Cette adresse n\'existe pas.');
            }
        }
        return $this->twig->render('Connect/connect.html.twig');
    }

    public function inscription(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = $_POST;
            $connectManager = new ConnectManager();
            if ($connectManager->insert($credentials)) {
                return $this->login();
            }
        }

        return $this->twig->render('Connect/inscription.html.twig');
    }

    public function creatuser(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = $_POST;
            $connectManager = new ConnectManager();
            if ($connectManager->insert($credentials)) {
                header('location: /dashboard/users');
            }
        }
        return $this->twig->render('Connect/dashboardusercreation.html.twig');
    }

    public function profile(): string
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }
        return $this->twig->render('Account/userAccount.html.twig');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('location: /');
    }
}
