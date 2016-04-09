<?php

namespace CarrinhoBundle\Entity;

use \ArrayObject;
use ProdutoBundle\Entity\Produto;

class Carrinho extends ArrayObject
{
    public function __constructor()
   {
       $this->setFlags(ArrayObject::ARRAY_AS_PROPS);
   }

   public function add(Produto $product)
   {
        if ($this->offsetExists($product->getId())) {
           $cartItem = $this->offsetGet($product->getId());
           $newQuantity = $cartItem->quantidade + 1;
           $this->update($product->getId(), $newQuantity);
       } else {
           $cartItem = new ArrayObject();
           $cartItem->setFlags(ArrayObject::ARRAY_AS_PROPS);
           $cartItem->offsetSet('produto', $product);
           $cartItem->offsetSet('quantidade', 1);
           $this->offsetSet($product->getId(), $cartItem);
       }
   }

   /**
    * @param int $id
    */
   public function delete($id)
   {
        if (is_int($id)) {
           $this->offsetUnset($id);
       }
   }

   /**
    * @param int $id
    */
   public function update($id, $quantity)
   {
        if (is_int($id)) {
           $isValidQuantity = round($quantity) && ($quantity > 0 && $quantity <= 10);
            if ($isValidQuantity && $this->offsetExists($id)) {
               $cartItem = $this->offsetGet($id);
               $cartItem->quantidade = $quantity;
           }
       }
   }

   public function getQuantity()
   {
       $quantity = 0;
        foreach ($this as $cartItem) {
           $quantity += $cartItem->quantidade;
       }
        return $quantity;
   }

   public function getTotal()
   {
       $total = 0;
        foreach ($this as $cartItem) {
           $total += $cartItem->produto->getPreco() * $cartItem->quantidade;
       }
        return $total;
   }
}
