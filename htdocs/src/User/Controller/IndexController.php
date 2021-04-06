<?php

namespace App\User\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/{page}",name="index", requirements={"page": "^$|^(?!api).+"}))
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('base.html.twig');
    }
}