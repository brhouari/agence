<?php
namespace App\Controller;

use App\Entity\Prprety;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PrpretyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PrpretyController extends AbstractController {



    /**
     * @var PrpretyRepository
     */

    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;


    public function __construct(PrpretyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;

        $this->em = $em;
    }

    /**
     * @Route("/proprety", name="bien")
     * @return  Response
     *
     */

    public function index(): Response{



        $propreties = $this->repository->findvisible();
        return $this->render('proprety/bien.html.twig', ['curent-menu' => 'properties',
            'propreties' => $propreties ]);
    }

    /**
     * @Route("/proprety/{slug}-{id}", name="show")
     * @return Response
     */
    public function show($slug, $id ): Response
    {
        $prptoty = $this->repository->find($id);
        return $this->render('proprety/show.html.twig', [
            'prprety' => $prptoty,
            'curent-menu' => 'properties'
        ]);
    }
}
