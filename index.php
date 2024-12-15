<?php
require_once 'Libraries/Database.php';
require_once 'Controller/AuthController.php';
require_once 'Controller/HomeController.php';
require_once 'Controller/FlightController.php';
require_once 'Controller/PaymentController.php';

$db = Database::getInstance();

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'login':
        $authController = new AuthController($db);
        $authController->login();
        break;
    case 'signup':
        $authController = new AuthController($db);
        $authController->signup();
        break;
    case 'logout':
        $authController = new AuthController($db);
        $authController->logout();
        break;
    case 'buy_ticket':
        $flightController = new FlightController();
        $flightController->buyTicket();
        break;
    case 'payment':
        $paymentController = new PaymentController();
        $paymentController->payment();
        break;
    default:
        $homeController = new HomeController($db);
        $homeController->index();
        break;
}
?>
