<?php
/**
 * User: cjimenez
 * Date: 05/09/16 13:50
 */

namespace ai;

use Phalcon\Mvc\Model;
use ai\Neural;

class NeuralNetwork extends Model
{
    /**
     * Hash of Input Neural Objects
     *
     * @var array of Neural
     */
    private $inputHash;

    /**
     * Hash of Hidden Neural Objects
     *
     * @var array of Neural
     */
    private $hiddenHash;

    /**
     * Hash of Ouput Neural Objects
     *
     * @var array of Neural
     */
    private $outputHash;

    /**
     * Links between input and hidden neurons
     *
     * @var array of NeuralLink
     */
    private $inputHiddenLinkHash;


    /**
     * Links between hidden and output neurons
     *
     * @var array of NeuralLink
     */
    private $hiddenOutputLinkHash;

    /**
     * Adding a neural to the neural network
     *
     * @param String $type
     *
     * @throws Exception
     */
    public function addNeural($type) {

        $neuralModel = new Neural();
        $neuralModel->setType($type);

        switch($type) {
            case 'input':
                $neuralModel = $this->linkTo($neuralModel, 'hidden'); // Link the input neural to hidden neurals
                $this->inputHash[] = $neuralModel;
                break;
            case 'hidden':
                $neuralModel = $this->linkTo($neuralModel, 'input'); // Link the hidden neural to input neurals
                $neuralModel = $this->linkTo($neuralModel, 'output'); // Link the hidden neural to input neurals
                $this->hiddenHash[] = $neuralModel;
                break;
            case 'output':
                $neuralModel = $this->linkTo($neuralModel, 'hidden'); // Link the output neural to hidden neurals
                $this->outputHash[] = $neuralModel;
                break;
            default:
                throw new Exception('Unknown layer');
        }
    }

    /**
     * @param Neural $neuralModel Neural to link to others
     * @param string $type        Layer name to join to the neural
     */
    private function linkTo($neuralModel, $type) {

        switch($type) {
            case 'input':
                $targetNeuronHash = $this->inputHash;
                break;
            case 'hidden':
                $targetNeuronHash = $this->hiddenHash;
                break;
            case 'output':
                $targetNeuronHash = $this->outputHash;
                break;
            default:
                throw new Exception('Invalid layer type');
                break;
        }

        // Creating the links
        foreach($targetNeuronHash as $targetNeuron) {
            $neuralLink = new NeuralLink($neuralModel, $targetNeuron);
            $neuralModel->addNeuralLink($neuralLink);
        }

        return $neuralModel;
    }


    /**
     * Initialize the neural network with layers
     *
     * @param integer $nbInput  Nb of input neurons
     * @param integer $nbHidden Nb of hidden neurons
     * @param integer $nbOutput Nb of output neurons
     *
     * @throws Exception
     */
    public function initLayers($nbInput, $nbHidden, $nbOutput) {
        for($i=0; $i<$nbInput; $i++) {
            $this->addNeural('input');
        }

        for($i=0; $i<$nbHidden; $i++) {
            $this->addNeural('hidden');
        }

        for($i=0; $i<$nbOutput; $i++) {
            $this->addNeural('output');
        }
    }

    public function __toString()
    {
        $s =  "Input layer\n";
        foreach($this->inputHash as $neural) {
            $s .= $neural . "\n";
        }

        $s .=  "Hidden layer\n";
        foreach($this->hiddenHash as $neural) {
            $s .= $neural . "\n";
        }

        $s .=  "Output layer\n";
        foreach($this->outputHash as $neural) {
            $s .= $neural . "\n";
        }


        return $s;
    }


}