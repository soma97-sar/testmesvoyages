<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Entity\Environnement;
use App\Repository\EnvironnementRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminEnvironnementController
 *
 * @author soumia
 */
class AdminEnvironnementController extends AbstractController{
    /**
     * 
     * @var EnvironnementRepository
     */
    private $repository;
    /**
     * 
     * @param EnvironnementRepository $repository
     */
    public function __construct(EnvironnementRepository $repository) {
        $this->repository= $repository;    
    }  
    /**
     * @Route("/admin/environnements",name="admin.environnements")
     * @return Response
     */
   
    public function index(): Response {
        
        $environnements = $this->repository->findAll();
        return $this->render("admin/admin.environnements.html.twig",[
            'environnements'=>$environnements
        ]);
        
    }
    /**
     * @Route("/admin/environnement/suppr/{id}", name="admin.environnement.suppr")
     * @param environnement $environnement
     * @return Response
     */
    public function suppr(Environnement $environnement): Response {
        $this->repository->remove($environnement, true);
        return$this->redirectToRoute('admin.voyages');
        
    }
    /**
     * @Route("/admin/environnement/ajout", name="admin.environnement.ajout")
     * @param Request $request 
     * @return Response 
     */
    public function ajout(Request $request): Response {
        $nomEnvironnement=$request->get("nom");
        $environnement=new Environnement();
        $environnement->setNom($nomEnvironnement);
        $this->repository->add($environnement, true);
        return $this->redirectToRoute('admin.environnements');
        }
    
    
}
