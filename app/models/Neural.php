<?php


namespace ai;

use Phalcon\Mvc\Model;


class Neural extends Model
{
    private $type;

    private $neuralLinkHash;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Adding a neuralLink link
     *
     * @param NeuralLink $neuralLink
     */
    public function addNeuralLink(NeuralLink $neuralLink) {
        $this->neuralLinkHash[] = $neuralLink;
    }

    /**
     * Return the neuron signature
     */
    public function __toString() {
        return 'Neuron : ' . $this->getType();
    }

}