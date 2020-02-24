<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


 /** 
 * @Route("/api")
 */

class PartenaireController extends AbstractController
{
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     * @Route("/partenaire", name="partenair", methods={"POST"})
     */
    public function Cree_user(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        $userconnect = $this->tokenStorage->getToken()->getUser();

        if(isset($values)) {

            $role = $this->getDoctrine()->getRepository(Role::class);
            $rolepartenaire = $role->find($values->role);

            $repo = $this->getDoctrine()->getRepository(Partenaire::class);
            $repopartenaire = $repo->find($values->id);
            
            $userpar = new User();
            $userpar->setEmail($values->email);
            $userpar->setPassword($passwordEncoder->encodePassword($userpar, $values->password));
            $userpar->setPrenom($values->prenom);
            $userpar->setNom($values->nom); 
            $userpar->setRole($rolepartenaire);
            $userpar->setIsActive(true);    
            $userpar->setPartenaire($repopartenaire);
           
            $entityManager->persist($userpar);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'ok'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'le creation est echec'
        ];
        return new JsonResponse($data, 500);
    }
}





    