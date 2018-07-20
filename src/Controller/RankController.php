<?php

namespace App\Controller;

use App\Entity\Rank;
use App\Repository\RankRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rank")
 */
class RankController extends Controller
{
    /**
     * @Route("/", name="rank_index", methods={"GET","POST"})
     * @param RankRepository $rankRepository
     * @return Response
     */
    public function index(RankRepository $rankRepository): Response
    {

        // Modification d'un rang
        if(isset($_POST['rankName']) and isset($_POST['rankId']) ) {
            $rankRepository->find($_POST['rankId'])->setName($_POST['rankName']);
            $this->getDoctrine()->getManager()->flush();
        }

        // Ajout d'un rang
        if(isset($_POST['newRankName'])) {
            $rank = new Rank();
            $rank->setName($_POST['newRankName']);
            $this->getDoctrine()->getManager()->persist($rank);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('rank_index');
        }

        return $this->render('rank/index.html.twig', ['ranks' => $rankRepository->findAll()]);
    }

    /**
     * @Route("/{id}", name="rank_delete", methods="DELETE")
     * @param Request $request
     * @param Rank $rank
     * @return Response
     */
    public function delete(Request $request, Rank $rank): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rank->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rank);
            $em->flush();
        }

        return $this->redirectToRoute('rank_index');
    }
}
