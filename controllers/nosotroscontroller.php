<?php
class nosotrosController {
    public function index() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/nosotros.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}