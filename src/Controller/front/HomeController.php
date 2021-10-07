<?php

namespace App\Controller\front;

use App\Form\InteretType;
use App\Repository\CoursRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @Route("/" , name="home")
     */
    public function home(){
        return $this->render('front/home.html.twig');
    }

    /**
     * @Route("/calendar" , name="calendar")
     */
    public function calendar(CoursRepository $coursRepository){
        $events = $coursRepository->findall();
        $rdvs = [];

        foreach($events as $event){
         $rdvs[] =[
             'id'=> $event->getId(),
             'start'=> $event->getStart()->format('Y-m-d H:i'),
             'end'=> $event->getEnd()->format('Y-m-d H:i'),
             'title'=> $event->getLibelle(),
             'description'=> $event->getDescription(),
         ];
        }
        $data = json_encode($rdvs);

        return $this->render('front/calendar.html.twig', compact('data'));

    }

    /**
     * @Route("/calendar/id/{id}" , name="calendar_id")
     */
    public function calendarId($id,CoursRepository $coursRepository){

      $cour = $coursRepository->find($id);

      return $this->render('front/calendarId.html.twig',[
          'cour'=> $cour
      ]);

    }

    /**
     * @Route("/rechercheAsh" , name="recherche_ash")
     */
    public function rechercheAsh(Request $request, UserRepository $userRepository){
        $searchAeshForm = $this->createForm(InteretType::class);
        if ($searchAeshForm->isSubmitted() && $searchAeshForm->isValid()){
            $criteria = $searchAeshForm->getData();
            dump($criteria);die;
            $user = $userRepository->searchAesh($criteria);
        }

     return $this->render('front/searchAesh.html.twig',[
     'searchForm'=> $searchAeshForm->createView()
     ]);

    }



}