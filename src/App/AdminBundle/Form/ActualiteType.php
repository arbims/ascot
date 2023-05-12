<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActualiteType extends AbstractType {
    
    public $em;
    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('description', 'textarea', array(
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced' // Skip it if you want to use default theme
                    )
                ))
                ->add('statut')
                ->add('journee','entity', array('class'=>'App\AdminBundle\Entity\Journee','empty_value'=>'selectioner la journeé','choice_label' => 'numero'))
                ->add('date','text')
                ->add('titre')
                ->add('type', 'choice', array(
                    'choices' => array(
                        '1' => 'image',
                        '2' => 'vidéo',
                        '3' => 'Gallerie image')
                    , 'mapped' => false,
                    'expanded' => true,
                    'attr'=>array('class' => 'choixradio')))
                ->add('file','file', array('mapped'=>false,'multiple'=>'multiple'))
        ;
    }
    
    public function getjournee()
    {
        $query = $this->em->getRepository('AppAdminBundle:Journee')
                ->createQueryBuilder('j')
                ->getQuery()->getArrayResult();
        return $query;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\AdminBundle\Entity\Actualite'
        ));
    }

}
