<?php

namespace App\Controller;

use App\Model\ReservationManager;
use App\Model\RoomManager;

class ReservationController extends AbstractController
{
    public function insert(int $id): string
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        $reservationManager = new ReservationManager();
        $dates = $reservationManager->selectBooked($id);

        if (!empty($_POST)) {
            $userId = $_SESSION['user_id'];
            $dateStart = $_POST['start_date'];
            $dateEnd = $_POST['end_date'];
            $room = trim($_POST['room_id']);


            $reservationManager->insert($dateStart, $dateEnd, $room, $userId);
            $reservationManager->insertService($reservationManager->insert($dateStart, $dateEnd, $room, $userId));
            header('Location: /showRoom?id=' . $id);
        }
        return $this->twig->render('Room/showRoom.html.twig', [
            'room' => $room,
            'dates' => json_encode($dates),
        ]);
    }
}
