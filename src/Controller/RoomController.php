<?php

namespace App\Controller;

use App\Model\RoomManager;
use App\Model\ReservationManager;
use App\Model\AvisManager;

class RoomController extends AbstractController
{
    public function room(): string
    {
        return $this->twig->render('Room/room.html.twig');
    }
        /**
     * Show informations for a specific room
     */

    public function index(): string
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectAll();

        return $this->twig->render('Room/rooms.html.twig', ['rooms' => $rooms]);
    }

    public function showRoom(int $id): string
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        $reservationManager = new ReservationManager();
        $dates = $reservationManager->selectBooked($id);

        $avisManager = new AvisManager();
        $allAvis = $avisManager->selectVisibleAvis($id);

        if (!empty($_POST)) {
            $userId = $_SESSION['user_id'];
            $dateStart = $_POST['start_date'];
            $dateEnd = $_POST['end_date'];
            $room = trim($_POST['room']);

            $insertService = $reservationManager->insert($dateStart, $dateEnd, $room, $userId);
            $reservationManager->insertservice($insertService);

            header('Location: /room/showRoom?id=' . $id);
        }
        return $this->twig->render('Room/showRoom.html.twig', [
            'room' => $room,
            'allAvis' =>  $allAvis,
            'dates' => json_encode($dates),
        ]);
    }

    public function upload()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $uploadDir = __DIR__ . '\..\..\public\assets\images\room' . $_POST['id'] . '/';
            $extension = 'webp';
            $uploadFile = $_POST['pictureName'] . '.' . $extension;

            $whereTo = $uploadDir . $uploadFile;
            $authorizedExtensions = ['jpg','png', 'gif', 'webp'];
            $maxFileSize = 2000000;

            if ((!in_array($extension, $authorizedExtensions))) {
                $errors[] = 'Veuillez sélectionner une image de type Jpg, gif, webp ou Png !';
            }

            if (
                file_exists($_FILES['picture']['tmp_name'])
                && filesize($_FILES['picture']['tmp_name']) > $maxFileSize
            ) {
                $errors[] = "Votre fichier doit faire moins de 2M !";
            }

            if (empty($errors)) {
                $newName = $whereTo;
                move_uploaded_file($_FILES['picture']['tmp_name'], $newName);
                header('Location: /rooms/showRoom?id=' . $_POST['id']);
            }
        }
    }

    public function edit(int $id)
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $room = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            if ($roomManager->update($room)) {
                header('Location: /dashboard/rooms');
            };
            // we are redirecting so we don't want any content rendered
            return null;
        }
        return $this->twig->render('Room/roomEdit.html.twig', [
            'room' => $room,
        ]);
    }
}
