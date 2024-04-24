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
}
