<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrpretyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param PrpretyRepository $repository
     * @return Response
     */



    public function index(PrpretyRepository $repository): Response{

     $properties = $repository->findlatest();

    return $this->render('pages/home.html.twig',['propreties' => $properties]);
  }
}
