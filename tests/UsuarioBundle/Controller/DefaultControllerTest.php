<?php

namespace Tests\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultControllerTest extends WebTestCase {

    public function testShowPost() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Loja")')->count()
        );

        $link = $crawler->selectLink('Comprar')->link();
        $crawler = $client->click($link);

        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Colocar no Carrinho")')->count()
        );

        $link = $crawler->selectLink('Colocar no Carrinho')->link();
        $crawler = $client->click($link);

        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Carrinho")')->count()
        );
    }

}
