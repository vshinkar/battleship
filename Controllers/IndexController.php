<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 13:11
 */

namespace ValeriyShinkar\Controllers;

use ValeriyShinkar\Core\Controller;
use ValeriyShinkar\Models\IndexModel;

class IndexController extends Controller
{

    function __construct()
    {
        $this->model = new IndexModel();

        parent::__construct();
    }

    function actionIndex()
    {
        $this->view->generate('indexView.php', 'layout.php', array('grid' => $this->model->getData()));
    }
}