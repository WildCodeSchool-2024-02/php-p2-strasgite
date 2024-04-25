<?php

namespace App\Controller;

use App\Model\ConnectManager;
use App\Model\ReservationManager;
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


    public function edit(int $id): string
    {
        $connectManager = new ConnectManager();
        $user = $connectManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array_map('trim', $_POST);
            if ($connectManager->edit($user)) {
                header('Location: /profile');
                exit();
            };
        }
        return $this->twig->render('Account/userAccountEdit.html.twig', [
            'user' => $user,
        ]);
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

        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->getReservationById($this->user['id']);

        return $this->twig->render('Account/userAccount.html.twig', ['reservations' => $reservations]);
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('location: /');
    }

    public function delete()
    {
        $connectManager = new ConnectManager();
        $id = $_GET['id'];
        $connectManager->delete($id);
        header('Location: /');
    }

    public function deleteReservation()
    {
        $reservationManager = new ReservationManager();
        $id = $_GET['id'];
        $reservationManager->delete($id);
        header('Location: /profile');
    }
}
