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
}
