<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/** 
* @Route("/api")
*/

class BloquerPartenaireController extends AbstractController
{
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @Route("/bloquer/partenaire", name="bloquer_partenaire")
     */
    public function bloquePartenaire(Request $request, EntityManagerInterface $EntityManagerInterface )
    {
        $values = json_decode($request->getContent());
        $userconnect = $this->tokenStorage->getToken()->getUser();

        if(isset($values)) {

            $repo = $this->getDoctrine()->getRepository(User::class);
            $users = $repo->findByPartenaire($values->id);
            //var_dump($values->id);die;
            foreach($users as $user)
            {
                $user->setIsActive($values->isActive);

                $EntityManagerInterface->persist($user);

            }
            $EntityManagerInterface->flush();
            $data = [
                'status' => 201,
                'message' => 'ok'
            ];

            return new JsonResponse($data, 201);
    }

}
}
