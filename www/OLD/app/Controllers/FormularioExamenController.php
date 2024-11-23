<?php

namespace Com\FernandezFran\Controllers;

class FormularioExamenController extends \Com\FernandezFran\Core\BaseController {

    function mostrarFormulario() : void{
        $data = [];
        $data['titulo'] = 'Formulario examen';

        $this->view->showViews(array('templates/header.view.php', 'formulario.view.php', 'templates/footer.view.php'), $data);
    }

    function procesarFormulario() : void{
        $data = [];
        $data['titulo'] = 'Formulario examen';

        $data['errores'] = $this->checkForm($_POST);

        $data['isOk'] = count($data['errores']) === 0;

        $this->view->showViews(array('templates/header.view.php', 'formulario.view.php', 'templates/footer.view.php'), $data);
    }

    private function checkForm(array $post) : array{
        $errores = [];
        if(empty($post['username'])){
            $errores['username'] = 'Este campo es obligatorio';
        }
        else if(!preg_match('/^[a-zA-Z][a-zA-Z0-9]{4,19}$/', $post['username'])){
            $errores['username'] = 'El nombre de usuario debe tener una longitud entre 5 y 20. Debe comenzar por letra y sólo se permiten letras y números.';
        }

        if(empty($post['email'])){
            $errores['email'] = "Campo obligatorio";
        }
        else if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "Es obligatorio insertar un email";
        }

        if(!empty($post['matricula']) && !preg_match('/^[0-9]{4}[A-Z]{3}$/', $post['matricula'])){
            $errores['matricula'] = 'El formato de matrícula es 1234ABC.';
        }

        if(isset($post['opcions']) && in_array('tarjeta', $post['opcions']) && !in_array('socio', $post['opcions'])){
            $errores['opcions'] = 'Sólo se puede seleccionar tarjeta si se ha marcado la opción socio';
        }

        return $errores;
    }
}
