<?php
  namespace Com\FernandezFran\Core;

  abstract class BaseController {
      protected $view;

      function __construct() {
          $this->view = new View(get_class($this));
      }
 }
