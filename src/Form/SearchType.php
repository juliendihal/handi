<?php
namespace App\Form;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends  AbstractController {

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder

            ->add('sport' , 'choice', array('choices'=>array('Footbal' , 'Basket' , 'Tennis')))
            ->add('hobbie', 'choice', array('choices'=>array('Jeux video', 'Dessin')))
            ->add('ville', 'text')
            ->add('matiere', 'choice', array('choices'=>array('Science' , 'Devellopement web')))

    }
    public function getName(){
        return
    }
}