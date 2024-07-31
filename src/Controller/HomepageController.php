<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage', methods: ['GET'])]
    public function index(
        ProductRepository $productRepository
    ): Response {
        $products = $productRepository->findBy(
            [], // Valeur du filtre
            ['name' => 'ASC'], // Ordre de tri basé sur le nom
            10 // Nombre dans le résultat
        );
        // dd($products); // Dump une variable et Die pour arrêter le script
        return $this->render('homepage/index.html.twig', [
            'products' => $products,
        ]);
    }
}
