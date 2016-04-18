<?php

namespace CheckoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * @Route("/", name="checkout")
     */
    public function indexAction() {
        $session = $this->get('session');
        $cart = $session->get('cart');
        if (!$cart || $cart->count() == 0) {
            return $this->redirect($this->generateUrl('_home'));
        }

        return $this->render('CheckoutBundle:Default:index.html.twig');
    }

    /**
     * @Route("/sucesso", name="sucesso")
     */
    public function sucessoAction() {
        $session = $this->get('session');
        $cart = $session->get('cart');
        if (!$cart || $cart->count() == 0) {
            return $this->redirect($this->generateUrl('_home'));
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
                ->setSubject('Pedido realizado com sucesso!')
                ->setFrom('atendimento@loja.com')
                ->setTo($user->getEmail())
                ->setBody(
                $this->renderView(
                        'CheckoutBundle:Default:email.txt.twig', array('user' => $user, 'cart' => $cart)
        ));
        $this->get('mailer')->send($message);

        $session->remove('cart');
        return $this->render('CheckoutBundle:Default:sucesso.html.twig');
    }

}
