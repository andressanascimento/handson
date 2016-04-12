<?php

namespace CheckoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * @Route("/", name="checkout")
     */
    public function indexAction() {
        return $this->render('CheckoutBundle:Default:index.html.twig');
    }

}
