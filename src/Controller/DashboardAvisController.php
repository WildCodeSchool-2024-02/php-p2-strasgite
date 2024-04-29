<?php

namespace App\Controller;

use App\Model\RoomManager;
use App\Model\AvisManager;

class DashboardAvisController extends AbstractController
{
    public function index(): string
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectAll();

        if (!empty($_GET) && isset($_GET['envoyer'])) {
            if (!empty($_GET['room'])) {
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
}
