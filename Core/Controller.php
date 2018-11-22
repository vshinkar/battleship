<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 12:58
 */

namespace ValeriyShinkar\Core;

class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    // action, default call
    function actionIndex()
    {
        // todo
    }
}