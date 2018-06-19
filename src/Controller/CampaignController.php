<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function defaultAction()
    {
        return new Response(
            '<html><body>First Front page</body></html>'
        );
    }

    /**
     * @Route("/campaign", name="campaign")
     */
    public function index()
    {
        return $this->render('campaign/index.html.twig', [
            'controller_name' => 'CampaignController',
        ]);
    }
}
