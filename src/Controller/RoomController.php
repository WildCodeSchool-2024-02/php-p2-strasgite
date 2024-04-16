<?php

namespace App\Controller;

class RoomController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Room/showRoom.html.twig');
    }
}
