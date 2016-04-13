<?php

namespace UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Form\UsuarioType;

class DefaultController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('checkout'));
        }


        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                    Security::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }

        return $this->render(
                        'UsuarioBundle:Default:login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $session->get(Security::LAST_USERNAME),
                    'error' => $error,
                        )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction() {
        return $this->render('UsuarioBundle:Default:index.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutCheckAction() {
        return $this->render('UsuarioBundle:Default:index.html.twig');
    }

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request) {
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user = $this->getDoctrine()->getRepository('UsuarioBundle:Usuario')->insert($user);

            // automatic login user
            $providerKey = 'secured_area'; // Name of firewall
            $token = new UsernamePasswordToken($user, null, $providerKey, array('AUTO_LOGIN'));
            $this->container->get('security.token_storage')->setToken($token);
            return $this->redirect($this->generateUrl('checkout'));
        }

        return $this->render('UsuarioBundle:Default:registro.html.twig', array('form' => $form->createView())
        );
    }

}
