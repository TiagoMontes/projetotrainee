<?php
// src/Controller/LuckyController.php
namespace App\Controller; // namespace é o caminho do arquivo

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController 
{
    public function number(): Response // number é uma função que retorna um objeto response 
    {
        $number = random_int(0, 100); // $number é uma variável que recebe um número aleatório entre 0 e 100

        return $this->render('lucky/number.html.twig', [ // retorna um objeto response com o template number.html.twig
            'number' => $number, // passa a variável number para o template 
        ]);
    }
}

// controller é um arquivo que retorna uma resposta para o navegador -> controller: App\Controller\LuckyController::number que significa que o controller é o arquivo LuckyController.php e a função number() que retorna um objeto Response