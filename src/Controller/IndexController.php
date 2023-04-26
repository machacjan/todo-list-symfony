<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route(path: '/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

}