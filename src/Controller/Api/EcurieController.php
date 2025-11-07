<?php

namespace App\Controller\Api;

use App\Entity\Ecurie;
use App\Entity\Pilote;
use App\Repository\EcurieRepository;
use App\Repository\PiloteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/ecuries', name: 'api_ecuries_')]
class EcurieController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(EcurieRepository $repo): JsonResponse
    {
        $ecuries = $repo->findAll();
        $data = [];

        foreach ($ecuries as $ecurie) {
            $data[] = [
                'id' => $ecurie->getId(),
                'nom' => $ecurie->getNom(),
                'moteur' => $ecurie->getMoteur(),
                'pilotes' => array_map(fn($p) => [
                    'id' => $p->getId(),
                    'nom' => $p->getNom(),
                    'prenom' => $p->getPrenom(),
                    'statut' => $p->getStatut(),
                    'points' => $p->getPoints()
                ], $ecurie->getPilotes()->toArray())
            ];
        }

        return $this->json($data, 200);
    }

    #[Route('/{id}/pilotes', name: 'update_pilotes', methods: ['PATCH'])]
    #[IsGranted('ROLE_ADMIN')]
    public function updatePilotes(
        int $id,
        Request $request,
        EcurieRepository $ecurieRepo,
        PiloteRepository $piloteRepo,
        EntityManagerInterface $em
    ): JsonResponse {
        $ecurie = $ecurieRepo->find($id);
        if (!$ecurie) {
            return $this->json(['error' => 'Ecurie non trouvée'], 404);
        }

        $body = json_decode($request->getContent(), true);
        if (!isset($body['pilotes']) || !is_array($body['pilotes'])) {
            return $this->json(['error' => 'Liste des pilotes invalide'], 400);
        }

        foreach ($body['pilotes'] as $piloteId) {
            $pilote = $piloteRepo->find($piloteId);
            if ($pilote) {
                $pilote->setEcurie($ecurie);
                $em->persist($pilote);
            }
        }

        $em->flush();
        return $this->json(['message' => 'Pilotes mis à jour pour ' . $ecurie->getNom()], 200);
    }
}