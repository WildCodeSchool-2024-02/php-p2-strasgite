<?php

namespace App\Controller;

use App\Model\RoomManager;

class ConnectController extends AbstractController
{
    public function connect(): string
    {
        return $this->twig->render('Connect/connect.html.twig');
    }

    public function inscription(): string
    {
        return $this->twig->render('Connect/inscription.html.twig');
    }
}
