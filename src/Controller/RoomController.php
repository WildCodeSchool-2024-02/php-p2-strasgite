<?php

namespace App\Controller;

use App\Model\RoomManager;

class RoomController extends AbstractController
{
    public function room(): string
    {
        return $this->twig->render('Room/room.html.twig');
    }
        /**
     * Show informations for a specific room
     */
    public function showRoom(int $id): string
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        return $this->twig->render('Room/showRoom.html.twig', ['room' => $room]);
    }
}
