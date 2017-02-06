<?php

use Phalcon\Di;
use Phalcon\Test\UnitTestCase as PhalconTestCase;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;


abstract class UnitTestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;



    public function setUp()
    {

        parent::setUp();

        // Load any additional services that might be required during testing
        $di = Di::getDefault();

        $di->set(
            'modelsManager',
            function()
            {
                return new \Phalcon\Mvc\Model\Manager();
            }
        );

        $di->set(
            'modelsMetadata',
            function()
            {
                $redis = new Redis();
                $redis->connect("ai-redis", 6379);

                return new \Phalcon\Mvc\Model\MetaData\Redis(array(
                    "lifetime" => 3600,
                    "redis"    => $redis,
                    'host' => 'ai-redis'
                ));
            }
        );



        /**
         * Database config
         */
        $di->set(
            'db',
            function () {
                return new DbAdapter(
                    [
                        'host' => 'ai-mysql',
                        'username' => 'aiadmin',
                        'password' => '%C3dr1c%',
                        'dbname' => 'aidb'
                    ]
                );
            },
            true
        );


        // Get any DI components here. If you have a config, be sure to pass it to the parent

        $this->setDi($di);

        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError(
                "Please run parent::setUp()."
            );
        }
    }
}