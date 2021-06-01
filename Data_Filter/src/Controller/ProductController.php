<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product")
     */
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class,$data);
        $form->handleRequest($request);
        $products =$productRepository->findSearch($data);
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form'=> $form->createView()
        ]);
    }
}
