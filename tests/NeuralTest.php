<?php
/**
 * User: cjimenez
 * Date: 12/09/16 13:59
 */

namespace Tests;

use ai\Neural;
use ai\NeuralLink;


class NeuralTest extends \UnitTestCase {

    public function testSetType()
    {
        $neural = new Neural();
        $neural->setType('input');

        $this->assertEquals('input', $neural->getType());
    }

    public function testAddNeuralLink()
    {
        $neuralFrom = new Neural();
        $neuralTo = new Neural();
        $neuralLink = new NeuralLink($neuralFrom, $neuralTo);
        $neuralFrom->addNeuralLink($neuralLink);

        $this->assertCount(1, $neuralFrom->getNeuralLinkHash());
    }

    public function testSave()
    {
        $neural = new Neural();
        $neural->save();
    }

}
