<?php

namespace App\Controller;
use App\Entity\Model; // Ensure you have the correct namespace for your Model entity

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_cars')]
    public function index(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $model = $em->getRepository(Model::class)->findAll();
        $model = $paginator->paginate($model, $request->query->getInt('page', 1), 5);
        return $this->render('cars/cars.html.twig', [
            'models' => $model,
        ]);
    }
}