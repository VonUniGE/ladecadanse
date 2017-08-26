<?php

namespace LaDecadanse\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class EventType extends AbstractType
{
    /**

    protected $idLieu;   // Place
    
    protected $statut;
    protected $genre;
    protected $titre;
    protected $dateEvenement;
     * 
    protected $nomLieu;
    protected $adresse;
    protected $quartier;
    protected $localite_id;
    protected $region;
    protected $urlLieu;
     * 
    protected $horaire_debut;




     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {  
        // nom : membres du staff et alternative pour tous les autres
        if (in_array('ROLE_ACTOR', $options['roles']) && $options['roles']['ROLE_ACTOR']) {
            $builder->add('statut', ChoiceType::class, array('required' => true, 'label' => 'Statut'));
        }

        // contenu : tout le monde (à partir de ROLE_ACTOR manager)
        $builder        
        ->add('category', ChoiceType::class, array('required' => true, 'label' => 'Catégorie'))
        ->add('titre', TextType::class, array('required' => true, 'label' => 'Titre'))
        ->add('dateEvenement', TextType::class, array('required' => true, 'label' => 'date'));
    
    }



    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LaDecadanse\Entity\Event',
            'roles' => ['ROLE_USER' => true]
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
