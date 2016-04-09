<?php

namespace CarrinhoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use CarrinhoBundle\Entity\Carrinho;

class DefaultController extends Controller {

    /**
     * @Route("/", name="_carrinho")
     */
    public function indexAction() {
        $content = 'CarrinhoBundle:Default:index.html.twig';

        $session = $this->get('session');
        $cart = $session->get('cart');
        if (!$cart || $cart->count() == 0) {
            $content = 'CarrinhoBundle:Default:empty.html.twig';
        }
        return $this->render('CarrinhoBundle:Default:index.html.twig');
    }

    protected function redirectAndNotify($message = null) {
        if ($message) {
            $this->get('session')->getFlashBag()->add('notice', $message);
        }
        return $this->redirect($this->generateUrl('_carrinho'));
    }

    /**
     * @Route("/add/{id}", name="_add")
     */
    public function addAction($id) {

        $product = $this->getDoctrine()
                ->getRepository('ProdutoBundle:Produto')
                ->findOneById($id);

        if (!$product) {
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Produto não existe'
            );
            return $this->redirect($this->generateUrl('_carrinho'));
        }

        $session = $this->get('session');
        $cart = $session->get('cart', new Carrinho());
        $cart->add($product);
        $session->set('cart', $cart);


        return $this->render('CarrinhoBundle:Default:index.html.twig');
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     */
    public function deleteAction($id) {
        $session = $this->get('session');
        $cart = $session->get('cart');
        if ($cart && $cart->count() > 0) {
            $id = (int) $id;
            $cart->delete($id);
            $session->set('cart', $cart);
        }

        return $this->redirect($this->generateUrl('_carrinho'));
    }

    /**
     * @Route("/update", name="_update")
     */
    public function updateAction(Request $request) {
        $id = (int) $request->query->get('id');
        $quantity = $request->query->get('quantidade');

        if (!$id || !$quantity) {
            return $this->redirectAndNotify('Não foi possivel atualizar o carrinho');
        }

        $session = $this->get('session');
        $cart = $session->get('cart');
        if ($cart && $cart->count() > 0) {
            $cart->update($id, $quantity);
            $session->set('cart', $cart);
        }

        return $this->redirect($this->generateUrl('_carrinho'));
//}
    }
}