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
    'rooms/edit' => ['RoomController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'rooms/delete' => ['ItemController', 'delete',],
    'rooms/upload' => ['RoomController', 'upload',],
    'room' => ['RoomController', 'room',],
    'room/showRoom' => ['RoomController', 'showRoom', ['id']],
    'room/showRoom/reservation' => ['ReservationController', 'insert', ['id']],
    'add_avis' => ['DashboardAvisController', 'addAvis', ['id']],
    'dashboard' => ['DashboardController', 'index',],
    'dashboard/users' => ['DashboardController', 'users',],
    'dashboard/bookings' => ['DashboardController', 'booking',],
    'dashboard/bookingedit' => ['DashboardController', 'bookingEdit',],
    'dashboard/bookingdelete' => ['DashboardController', 'bookingDelete',],
    'dashboard/messages' => ['MessageController', 'message',],
    'dashboard/messages/show' => ['MessageController', 'showMessage', ['id']],
    'dashboard/messages/delete' => ['MessageController', 'deleteMessage', ['id']],
    'dashboard/rooms' => ['DashboardController', 'rooms',],
    'dashboard/rooms/delete' => ['DashboardController', 'deleteRoom', ['id']],
    'dashboard/rooms/add' => ['DashboardController', 'addRoom',],
    'dashboard/users/toggle' => ['DashboardController', 'toggle',],
    'dashboard/users/creatuser' => ['ConnectController', 'creatuser'],
    'dashboard/users/delete' => ['DashboardController', 'delete'],
    'dashboard/services' => ['DashboardController', 'service'],
    'dashboard/services/add' => ['DashboardController', 'toggleService'],
    'rooms/showRoom' => ['RoomController', 'showRoom', ['id']],
    'connect' => ['ConnectController', 'login'],
    'inscription' => ['ConnectController', 'inscription'],
    'profile' => ['ConnectController', 'profile'],
    'profile/modif' => ['ConnectController', 'edit', ['id']],
    'profile/modif/delete' => ['ConnectController', 'delete',['id']],
    'profile/bookingdelete' => ['ConnectController', 'deleteReservation',],
    'logout' => ['ConnectController', 'logout'],
    'contact' => ['ContactController', 'contact'],
    'contact/result' => ['ContactController', 'result'],
    'dashboard/avis' => ['DashboardAvisController', 'index'],
    'dashboard/avis/room' => ['DashboardAvisController', 'show', ['id']],
    'dashboard/avis/visible' => ['DashboardAvisController', 'isVisible', ['id','statut','roomId']],
    'dashboard/allAvisIsVisible/visible' => ['DashboardAvisController', 'allAvisIsVisible', ['roomId','statut']],
    'deleteAvis' => ['DashboardAvisController', 'delete'],
];
