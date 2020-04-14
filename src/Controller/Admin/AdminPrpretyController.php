<?php
namespace App\Controller\Admin;


use App\Entity\Prprety;
use App\Form\PrpretyType;
use App\Repository\PrpretyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;



class AdminPrpretyController extends AbstractController {



    /**
     * @var PrpretyRepository
     */

    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;


    public function __construct(PrpretyRepository $repository, EntityManagerInterface $em )
    {
        $this->repository = $repository;

        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.proprety.index")
     * @return Response
     */

    public function index(): Response{


        $properties = $this->repository->findAll();

        return $this->render('admin/proprety/index.html.twig', ['propreties' => $properties]);

    }

    /**
     * @Route("/admin/prprety/create", name="admin.proprety.news")
     * @return Response
     */

    public function news(Request $request): Response{
        $prprety =new Prprety();
        $form = $this->createForm(PrpretyType::class, $prprety);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($prprety);
            $this->em->flush();
            $this->addFlash ('success', 'Bien ajouter avec succés');
            return $this->redirectToRoute('admin.proprety.index');

        }
        return $this->render('admin/proprety/news.html.twig',
            ['prprety' => $prprety
                ,'form' => $form ->createView()]);

    }

    /**
     * @Route("/admin/prprety/{id}", name="admin.proprety.edit", methods={"GET","POST"})
     * @param Prprety $prprety
     * @param Request $request
     * @return Response
     */


    public function edit(prprety $prprety, Request $request): Response{

        $form = $this->createForm(PrpretyType::class, $prprety);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash ('success', 'Bien modifier avec succés');
            return $this->redirectToRoute('admin.proprety.index');

        }

        return $this->render('admin/proprety/edit.html.twig',
            ['prprety' => $prprety
             ,'form' => $form ->createView()]);

    }


    /**
     * @Route("/admin/prprety/{id}", name="admin.proprety.delete", methods={"DELETE"})
     * @param Prprety $prprety
     * @param Request $request
     * @return Response
     */
    public function delete(prprety $prprety, Request $request): Response{

        if ($this->isCsrfTokenValid($prprety->getId (), $request->get('_token'))){
             $this->em->remove($prprety);
             $this->em->flush();
             $this->addFlash ('success', 'Bien supprimer avec succés');

        }

        //$this->em->remove($prprety);
       // $this->em->flush();

        return $this->redirectToRoute('admin.proprety.index');


    }
}