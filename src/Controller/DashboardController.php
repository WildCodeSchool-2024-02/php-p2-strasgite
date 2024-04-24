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
        $rooms = $dashboardManager->selectAllRooms();

        return $this->twig->render('Dashboard/dashboardRooms.html.twig', ['rooms' => $rooms]);
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

    public function toggle(): void
    {
        $urlId = $_GET;
        $urlMethod = $_GET['method'];
        $toggleValue = new DashboardManager();
        $boolCheck = $toggleValue->selectOneById($urlId['id']);

        if ($urlMethod === 'isClient' && !$boolCheck['isClient']) {
            $toggleValue->toggleUser1($urlId, $urlMethod);
            header('Location: /dashboard/users');
        } elseif ($urlMethod === 'isClient' && $boolCheck['isClient']) {
            $toggleValue->toggleUser0($urlId, $urlMethod);
            header('Location: /dashboard/users');
        } elseif ($urlMethod === 'isVIP' && !$boolCheck['isVIP']) {
            $toggleValue->toggleUser1($urlId, $urlMethod);
            header('Location: /dashboard/users');
        } elseif ($urlMethod === 'isVIP' && $boolCheck['isVIP']) {
            $toggleValue->toggleUser0($urlId, $urlMethod);
            header('Location: /dashboard/users');
        } elseif ($urlMethod === 'isAdmin' && !$boolCheck['isAdmin']) {
            $toggleValue->toggleUser1($urlId, $urlMethod);
            header('Location: /dashboard/users');
        } elseif ($urlMethod === 'isAdmin' && $boolCheck['isAdmin']) {
            $toggleValue->toggleUser0($urlId, $urlMethod);
            header('Location: /dashboard/users');
        }
    }

    public function delete(): void
    {
        $urlId = $_GET['id'];

        if ($urlId != '') {
            $userManager = new DashboardManager();
            $userManager->deleteUser((int)$urlId);
            header('Location: /dashboard/users');
        } else {
            header('Location: /dashboard/users');
        }
    }
}
