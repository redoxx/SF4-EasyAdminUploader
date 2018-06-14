<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CampaignController extends Controller
{
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
