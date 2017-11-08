<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $req)
    {
        $image = new Image();

        $form = $this->get('form.factory')->create(ImageType::class, $image);

        if ($req->isMethod('POST')&& $form->handleRequest($req)->isValid()){

            $image->upload();

        }

        return $this->render('OCPlatformBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
