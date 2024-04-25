<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'rooms' => ['RoomController', 'index',],
    'items' => ['ItemController', 'index',],
    'rooms/edit' => ['RoomsController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'rooms/delete' => ['ItemController', 'delete',],
    'rooms/upload' => ['RoomController', 'upload',],
    'room' => ['RoomController', 'room',],
    'room/showRoom' => ['RoomController', 'showRoom', ['id']],
    'room/showRoom/reservation' => ['ReservationController', 'insert', ['id']],
    'dashboard' => ['DashboardController', 'index',],
    'dashboard/users' => ['DashboardController', 'users',],
    'dashboard/bookings' => ['DashboardController', 'booking',],
    'dashboard/bookingedit' => ['DashboardController', 'bookingEdit',],
    'dashboard/bookingdelete' => ['DashboardController', 'bookingDelete',],
    'rooms/showRoom' => ['RoomController', 'showRoom', ['id']],
    'connect' => ['ConnectController', 'login'],
    'inscription' => ['ConnectController', 'inscription'],
    'profile' => ['ConnectController', 'profile'],
    'profile/modif' => ['ConnectController', 'edit', ['id']],
    'profile/modif/delete' => ['ConnectController', 'delete',['id']],
    'profile/bookingdelete' => ['ConnectController', 'deleteReservation',],
    'logout' => ['ConnectController', 'logout'],
    'contact' => ['ContactController', 'contact'],
];
