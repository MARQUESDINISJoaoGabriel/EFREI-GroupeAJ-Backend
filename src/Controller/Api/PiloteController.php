<?php

namespace App\Controller\Api;

use App\Repository\PiloteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/pilotes', name: 'api_pilotes_')]
class PiloteController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(PiloteRepository $repo): JsonResponse
    {
        $pilotes = $repo->findAll();
        $data = [];

        foreach ($pilotes as $p) {
            $data[] = [
                'id' => $p->getId(),
                'prenom' => $p->getPrenom(),
                'nom' => $p->getNom(),
                'points' => $p->getPoints(),
                'statut' => $p->getStatut(),
                'ecurie' => $p->getEcurie()?->getNom()
            ];
        }

        return $this->json($data, 200);
    }
}