<?php

use Phalcon\Mvc\Controller;
use ai\NeuralNetwork;

class IndexController extends Controller
{

    public function indexAction()
    {
        $headerCollection = $this->assets->collection("cssHeader")->setTargetPath('header.css');
        $footerCollection = $this->assets
            ->collection("jsFooter");

        $headerCollection->addCss('http://fonts.googleapis.com/icon?family=Material+Icons', false);
        $headerCollection->addCss('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css', false);

        $footerCollection->addJs('https://code.jquery.com/jquery-3.1.0.slim.min.js', true);
        $footerCollection->addJs('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js', false);
        $footerCollection->addJs('../js/index.js', true);
        $footerCollection
            ->setTargetPath('public/js/footer.js')
            ->setTargetUri('js/footer.js')
            ->join(true);


        $nn = new NeuralNetwork();
        $nn->initLayers(2,2,1);
        $this->view->neuralnetwork = $nn;

        $neural = new \ai\Neural();
        $neural->save();




    }
}
