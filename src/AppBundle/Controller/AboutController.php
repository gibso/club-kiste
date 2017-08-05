<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Eventseries;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class AboutController
 * @package AppBundle\Controller
 */
class AboutController extends Controller
{
    /**
     * @Route("/impressum", name="about")
     */
    public function indexAction()
    {
        return $this->render('about.html.twig', [
            'active' => 'about',
            'eventseriesNav' => $this->getDoctrine()->getManager()->getRepository(Eventseries::class)->findAll()
        ]);
    }
}
