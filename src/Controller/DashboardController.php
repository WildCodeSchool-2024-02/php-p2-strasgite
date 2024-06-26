<?php

namespace App\Controller;

use App\Model\DashboardManager;
use App\Model\ReservationManager;

class DashboardController extends AbstractController
{
    public function index(): string
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }
        return $this->twig->render('Dashboard/dashboard.html.twig');
    }

    public function users(): string
    {
        $dashboardManager = new DashboardManager();
        $items = $dashboardManager->selectAll();

        return $this->twig->render('Dashboard/dashboardUsers.html.twig', ['items' => $items]);
    }


    public function booking(): string
    {
        $reservationManager = new ReservationManager();
        $bookings = $reservationManager->getAllReservation();

        return $this->twig->render('Dashboard/dashboardBooking.html.twig', ['bookings' => $bookings]);
    }

    public function bookingDelete(): void
    {
        $reservationManager = new ReservationManager();
        $id = $_GET['id'];
        $reservationManager->delete($id);
        header('Location: /dashboard/bookings');
    }

    public function bookingEdit(): string
    {
        $id = $_GET['id'];
        $reservationManager = new ReservationManager();
        $booking = $reservationManager->getReservationByItsId($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dateStart = $_POST['start_date'];
            $dateEnd = $_POST['end_date'];

            $reservationManager->editReservation($dateStart, $dateEnd, $id);
            header('Location: /dashboard/bookings');
        }

        return $this->twig->render('Dashboard/dashboardBookingEdit.html.twig', ['booking' => $booking]);
    }

    public function rooms(): string
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }

        $dashboardManager = new DashboardManager();
        $rooms = $dashboardManager->selectAllRooms();

        return $this->twig->render('Dashboard/dashboardRooms.html.twig', ['rooms' => $rooms]);
    }

    public function deleteRoom(): void
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = trim($_GET['id']);
            $dashboardManager = new DashboardManager();
            $dashboardManager->deleteRoom((int)$id);
            header('Location: /dashboard/rooms');
        }
    }

    public function addRoom(): ?string
    {
        if (!$this->user) {
            echo 'Vous n\'êtes pas connecté';
            header('HTTP/1.1 401 unauthorized');
            exit();
        } elseif (!$this->user['isAdmin']) {
            echo 'Vous n\'êtes pas Administrateur';
            header('HTTP/1.1 401 unauthorized');
            exit();
        }

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

    public function service(): string
    {
        $dashboardManager = new DashboardManager();
        $reservations = $dashboardManager->selectAllreservation();

        return $this->twig->render('Dashboard/dashboardService.html.twig', ['reservations' => $reservations]);
    }

    public function toggleService()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $services = [
                'id' => '',
                'breakfast' => 0,
                'minibar' => 0,
                'parking' => 0,
                'servicechambre' => 0,
                'driver' => 0
            ];

            if (isset($_POST['breakfast']) && $_POST['breakfast'] === 'true') {
                $services['breakfast'] = 1;
            } if (isset($_POST['minibar']) && $_POST['minibar'] === 'true') {
                $services['minibar'] = 1;
            } if (isset($_POST['parking']) && $_POST['parking'] === 'true') {
                $services['parking'] = 1;
            } if (isset($_POST['servicechambre']) && $_POST['servicechambre'] === 'true') {
                $services['servicechambre'] = 1;
            } if (isset($_POST['driver']) && $_POST['driver'] === 'true') {
                $services['driver'] = 1;
            } if (isset($_POST['id'])) {
                $services['id'] = intval($_POST['id']);
            } else {
                return $services;
            }
            $servicesManager = new DashboardManager();
            $servicesManager->updateService($services);
        }

        header('Location: /dashboard/services');
    }
}
