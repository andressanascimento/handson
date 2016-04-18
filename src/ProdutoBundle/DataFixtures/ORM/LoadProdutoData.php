<?php
namespace ProdutoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProdutoBundle\Entity\Produto;

class LoadProductData implements FixtureInterface
{
   private $products = array(
       array(
           'nome' => 'Oculos Bem Legal',
           'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut facilisis sapien erat, vel vehicula risus hendrerit vel.',
           'preco' => 299.9,
           'imagemPath' => '/bundles/produto/images/oculos.jpg',
       ),
       array(
           'nome' => 'Tenis Cor de Rosa',
           'descricao' => 'Pellentesque condimentum convallis consectetur. Aliquam dolor dolor, convallis eu arcu vitae, iaculis sagittis ipsum.',
           'preco' => 359.9,
           'imagemPath' => '/bundles/produto/images/tenis.jpg',
       ),
       array(
           'nome' => 'Bota Trekking',
           'descricao' => 'Mauris faucibus magna arcu, id ultrices est consectetur vitae. Nunc id lorem rhoncus, auctor eros id, posuere quam.',
           'preco' => 539.9,
           'imagemPath' => '/bundles/produto/images/bota.jpg',
       ),
       array(
           'nome' => 'Mochila Acampamento',
           'descricao' => 'Praesent a enim vestibulum, accumsan mauris id, mattis nibh. Donec euismod enim sit amet tellus blandit, sit amet condimentum tellus commodo.',
           'preco' => 222.9,
           'imagemPath' => '/bundles/produto/images/mochila.jpg',
       ),
   );

   /**
    * {@inheritDoc}
    */
   public function load(ObjectManager $manager)
   {
        foreach ($this->products as $product) {
           $entity = new Produto();
           $entity->setNome($product['nome']);
           $entity->setDescricao($product['descricao']);
           $entity->setPreco($product['preco']);
           $entity->setImagemPath($product['imagemPath']);

           $manager->persist($entity);
           $manager->flush();
       }
   }
}
