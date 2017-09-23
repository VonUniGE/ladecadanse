<?php

namespace Ladecadanse\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizerType extends AbstractType
{

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {  
        // contenu : tout le monde (à partir de ROLE_ACTOR manager)
        $builder 
        ->add('nom', TextType::class, array('required' => true, 'label' => 'Nom'))
        ->add('URL', TextType::class, array('required' => false, 'label' => 'Site web'))
        ->add('presentation', TextareaType::class, array('required' => false, 'label' => 'Présentation'));               
        
        if (in_array('ROLE_ADMIN', $options['user_roles']) && $options['user_roles']['ROLE_ADMIN'])
        {       
            $builder->add('status', ChoiceType::class, array('required' => true, 'label' => 'Status', 'choices' => array('actif' => 'actif', 'inactif' => 'inactif', 'ancien' => 'ancien'), 'expanded' => true));         
        }
    
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ladecadanse\Entity\Organizer',
            'user_roles' => ['ROLE_USER' => true]
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ladecadanse_organizer_form';
    }
}
