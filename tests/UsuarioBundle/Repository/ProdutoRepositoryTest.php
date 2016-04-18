<?php

namespace Tests\ProdutoBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProdutoRepositoryTest extends KernelTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp() {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
    }

    public function testSearchByCategoryName() {
        $products = $this->em
                ->getRepository('ProdutoBundle:Produto')
                ->search('tenis')
        ;

        $this->assertCount(1, $products);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown() {
        parent::tearDown();

        $this->em->close();
    }

}
