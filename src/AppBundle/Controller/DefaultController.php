<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/page/1", name="page1")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_PAGE_1')")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/page/2", name="page2")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_PAGE_2')")
     */
    public function page2Action()
    {
        return $this->render('default/page2.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/page/3", name="page3")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function page3Action()
    {
        return $this->render('default/page2.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}
