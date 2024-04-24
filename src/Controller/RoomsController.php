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

    public function edit(int $id)
    {
        $roomManager = new RoomsManager();
        $item = $roomManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            if ($roomManager->update($item)) {
                header('Location: /rooms/showRoom?id=' . $id);
            };
            // we are redirecting so we don't want any content rendered
            return null;
        }
        return $this->twig->render('Room/roomEdit.html.twig', [
            'item' => $item,
        ]);
    }
}
