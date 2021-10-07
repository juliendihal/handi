<?php

namespace App\Controller\admin;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController {

        /**
        * @Route("/cours/add" , name="cours_add")
        */
    public function addCours( Request $request , EntityManagerInterface $entityManager, FileUploader $fileUploader)
    {
        //Création d une variable qui instancie l entité galerie
        //pour créer une nouvel galerie dans la bdd (et un nouvel enregistrement dans la table visée)
        $Cours = new Cours();

        //Récupération du gabarit formulaire pour le stocker dans une variable
        //en parametre : instanciation du gabarit et nom de l entité visée ou de celle à créer
        $CoursForm = $this->createForm(CoursType::class, $Cours);

        //mise en relation du formulaire avec les données envoyées en Post
        $CoursForm->handleRequest($request);

        //si le formulaire a ete poster et il est valide alors on enregistre l'article
        if ($CoursForm->isSubmitted() && $CoursForm->isValid()) {

            // Recupération de l image téléchargée avec la methode get
            $brochureFile = $CoursForm->get('fichier')->getData();

            //mise en place d une condition
            // pour définir le comportement en cas d upload de fichier
            if ($brochureFile) {

                $brochureFileName = $fileUploader->upload($brochureFile);

                //avec la methode setter: ajout de l image dans l entity article
                $Cours->setFichier($brochureFileName);
            }

            $entityManager->persist($Cours);
            $entityManager->flush();

            //si ok on renvoi sur la page galerie
            return $this->redirectToRoute('home');

        }

        //renvoi du formulaire sur une page vue si le formulaire n est pas validé
        return $this->render('admin/coursForm.html.twig', [
            'CoursForm' => $CoursForm->createView()
        ]);

    }

    /**
     *
     * @Route("/cours/update/{id}" , name="cours_update")
     */
    public function galerieUpdate($id,CoursRepository $coursRepository, request $request , EntityManagerInterface $entityManager , FileUploader $fileUploader ){

        //recupération de la galerie à modifier en fonction de son id defini dans la wildcard
        $cours = $coursRepository->find($id);

        //Récupération du gabarit formulaire pour le stocker dans une variable
        //en parametre : instanciation du gabarit et nom de l entité visée ou de celle à créer
        $CoursForm = $this->createForm(CoursType::class, $cours);

        //mise en relation du formulaire avec les données envoyées en Post
        $CoursForm->handleRequest($request);


        //si le formulaire a ete poster et il est valide alors on enregistre l'article
        if($CoursForm->isSubmitted() && $CoursForm->isValid()){

            // Recupération de l image téléchargée avec la methode get
            $brochureFile = $CoursForm->get('fichier')->getData();

            //mise en place d une condition
            // pour définir le comportement en cas d upload de fichier
            if ($brochureFile) {

                $brochureFileName = $fileUploader->upload($brochureFile);

                //avec la methode setter: ajout de l image dans l entity article
                $cours->setFichier($brochureFileName);
            }

            $entityManager->persist($cours);
            $entityManager->flush();

            //si ok on renvoi sur la page galerie
            return $this->redirectToRoute('home');
        }

        //renvoi du formulaire sur une page vue si le formulaire n est pas validé
        return $this->render('admin/coursForm.html.twig',[
            'CoursForm'=>$CoursForm->createView()
        ]);

    }

    /**
     *
     * @Route("/cours/delete/{id}" , name="cours_delete")
     */
    public function galerieDelete($id, CoursRepository $coursRepository , EntityManagerInterface $entityManager){

        //recupération une gallerie à modifier en fonction de son id defini dans la wildcard
        $cours = $coursRepository->find($id);

        //mise en place des managers de gestion des entités
        //pour supprimer l element selectionné avec son id
        $entityManager->remove($cours);
        $entityManager->flush();

        //si ok on renvoi sur la page galerie
        return $this->redirectToRoute('home');

    }



}