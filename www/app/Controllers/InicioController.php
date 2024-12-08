<?php

namespace Com\FernandezFran\Controllers;

class InicioController extends \Com\FernandezFran\Core\BaseController {

    public function index() {
        $data = array(
            'titulo' => 'Inicio',
            'breadcrumb' => ['Inicio']
        );
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }

}
