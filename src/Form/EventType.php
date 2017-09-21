<?php

namespace Ladecadanse\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Ladecadanse\Entity\Place;

class EventType extends AbstractType
{

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {  
        
        //dump($options);
        // nom : membres du staff et alternative pour tous les autres
//        if (in_array('ROLE_ACTOR', $options['roles']) && $options['roles']['ROLE_ACTOR']) {
//            $builder->add('status', ChoiceType::class, array('required' => true, 'label' => 'Statut'));
//        }

   // places, cities, organizers arrays of objects or [id => nom] ?
//dump( $options['data']['places']);
        // contenu : tout le monde (à partir de ROLE_ACTOR manager)
        $builder        
        ->add('status', ChoiceType::class, array('required' => true, 'label' => 'Status', 'choices' => array('publie' => 'actif', 'complet' => 'complet', 'annulé' => 'annule', 'dépublié' => 'inactif'), 'expanded' => true))
        ->add('category', ChoiceType::class, array('required' => true, 'label' => 'Catégorie', 'choices' => array('Fêtes' => 'fêtes', 'Ciné' => 'ciné', 'Théâtre' => 'théâtre', 'Expos' => 'expos', 'Divers' => 'divers'), 'expanded' => true))
        ->add('dateEvenement', DateType::class, array('widget' => 'single_text', 'input' => 'string', 'required' => true, 'label' => 'Date (si cet événement se répète sur plusieurs jours, veuillez le créer ici pour la première date, puis le copier vers les autres dates)')) //  'html5' => false, 'attr' => ['class' => 'js-datepicker'], 
        ->add('place', ChoiceType::class, 
                array(
                    'choices' => 
                    $options['places'],
                    'choice_label' => function($place, $key, $index) {
                        return strtoupper($place->getNom())." ".$place->getTownName()." ".$place->getTownRegion();
                    },
                    'choice_value' => function($place) {
 
                        if (is_null($place))
                            return null;
                        else                      
                            return $place->getId();
                    },                             
                    'required' => true, 'label' => 'Lieu')
                )                
        ->add('nomLieu', TextType::class, array('required' => false, 'label' => 'Nom du lieu'))
        ->add('adresse', TextType::class, array('required' => false, 'label' => 'Rue et n°'))
        ->add('townId', ChoiceType::class, 
                array(
                    'choices' => 
                    array_flip($options['towns']),                      
                    'required' => true, 'label' => 'Localité')
                )                              
        ->add('titre', TextType::class)
        ->add('horaireDebut', TextType::class, array('label' => 'Début'))               
        ;
    
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ladecadanse\Entity\Event',
            'places' => null,
            'towns' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ladecadanse_event_form';
    }
}
