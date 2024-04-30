<?php

namespace App\Controller;

use App\Model\RoomManager;
use App\Model\AvisManager;
use App\Model\ConnectManager;

class DashboardAvisController extends AbstractController
{
    public function index(): string
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectAll();

        if (!empty($_GET) && isset($_GET['envoyer'])) {
            if (strlen($_GET['room']) < 3) {
                 $room = $_GET['room'];

                 header("Location: /dashboard/avis/room?id=$room");
            }
        }

        return $this->twig->render('Dashboard/Avis/index.html.twig', ['rooms' => $rooms]);
    }

    public function show(int $id): string
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);
        $avisManager = new AvisManager();
        $avis = $avisManager->selectAvis($id);


        return $this->twig->render('Dashboard/Avis/show.html.twig', [
        'room' => $room,
        "avis" => $avis
        ]);
    }


    public function allAvisIsVisible(int $roomId, bool $statut)
    {
        $avisManager = new AvisManager();
        $avisManager->updateLesAvisIsVisible($roomId, $statut);

        header('location: /room/showRoom?id=' . $roomId);
    }

      // MAJ du status d'un avis
    public function isVisible(int $id, bool $statut, int $roomId)
    {
        $avisManager = new AvisManager();
        $avisManager->updateAvisIsVisible($id, $statut);

        header('location: /room/showRoom?id=' . $roomId);
    }

    public function addAvis($id)
    {
        $avisManager = new AvisManager();

        $connectManager = new ConnectManager();
        $username = $connectManager->selectOneById($_SESSION['user_id']);

        $roomManager = new RoomManager();
        $roomInfo = $roomManager->selectOneById($id);

        if (!empty($_POST)) {
            $userId = $_SESSION['user_id'];
            $room = $_POST;
            $avisManager->addNewAvis($room['description'], $room['id'], $userId);

            header('Location: /rooms/showRoom?id=' . $id);
        }


        return $this->twig->render('Dashboard/Avis/addAvis.html.twig', [
            'room' => $roomInfo,
            'username' => $username
            ]);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $avisManager = new AvisManager();
        $avisManager->deleteAvis($id);
        header('Location: dashboard/avis');
    }
}
