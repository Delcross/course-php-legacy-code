<?php

use Controllers\PagesController;
use Controllers\UsersController;
use Model\Users;

return [
    Users::class => function($container) {
        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['container']['database']['user'];
        $password = $container['container']['database']['password'];

        return new Users($driver, $host, $name, $user, $password);
    },
    UsersController::class => function($container) {
        $userModal = $container[Users::class]($container);

        return new UsersController($userModel);
    },
    PagesController::class => function($container){
        return new PagesController();
    }
];