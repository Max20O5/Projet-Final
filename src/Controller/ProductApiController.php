<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductApiController extends AbstractController
{
    #[Route('/product/api', name: 'app_product_api')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductApiController.php',
        ]);
    }
     #[Route("/Product", methods: ["POST"])]

     #[Route('/products', name: 'create_product', methods: ['POST'])]
     public function createProduct(Request $request, EntityManagerInterface $em): JsonResponse
     {
         $data = json_decode($request->getContent(), true);
 
         if (isset($data['name']) && isset($data['price'])) {
             $product = new Product();
             $product->setName($data['name']);
             $product->setPrice($data['price']);
 
             $em->persist($product);
             $em->flush();
 
             return $this->json($product, 201);
         } else {
             return $this->json(['error' => 'Invalid data'], 400);
         }
     }
}
