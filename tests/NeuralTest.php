<?php
/**
 * User: cjimenez
 * Date: 12/09/16 13:59
 */

namespace Tests;

use \ai\Neural;


class NeuralTest extends \UnitTestCase {

    public function testSetType()
    {


        $neural = new Neural();
        $neural->setType('input');

        $this->assertEquals('input', $neural->getType());
    }

}
