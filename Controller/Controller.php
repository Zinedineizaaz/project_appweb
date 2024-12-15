<?php
class Controller {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Function to load model
    public function loadModel($model) {
        require_once './app/models/' . $model . '.php';
        return new $model($this->db);
    }

    // Function to load view
    public function loadView($view, $data = []) {
        require_once './app/views/' . $view . '.php';
    }
}
?>
