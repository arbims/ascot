<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PouleType extends AbstractType
{

    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['action'];
        $builder
            ->add('libelle')
            ->add('equipelist' ,'choice',
                array (
                    'choices' => $this->getequipe(),
                    'multiple'=>true,
                    'mapped'=>false
                )
            )
            ->add('numberequipe')
            ->add('tournoi', 'entity', array('empty_value' => '', 'class' => 'App\AdminBundle\Entity\Tournoi', 'empty_value' => 'choisissez le tournoi', 'property' => 'titre', 'required' => true));
    }

    public function getequipe()
    {
        $data = array();
        $qb = $this->em->getRepository('AppAdminBundle:Poule')
            ->createQueryBuilder('p')
            ->select('e.id')
            ->leftJoin('p.equipe', 'e')
            ->getQuery()->getDQL();

        $res = $this->em
            ->getRepository('AppAdminBundle:Equipe')
            ->createQueryBuilder('ef');
        $result = $res->where($res->expr()->notIn('ef.id', $qb))
            // ->where($res->expr()->notIn($this->$qb))
            ->getQuery()->getArrayResult();

        foreach ($result as $k => $v) {
            $data[$v['id']] = $v['libelle'];
        }
        return $data;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\AdminBundle\Entity\Poule'
        ));
    }

}
