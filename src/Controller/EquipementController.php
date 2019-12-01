<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\EquipementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{
    /**
     * @Route("/", name="equipement")
     */
    public function index()
    {
        $equipement = $this->getDoctrine()->getRepository(Stock::class)->findall();

        return $this->render('equipement/index.html.twig', [
            'equipement' => $equipement,
        ]);
    }

     /**
     * @Route("/load", name="load")
     */
    public function loadAction(){
        $Equipment1 = new Stock();
        $Equipment1 ->setname('Chasubles');
        $Equipment1 ->setDescription('La chasuble est un vêtement sacerdotal à deux pans et sans manche avec une ouverture pour la tête, que le prêtre revêt.');
        $Equipment1 ->setPrice(1,33);
        $Equipment1 ->setStock(15);
        
        $Equipment2 = new Stock();
        $Equipment2 ->setname('ballons');
        $Equipment2 ->setDescription('Un ballon ou ballon gonflable est un contenant léger et étanche destiné à être rempli de gaz, en général de lair, parfois de lhélium afin quil vole. ');
        $Equipment2 ->setPrice(2,44);
        $Equipment2 ->setStock(5);
     
        $Equipment3 = new Stock();
        $Equipment3 ->setname('plots');
        $Equipment3 ->setDescription('plots pour terrasse en bois et en dalle. Livraison rapide 9,90€. Fabrication FR et UE. Produits conformes DTU. Garantie 10 ans. Paiement sécurisé. Fabrication Européenne. ..');
        $Equipment3 ->setPrice(3,22);
        $Equipment3 ->setStock(10);

        $Equipment4 = new Stock();
        $Equipment4 ->setname('mini-plots');
        $Equipment4 ->setDescription('Grand choix de plots pour terrasse en bois et en dalle. Livraison rapide 9,90€. Fabrication FR et UE. Produits conformes DTU. Garantie 10 ans. Paiement sécurisé.');
        $Equipment4 ->setPrice(4,44);
        $Equipment4 ->setStock(8);

        $Equipment5 = new Stock();
        $Equipment5 ->setname('barres');
        $Equipment5 ->setDescription('Le but au football est un cadre rectangulaire de 7,32 mètres de large sur 2,44 mètres de haut, défendu par un gardien de but. Un but est marqué quand le ballon...');
        $Equipment5 ->setPrice(5,22);
        $Equipment5 ->setStock(7);

        $Equipment6 = new Stock();
        $Equipment6 ->setname('maillots');
        $Equipment6 ->setDescription('Visitez le site Nike® officiel : livraison et retours gratuits en ligne. Livraison rapide gratuite. Créez avec Nike By You. Réduction étudiante 10 % Retours gratuits 60 jours.');
        $Equipment6 ->setPrice(6,33);
        $Equipment6 ->setStock(15);

        $Equipment7 = new Stock();
        $Equipment7 ->setname('shorts');
        $Equipment7 ->setDescription('Pour lintérieur, le sport ou encore en ville retrouvez tous les Shorts du Slip. Nos shorts & bermudas 100% made in France. Nouvelle Collection. Paiement Sécurisé. ');
        $Equipment7 ->setPrice(7,11);
        $Equipment7 ->setStock(15);

        $Equipment8 = new Stock();
        $Equipment8 ->setname('sifflet');
        $Equipment8 ->setDescription('Un sifflet est un petit instrument à vent permettant de produire un sifflement strident équivalant à un signal fort. Sifflets de police : à gauche à roulette, à droite un ...');
        $Equipment8 ->setPrice(8,33);
        $Equipment8 ->setStock(2);
        
        $array = [$Equipment1, $Equipment2, $Equipment3, $Equipment4, $Equipment5, $Equipment6, $Equipment7, $Equipment8];
        $em = $this->getDoctrine()->getManager();
        foreach($array as $equipement)
        {
            $em->persist($equipement);
        }
            $em->flush();
            return $this->redirectToRoute('equipement');
        }
         
    

/**
     * @Route("/infos/{id}", name="info" )
     * @Method({"GET"})
     */
    public function info($id){
        $equipement = $this->getDoctrine()->getRepository(Stock::class)->find($id);
        return $this->render('equipement/show.html.twig', [
            'equipement' => $equipement,
        ]);
    }
    /**
     * @Route("/add", name="add_equipement")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
        $task = new Stock();
        $form = $this->createForm(EquipementType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('equipement');
        }
            return $this->render('equipement/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }


    }