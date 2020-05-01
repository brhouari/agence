<?php
namespace App\Controller;

use App\Entity\Prprety;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PrpretyRepository;
use Doctrine\Common\Persistence\ObjectManager;


use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return  Response
     */

    public function index(PaginatorInterface $paginator, Request $request): Response{

         $pr = new Prprety();
       // $em = $this->getDoctrine ()->getManager ();
        //$queryBuilder = $em->getRepository('App:prprety')->createQueryBuilder('bp');
         $queryBuilder = $this->repository->findvisible();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->andWhere('p.title LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        if($request->query->getInt('pride')){
            $queryBuilder
                ->andWhere ('p.price < :maxprice')
                ->setParameter ('maxprice', $request->query->getInt ('pride'));

        }


         $propreties = $paginator->paginate(
            $queryBuilder->getQuery(), /* query NOT result */

            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('limit', 12)/*limit per page*/
        );

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
