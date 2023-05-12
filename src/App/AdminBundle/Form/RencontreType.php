<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RencontreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('journee')
            ->add('court')
            ->add('date')
            ->add('doublet1','entity', array(
                'class' => 'App\AdminBundle\Entity\Doublet' ,
                'choice_label' => 'libelle'
            ))
            ->add('doublet2','entity', array(
                'class' => 'App\AdminBundle\Entity\Doublet' ,
                'choice_label' => 'libelle'
            ))
            ->add('matchs','entity', array(
                'class' => 'App\AdminBundle\Entity\Matchs' ,
                'choice_label' => 'id'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\AdminBundle\Entity\Rencontre'
        ));
    }
}
