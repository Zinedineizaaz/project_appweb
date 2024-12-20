<?php
require_once 'Models/Flight.php';

class HomeController {
    private $flight;

    public function __construct($db) {
        $this->flight = new Flight($db);
    }

    public function index() {
        $flights = $this->flight->getAllFlights();
        include 'Views/homepage.php';
    }
}
?>
