<?php
class TicketController extends Controller {
    public function homepage() {
        $this->loadView('homepage');
    }

    public function buyTicket() {
        $ticketModel = $this->loadModel('Ticket');
        $airlines = $ticketModel->getAllAirlines();
        $this->loadView('buy_ticket', ['airlines' => $airlines]);
    }

    public function submitTicket() {
        if ($_POST) {
            $ticketModel = $this->loadModel('Ticket');
            $user_id = $_SESSION['user_id'];
            $airline_id = $_POST['airline_id'];
            $flight_date = $_POST['flight_date'];
            $price = $_POST['price'];
            $ticketModel->buyTicket($user_id, $airline_id, $flight_date, $price);
            header('Location: /payment');
        }
    }
}
?>
