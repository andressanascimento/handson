<?php

namespace ProdutoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="_home")
     */
    public function indexAction() {
        $products = $this->getDoctrine()
                ->getRepository('ProdutoBundle:Produto')
                ->findAll();

        if (empty($products)) {
            throw $this->createNotFoundException('No products avaiable');
        }

        return $this->render('ProdutoBundle:Default:index.html.twig', array('products' => $products)
        );
    }

    /**
     * @Route("/produto/{id}", name="_produto")
     */
    public function produtoAction($id) {
        $product = $this->getDoctrine()
                ->getRepository('ProdutoBundle:Produto')
                ->findOneById($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found with id: ' . $id);
        }

        return $this->render('ProdutoBundle:Default:produto.html.twig', array('product' => $product)
        );
    }

    /**
     * @Route("/search", name="_search")
     */
    public function searchAction(Request $request) {
        $find = $request->query->get('find');
        $products = $this->getDoctrine()->getRepository('ProdutoBundle:Produto')->search($find);

        if (empty($products)) {
            throw $this->createNotFoundException('No products avaiable');
        }

        return $this->render('ProdutoBundle:Default:index.html.twig', array('products' => $products, 'find' => $find)
        );
    }

}
