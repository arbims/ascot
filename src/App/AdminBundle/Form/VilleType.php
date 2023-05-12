<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    public $em;
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('pays_id','choice' , array('choices' => $this->getpays()));
        ;
    }
    
    public function getpays()
    {
        $query = $this->em->getRepository('AppAdminBundle:Pays')
                ->createQueryBuilder('p')
                ->getQuery()->getArrayResult();
        $data = [];
        foreach ($query as $k=>$v)
        {
            $data[$v['id']] = $v['namePays'];
        }
        
        return $data;
    }

        /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\AdminBundle\Entity\Ville'
        ));
    }
}
