<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{

    public function indexAction()
    {
        $nn = new NeuralNetwork();
        $nn->initLayers(2,2,1);
        $this->view->nnInfos = $nn->__toString();



    }
}
