<?php

namespace App\Controller;

use App\Model\RoomManager;

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

        return $this->twig->render('Dashboard/Avis/show.html.twig', [
        'room' => $room
        ]);
    }
}
