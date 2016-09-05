<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{

    public function indexAction()
    {


        $nn = new NeuralNetwork();
        $nn->addNeural('input');

    }
}
