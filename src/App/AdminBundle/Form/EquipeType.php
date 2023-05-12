<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends AbstractType
{
    public $em;
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('nbrjoueur')
            ->add('adresse')
            ->add('pays','choice',array('choices'=>  $this->getPays()))
            ->add('ville','choice',array('choices'=>  $this->getVille(),'mapped'=>false))
            ->add('website')
            ->add('mail')
            ->add('tel')
            ->add('file', 'file', array('mapped' => false, 'required' => false))
            ->add('file2', 'file', array('mapped' => false, 'required' => false))
        ;
    }
    
    public function getPays()
    {
        $query = $this->em->getRepository('AppAdminBundle:Pays')->findAll();
        $data= [];
        $data[0] ="";
        foreach ($query as $k=>$v)
        {
            $data[$k+1] = $v->getNamePays();
        }
        return $data;
    }
    
     public function getVille()
    {
        $query = $this->em->getRepository('AppAdminBundle:Ville')->findAll();
        $data= [];
        $data[0]= "";
       
        return $data;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\AdminBundle\Entity\Equipe'
        ));
    }
}
