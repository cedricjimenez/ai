<?php
/**
 * User: cjimenez
 * Date: 12/09/16 13:29
 */

use Phalcon\Mvc\Model;

/**
 * Class NeuralLink
 *
 * Link between 2 neurals
 */
class NeuralLink {

    /**
     * Neural starting the link
     *
     * @var Neural
     */
    private $neuralFrom;

    /**
     * Neural ending the link
     *
     * @var Neural
     */
    private $neuralTo;

    /**
     * Weight between the 2 neurals
     *
     * @var float
     */
    private $weight;


    /**
     * Create a Link between 2 neurals
     *
     * @param Neural $neuralFrom
     * @param Neural $neuralTo
     */
    public function __construct(Neural $neuralFrom, Neural $neuralTo)
    {
        $this->setNeuralFrom($neuralFrom);
        $this->setNeuralTo($neuralTo);
        $this->setWeight(0);
    }


    /**
     * @return mixed
     */
    public function getNeuralFrom()
    {
        return $this->neuralFrom;
    }

    /**
     * @param mixed $neuralFrom
     */
    public function setNeuralFrom($neuralFrom)
    {
        $this->neuralFrom = $neuralFrom;
    }

    /**
     * @return mixed
     */
    public function getNeuralTo()
    {
        return $this->neuralTo;
    }

    /**
     * @param mixed $neuralTo
     */
    public function setNeuralTo($neuralTo)
    {
        $this->neuralTo = $neuralTo;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function initializeRandomly() {
        $this->setWeight(rand(0,1000) / 1000);
    }



}