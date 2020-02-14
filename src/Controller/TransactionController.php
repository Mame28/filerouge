<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Entity\Tarifs;
use App\Entity\TaxeEtats;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/** 
* @Route("/api")
*/
class TransactionController extends AbstractController
{
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
    $this->tokenStorage = $tokenStorage;
    }

    /**
    * @Route("/transaction", name="transaction",methods={"POST"})
    */

    public function faire_transaction(Request $request, EntityManagerInterface $EntityManagerInterface , SerializerInterface $serializer,ValidatorInterface $validator)
    {

    $values = json_decode($request->getContent());

                $frai = $this->getDoctrine()->getRepository(Tarifs::class);
                $all = $frai->findAll()[0];
                $repository =$this->getDoctrine()->getRepository(TaxeEtats::class);
                $recup= $repository->findAll()[0];

                //recuperation des taux

                $f = $this->frais($values->montant);
                $taxeEtat =$f*$recup->getTaxeEtat();
                $taxeSys =$f*$recup->getTaxeSys();
                $taxeEmet =$f*$recup->getTaxeEmet();
                $taxeRecep =$f*$recup->getTaxeRecep();

                $userconnct= $this->tokenStorage->getToken()->getUser();
                $compte =$this->getDoctrine()->getRepository(Compte::class);

                if(!isset($values->prenom,$values->nom,$values->montant))
                {
                    //les affectation 
                $date = new \DateTime();
                $transfert = new Transaction();
                //recuperation du compte coserner pour l'envoi
                $RecupCompte = $this->getDoctrine()->getRepository(Compte::class);
                $compte = $RecupCompte->findOneById($values->id);

                $codeEnvoi = $this->nbAleatoire(9);

                $transfert->setUser($userconnct);
                $transfert->setCompte($compte);
                $transfert->setPrenomE($values->prenomE);
                $transfert->setNomE($values->nomE);
                $transfert->setTypePieceEnvoi($values->typePieceEnvoi);
                $transfert->setNumpieceEmetteur($values->numpieceEmetteur);
                $transfert->setPrenomR($values->prenomR);
                $transfert->setNomR($values->nomR);
                $transfert->setMontant($values->montant);
                $transfert->setFrais($f);
                $transfert->setTelRecepteur($values->telRecepteur);
                $transfert->setDateEnvoi($date);
                $transfert->setCommisionEmetteur($taxeEmet);
                $transfert->setCommissionRecepteur($taxeRecep);
                $transfert->setCommissionEtat($taxeEtat);
                $transfert->setCommissionSysteme($taxeSys);
                $transfert->setCode($codeEnvoi);
                $errors = $validator->validate($transfert);
                if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                'Content-Type' => 'application/json'
                ]);
                }
                $EntityManagerInterface->persist($transfert);
                $EntityManagerInterface->flush();


                // mis a joure le solde du compte partenaire 
                
                $NewSolde = ($compte->getSolde()-$values->montant);
                $compte->setSolde($NewSolde);

                $EntityManagerInterface->persist($compte);
                $EntityManagerInterface->flush();

                $data = [
                'status' => 201,
                'message' => 'vous avez faire un transfert :'.$values->montant.'dont le code est'.$codeEnvoi
                ];
                return new JsonResponse($data, 201);

                }
                $data = [
                'status' => 500,
                'message' => ' transfert invalide:'
                ];

                return new JsonResponse($data, 500);
                }
                ####### IMPLEMENTATION DU GENERATEUR DU CODE D'ENVOIE ######
                public function nbAleatoire($length)
                {
                $tab_match = [];
                while (count($tab_match) < $length) {
                preg_match_all('#\d#', hash("sha512", openssl_random_pseudo_bytes("128", $cstrong)), $matches);
                $tab_match = array_merge($tab_match, $matches[0]);
                }
                shuffle($tab_match);
                return implode('', array_slice($tab_match, 0, $length));

                }
               
                public function frais($montant)
                {
                $frai = $this->getDoctrine()->getRepository(Tarifs::class);
                $all = $frai->findAll();
                foreach($all as $val)
                {
                if($val->getBorneInf() <= $montant && $val->getBorneSup()>= $montant)
                {
                return $val->getValeur(); 
                }
                }

                }
                //Retrait
/**
* @Route("/retrait", name="faire retrait",methods={"POST"})
*/

                    public function retrait(Request $request, EntityManagerInterface $entityManager)
                    {
                        $values = json_decode($request->getContent());
                        if(!isset($code)){
                            
                    
                                    //les class 
                                    $dateJours = new \DateTime();
                                    $transfert = new Transaction();
                                 //recuperation du compte coserner pour l'envoi
                                 $RecupCompte = $this->getDoctrine()->getRepository(Compte::class);
                                 $compte = $RecupCompte->findOneBy($values->Id);
                                $codeEnvoi = $this->nbAleatoire(9);
                                $transfert->setUser($userconnct);
                                $transfert->setCompte($compte);
                                $transfert->setNumPieceRecepteur($values->numPieceRecepteur);
                                $transfert->setCode($codeEnvoi);
                                $transfert->setFrais($f);
                                $transfert->setDateEnvoi($date);
                                $transfert->setCommisionEmetteur($taxeEmet);
                                $transfert->setCommissionRecepteur($taxeRecep);
                                $transfert->setCommissionEtat($taxeEtat);
                                $transfert->setCommissionSysteme($taxeSys);
                                $transfert->setCode($codeEnvoi);
                                
                                $errors = $validator->validate($transfert);
                                if(count($errors)) {
                                $errors = $serializer->serialize($errors, 'json');
                                return new Response($errors, 500, [
                                'Content-Type' => 'application/json'
                                ]);
                                }
                                $EntityManagerInterface->persist($transfert);
                                $EntityManagerInterface->flush();


                                // mis a joure le solde du compte partenaire 
                                
                                $NewSolde = ($compte->getSolde()+$values->montant);
                                $compte->setSolde($NewSolde);

                                $EntityManagerInterface->persist($compte);
                                $EntityManagerInterface->flush();

                                $data = [
                                'status' => 201,
                                'message' => 'vous avez faire un retrait de  :'.$values->montant.'dont le code est'.$codeEnvoi
                                ];
                                return new JsonResponse($data, 201);

                                }
                                $data = [
                                'status' => 500,
                                'message' => ' retait invalide  invalide veuer revoir le code SVP:'
                                ];

                                return new JsonResponse($data, 500);
                                
    
                        }

                    


//femiture
}

