1 <?php

$config = Com\FernandezFran\Core\Config::getInstance();

$config->set('APP_FOLDER', '../app/');
$config->set('DEFAULT_NAMESPACE', 'Com\FernandezFran\\');
$config->set('CONTROLLERS_NAMESPACE', $config->get('DEFAULT_NAMESPACE') . 'Controllers\\');
$config->set('MODELS_NAMESPACE', $config->get('DEFAULT_NAMESPACE') . 'Models\\');
$config->set('VIEWS_FOLDER', $config->get('APP_FOLDER') . 'Views/');
$config->set('DATA_FOLDER', $config->get('APP_FOLDER') . 'Data/');

$config->set('DEFAULT_CONTROLLER', 'Categoria');
$config->set('DEFAULT_ACTION', 'index');
