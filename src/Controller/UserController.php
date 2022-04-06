<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * TEST İÇİN OLUŞTURULDU HİÇBİR ÖNEMİ YOK.
     * @return Response
     */
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to PATH company API!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
