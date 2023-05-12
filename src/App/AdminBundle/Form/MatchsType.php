<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class MatchsType extends AbstractType
{

    public  $em ;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('num')
            ->add('court')
            ->add('poule','choice',array('choices'=>$this->getpoule()))
        ;        
    }
      public function getpoule(){
        $data = array();
        $query = $em->getRepository('AppAdminBundle:Poule')
                ->createQueryBuilder('p')
                ->getQuery()->getArrayResult();
        foreach($query as $k=>$v){
            $data[$v['libelle']] = $v['id'];
        }
        return $data;
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\AdminBundle\Entity\Matchs'
        ));
    }
}
