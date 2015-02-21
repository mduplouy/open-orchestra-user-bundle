<?php

namespace OpenOrchestra\UserBundle\FunctionalTest\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class FormControllersTest
 */
class FormControllersTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->setServerParameters(
            array(
                'PHP_AUTH_USER' => 'nicolas',
                'PHP_AUTH_PW'   => 'nicolas',
            ),
            array('HTTP_HOST' => 'echonext.phporchestra.dev')
        );
        $this->client->followRedirects();
    }

    /**
     * Test user form
     */
    public function testForm()
    {
        $crawler = $this->client->request('GET', '/admin/user/new');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
