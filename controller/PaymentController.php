<?php
require_once 'Libraries/Database.php';
require_once 'Models/PaymentModel.php';

class PaymentController {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = new PaymentModel();
    }

    public function index($flight_id) {
        // Baca data penerbangan dari file JSON
        $jsonData = file_get_contents('Data/100_flights.json');
        $flights = json_decode($jsonData, true);

        $selectedFlight = null;
        foreach ($flights as $flight) {
            if ($flight['id'] == $flight_id) {
                $selectedFlight = $flight;
                break;
            }
        }

        if (!$selectedFlight) {
            die('Flight not found.');
        }

        // Sertakan view pembayaran
        require_once 'Views/payment.php';
    }

    public function store() {
        // Data dari form pembayaran
        $data = [
            'flight_id' => $_POST['flight_id'],
            'payment_method' => $_POST['payment_method'],
            'card_number' => $_POST['card_number'],
            'name_on_card' => $_POST['name_on_card'],
            'total_amount' => $_POST['price']
        ];

        $this->paymentModel->addPayment($data);

        // Redirect ke pembelian
        header('Location: PurchaseController.php?action=store&flight_id=' . $_POST['flight_id']);
        exit;
    }
}
