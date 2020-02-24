<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Entity\Contrat;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
     * @Route("/api")
     */
class CompteController extends AbstractController
{
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    
    }
    /**
     * @Route("/nouveauCompte", name="creation_compte_nouveauPartenaire", methods={"POST"})
     */
    public function nouveau_compte(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $PasswordEncoderInterface, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $userCreateur = $this->tokenStorage->getToken()->getUser();

        $values = json_decode($request->getContent());
        if(isset($values->ninea))
        {
                //les class 
                $dateCreation = new \DateTime();
                //var_dump($dateCreation);die;
                $depot = new Depot();
                $compte = new Compte();                     
                $user = new User();
                $partenaire = new Partenaire(); 

                //pour le compte USER  

                $roleRepository = $this->getDoctrine()->getRepository(Role::class);
                $role=$roleRepository->find($values->role);
                //partenaire
                $partenaire->setNinea($values->ninea);
                $partenaire->setRC($values->rc); 
                

                $entityManager->persist($partenaire);
                $entityManager->flush();

                //les information d'user
                $user->setNom($values->nom);
                $user->setPrenom($values->prenom);
                $user->setEmail($values->email);
                $user->setPassword($PasswordEncoderInterface->encodePassword($user, $values->password));
                $user->setRole($role);
                $user->setPartenaire($partenaire);

                
                $entityManager->persist($user);
                $entityManager->flush();

                

                //GENERATION DU COMPTE  
                $annee = Date('y');
                $nb = $this->getLastCompte();
                $long = strlen($nb);
                $nin = substr($partenaire->getNinea() , -2);
                $NumCompte = str_pad("NG".$annee.$nin, 11-$long, "0").$nb;

                 //var_dump($NumCompte);die;


             //pour le compte   
             // recuperer de l'utilisateur qui cree le compte et faire  un depot initial

             $userCreateur = $this->tokenStorage->getToken()->getUser();
             $compte->setNumCompte($NumCompte);
            
             $compte->setSolde(0);
             $compte->setDatecreat($dateCreation);
             $compte->setUserCreat($userCreateur);
             $compte->setPartenaires($partenaire); 
              
             $entityManager->persist($compte);
             //var_dump($Compte);die;
             $entityManager->flush();

             //pour le depot

             $depot->setDateDepot($dateCreation);
             $depot->setMtt($values->mtt);
             $depot->setUserDepot($userCreateur);
             $depot->setNumCompte($compte);

             $entityManager->persist($depot);
             $entityManager->flush(); 


          // mis a joure le solde du compte partenaire 
              $NewSolde = ($values->mtt+$compte->getSolde());
              $compte->setSolde($NewSolde);

              $entityManager->persist($compte);
              $contrat=new Contrat();
              $contrat->setPartenaire($compte->getPartenaires());
              $contrat->setInformation("lorem ipsum ,");
              $entityManager->persist($contrat);
              $entityManager->flush();
              $contra=[
                "Ninea Partenaire"=>$compte->getPartenaires()->getNinea(),
                "Datecreat"=>$compte->getDatecreat()->format('Y-m-d'),
                "Information"=>$contrat->getInformation()

              ];
              return new JsonResponse($contra);
              
                    $data = [
                    'status' => 500,
                    'message' => 'Vous devez renseigner un login et un passwordet un ninea pour le partenaire, 
                    le numero de compte ainsi que le montant a deposer'
                    ];
                    return new JsonResponse($data, 500);

                      
                }
           }
           /**
     * @Route("/compteExistent", name="creation_compte_PartenaireExistent", methods={"POST"})
     */
    public function creation_compte_PartenaireExistent(Request $request, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->ninea))
    {

            $ReposPropcompte = $this->getDoctrine()->getRepository(Partenaire::class);
                // recuperer le proprietaire du compte
                $propcompte = $ReposPropcompte->findOneByNinea($values->ninea);
            if ($propcompte) 
            {
                    //les class 
                    $dateJours = new \DateTime();
                    $depot = new Depot();
                    $compte = new Compte();

                    //pour le compte 
                
                    // recuperer de l'utilisateur qui cree le compte et fair un depot initial
                $userCreateur = $this->tokenStorage->getToken()->getUser();

                //generation du comptes
                $annee = Date('y');
                $nb = $this->getLastCompte();
                $long = strlen($nb);
                $nin = substr($propcompte->getNinea() , -2);
                $NumCompte = str_pad("NG".$annee.$nin, 11-$long, "0").$nb;
                
                $compte->setNumCompte($NumCompte);
                $compte->setSolde(0);
                $compte->setDatecreat($dateJours);
                $compte->setUserCreat($userCreateur);
                $compte->setPartenaires($propcompte);

                    $entityManager->persist($compte);
                    $entityManager->flush();

                    //depot

                    $ReposCompte = $this->getDoctrine()->getRepository(Compte::class);
                    $compteDepose = $ReposCompte->findOneByNumCompte($NumCompte);
                    $depot->setDateDepot($dateJours);
                    $depot->setMtt($values->mtt);
                    $depot->setUserDepot($userCreateur);
                    $depot->setNumCompte($compteDepose);
                    

                $entityManager->persist($depot);
                    $entityManager->flush();

                    // mis a joure le solde du compte partenaire 
                    $NewSolde = ($values->mtt+$compte->getSolde());
                        $compte->setSolde($NewSolde);

                        $entityManager->persist($compte);
                         $entityManager->flush();
                            $data = [
                                'status' => 201,
                                        'message' => 'Le compte du partenaire est bien cree avec un depot initia de: '.$values->mtt
                                        ];
                                    return new JsonResponse($data, 201);
                
                $data = [
                    'status' => 500,
                    'message' => 'Veuillez saisir un montant de depot valide'
                    ];
                    return new JsonResponse($data, 500);
            }
            $data = [
                'status' => 500,
                'message' => 'Desole le NINEA n existe psa' 
                ];
                return new JsonResponse($data, 500);
        }
        $data = [
        'status' => 500,
        'message' => 'Vous devez renseigner le ninea du partenaire, le numero de compte ainsi que le montant a deposer'
            ];
            return new JsonResponse($data, 500);
    }    

    public function getLastCompte(){
        $ripo = $this->getDoctrine()->getRepository(Compte::class);
        $compte = $ripo->findBy([], ['id'=>'DESC']);
        if(!$compte){
            $c = 1;
        }else{
            $c= ($compte[0]->getId()+1);
        }
        return $c;
    }

            //faire depot
                                    /**
                                     * @Route("/fairedepot", name="fairre depot", methods={"POST"})
                                    */

                                    public function faireDepot(Request $request, EntityManagerInterface $entityManager)
                                    {   
                                      $userCreateur = $this->tokenStorage->getToken()->getUser();
                      
                                      $values = json_decode($request->getContent());
                      
                                           if($values->mtt>0){
                                               //les class 
                                      $dateJours = new \DateTime();
                                      $depot = new Depot();
                      
                                                          $ReposCompte = $this->getDoctrine()->getRepository(Compte::class);
                                                          $compteDepose = $ReposCompte->findOneById($values->id);
                                                          $depot->setDateDepot($dateJours);
                                                          $depot->setMtt($values->mtt);
                                                          $depot->setUserDepot($userCreateur);
                                                          $depot->setNumCompte($compteDepose);
                                                          
                                                          $entityManager->persist($depot);
                                                          $entityManager->flush();
                      
                                              // mis a joure le solde du compte partenaire 
                                                  $NewSolde = ($values->mtt+$compteDepose->getSolde());
                                                  $compteDepose->setSolde($NewSolde);
                      
                                                  $entityManager->persist($compteDepose);
                                                  $entityManager->flush();
                                                  
                                                  $data = [
                                                      'status' => 201,
                                                          'message' => 'Merci vous avez faire  un depot de:'.$values->mtt
                                                          ];
                                                          return new JsonResponse($data, 201);
                                                          }
                      
                                                          $data = [
                                                          'status' => 500,
                                                          'message' => 'Vous devez renseigner un login et un passwordet un ninea pour le partenaire, le numero de compte ainsi que le montant a deposer'
                                                          ];
                                                          return new JsonResponse($data, 500);
                                              }

           //ferimture

        }  
   
    