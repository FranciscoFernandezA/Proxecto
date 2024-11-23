<?php
namespace Com\FernandezFran\Core;

abstract class BaseController {
    protected $view;

    function __construct() {
        $this->view = new View(get_class($this));
    }

    function getModel(string $model){
        $config = \Com\FernandezFran\Core\Config::getInstance();
        $modelName = $config->get('MODELS_NAMESPACE').$model;
        return new $modelName();
    }
}
