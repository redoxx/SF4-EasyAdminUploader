<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Campaign;
use App\Entity\Code;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    /**
     * @Route("/start", name="coderegister")
     */
    public function codeRegister(Request $request)
    {
    	// build the form
    	$code = new Code();
    	$form = $this->createFormBuilder($code)
            ->add('content', TextType::class, 
            	array(
	            	'label' => 'Enter your code to earn rewards',
	            	'required' => TRUE,
	            	'attr' => array('placeholder' => ' XXXX-XXXX-XXXX-XXXX ')
            	)
        	)
            ->add(
            	'save', SubmitType::class, 
            	array(
            		'label' => 'Redeem your code', 
            		'attr' => array('class' => 'btn btn-primary')
            	)
            )
            ->getForm();
        // handle the submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        	// validate the code
        	$data = $form->getData();
        	//var_dump($data->getContent());die;
        	return $this->redirectToRoute('downloadasset');
        }

        return $this->render('campaign/coderegister.html.twig', array(
            'form' => $form->createView(),
            'error'    => ''
        ));
    }

    /**
     * @Route("/downloadasset", name="downloadasset")
     */
    public function downloadAsset(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$campaign = $em->getRepository(campaign::class)->findLastOne();

    	return $this->render('campaign/downloadasset.html.twig', array(
            'campaign' => $campaign
        ));
    }
    
}
