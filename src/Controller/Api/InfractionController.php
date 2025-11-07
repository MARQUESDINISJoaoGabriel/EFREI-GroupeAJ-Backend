<?php

namespace App\Controller\Api;

use App\Entity\Infraction;
use App\Repository\EcurieRepository;
use App\Repository\PiloteRepository;
use App\Repository\InfractionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/infractions', name: 'api_infractions_')]
class InfractionController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(Request $req, InfractionRepository $repo): JsonResponse
    {
        $ecurieId = $req->query->get('ecurie');
        $piloteId = $req->query->get('pilote');
        $date = $req->query->get('date');

        $infractions = $repo->findAll();
        $filtered = [];

        foreach ($infractions as $inf) {
            if ($ecurieId && $inf->getEcurie()?->getId() != $ecurieId) continue;
            if ($piloteId && $inf->getPilote()?->getId() != $piloteId) continue;
            if ($date && $inf->getDate()->format('Y-m-d') != $date) continue;

            $filtered[] = [
                'id' => $inf->getId(),
                'type' => $inf->getType(),
                'montant' => $inf->getMontant(),
                'points' => $inf->getPoints(),
                'description' => $inf->getDescription(),
                'course' => $inf->getCourse(),
                'date' => $inf->getDate()->format('Y-m-d H:i:s'),
                'pilote' => $inf->getPilote()?->getNom(),
                'ecurie' => $inf->getEcurie()?->getNom()
            ];
        }

        return $this->json($filtered, 200);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        PiloteRepository $piloteRepo,
        EcurieRepository $ecurieRepo
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['type']) || !isset($data['description'])) {
            return $this->json(['error' => 'Données invalides'], 400);
        }

        $infraction = new Infraction();
        $infraction->setType($data['type']);
        $infraction->setDescription($data['description']);
        $infraction->setCourse($data['course'] ?? 'Course inconnue');
        $infraction->setDate(new \DateTime());

        if ($data['type'] === 'amende' && isset($data['montant'])) {
            $infraction->setMontant($data['montant']);
        } elseif ($data['type'] === 'penalite' && isset($data['points'])) {
            $infraction->setPoints($data['points']);
        }

        if (isset($data['pilote_id'])) {
            $pilote = $piloteRepo->find($data['pilote_id']);
            if ($pilote) {
                $infraction->setPilote($pilote);
                if ($infraction->getPoints()) {
                    $pilote->setPoints(max(0, $pilote->getPoints() - $infraction->getPoints()));
                    if ($pilote->getPoints() < 1) {
                        $pilote->setStatut('suspendu');
                    }
                    $em->persist($pilote);
                }
            }
        } elseif (isset($data['ecurie_id'])) {
            $ecurie = $ecurieRepo->find($data['ecurie_id']);
            if ($ecurie) {
                $infraction->setEcurie($ecurie);
            }
        }

        $em->persist($infraction);
        $em->flush();

        return $this->json(['message' => 'Infraction enregistrée', 'id' => $infraction->getId()], 201);
    }
}
