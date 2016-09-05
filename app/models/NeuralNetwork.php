<?php
/**
 * User: cjimenez
 * Date: 05/09/16 13:50
 */

use Phalcon\Mvc\Model;

class NeuralNetwork extends Model
{
    private $inputHash;
    private $hiddenHash;
    private $outputHash;

    /**
     * Adding a neural to the neural network
     *
     * @param String $type
     */
    public function addNeural($type) {

        $neuralModel = new Neural();

        switch($type) {
            case 'input':
                $this->inputHash[] = $neuralModel;
                break;
            case 'hidden':
                $this->hiddenHash[] = $neuralModel;
                break;
            case 'output':
                $this->outputHash[] = $neuralModel;
                break;
            default:
                throw new Exception('Unknown layer');
        }

    }


}