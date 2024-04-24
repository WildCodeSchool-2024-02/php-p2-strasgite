<?php

namespace App\Controller;

use App\Model\DashboardManager;

class DashboardController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Dashboard/dashboard.html.twig');
    }

    public function users(): string
    {
        $dashboardManager = new DashboardManager();
        $items = $dashboardManager->selectAll();

        return $this->twig->render('Dashboard/dashboardUsers.html.twig', ['items' => $items]);
    }

    public function rooms(): string
    {
        $dashboardManager = new DashboardManager();
        $roomItems = $dashboardManager->selectAllRooms();

        return $this->twig->render('Dashboard/dashboardRooms.html.twig', ['roomItems' => $roomItems]);
    }

    public function deleteRoom(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = trim($_GET['id']);
            $dashboardManager = new DashboardManager();
            $dashboardManager->deleteRoom((int)$id);
            header('Location: /dashboard/rooms');
        }
    }

    public function addRoom(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $addRoom = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $dashboardManager = new DashboardManager();
            $dashboardManager->insertRoom($addRoom);

            header('Location:/dashboard/rooms');
            return null;
        }

        return $this->twig->render('/Room/addRoom.html.twig');
    }
}
