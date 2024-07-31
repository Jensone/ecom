<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{ref}', name: 'app_product')]
    public function show(
        ProductRepository $productRepository,
        string $ref // Paramètre de l'URL
    ): Response
    {
        $product = $productRepository->findOneBy([ // Trouve un produit
            'ref' => $ref // Valeur du filtre
        ]);
        return $this->render('product/show.html.twig', [
            'product' => $product, // Variable à passer à la vue (template)
            'toto' => ['tata', 'riri', 'fifi'],
        ]);
    }
}
