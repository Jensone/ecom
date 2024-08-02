<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{ref}', name: 'app_product')]
    public function show(
        ProductRepository $productRepository,
        string $ref // Paramètre de l'URL
    ): JsonResponse
    {
        $product = $productRepository->findOneBy([ // Trouve un produit
            'ref' => $ref // Valeur du filtre
        ]);
        return $this->json([
            'product' => ['toto' => 'tata', 'riri' => 'fifi'],
        ]);
    }
}
