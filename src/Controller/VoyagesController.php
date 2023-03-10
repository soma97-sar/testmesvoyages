<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;




/**
 * Description of VoyagesController
 *
 * @author soumia
 */
class VoyagesController extends AbstractController {
    
    /**
     * @Route("/voyages", name="voyages")
     * @return Response
     */
    public function index(): Response {
        
        $visites = $this->repository->findAllOrderBy('datecreation','DESC');
        return $this->render("pages/voyages.html.twig",[
            'visites'=>$visites,
        ]);
        
    }
    /**
     * @Route("/voyages/tri/{champ}/{order}", name="voyages.sort")
     * @param type $champ
     * @param type $order
     * @return Response
     */
    public function sort($champ, $order):Response {
        $visites = $this->repository->findAllOrderBy($champ, $order);
        return $this->render("pages/voyages.html.twig",[
            'visites'=> $visites
        ]);
        
    }
    /**
     * @Route("/voyages/recherche/{champ}", name="voyages.findallequal")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllEqual($champ, Request $request):Response{
        $valeur=$request->get("recherche");
        $visites=$this->repository->findByEqualValue($champ, $valeur);
        return $this->render("pages/voyages.html.twig",[
            'visites'=>$visites
        ]);
    
    }
    /**
     * @Route("/voyages/voyage/{id}", name="voyages.showone")
     * @param type $id
     * @return Response
     */
    public function showOne($id):Response { 
        $visite= $this->repository->find($id);
        return $this->render("pages/voyage.html.twig",[
            'visite'=>$visite
                
        ]);
        
    }
    /**
     * 
     * @var VisiteRepository
     */
    private $repository;
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository= $repository;    
    }    
    
}

