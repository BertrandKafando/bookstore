<?php

namespace App\Controller;

use App\Data\Searchdata;
use App\Entity\Livre;
use App\Form\LivreType;
use App\Form\Searchform;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/', name: 'livre_index', methods: ['GET'])]
    public function index(LivreRepository $livreRepository,Request $request): Response
    {
        $data=new Searchdata();
        $form=$this->createForm(Searchform::class,$data);
        $form->handleRequest($request);
       // $livres= $livreRepository->findSearch($data);
        return $this->render('livre/index.html.twig', [
            //'livres' => $livreRepository->findAll(),
            'livres'=>$livreRepository->findSearch($data),
            'form'=>$form->createView()
        ]);
    }

    #[Route('livre/{id}', name: 'livre_show', methods: ['GET'])]
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }


}
