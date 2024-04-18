<?php

namespace App\Controller;

use App\Model\RoomsManager;

class RoomsController extends AbstractController
{
    public function index(): string
    {
        $roomManager = new RoomsManager();
        $items = $roomManager->selectAll();

        return $this->twig->render('Room/rooms.html.twig', ['items' => $items]);
    }

    public function show(int $id): string
    {
        $itemManager = new RoomsManager();
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Room/showRoom.html.twig', ['item' => $item]);
    }
}
