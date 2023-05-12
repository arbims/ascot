<?php

namespace App\UserBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class JoueurType extends AbstractType {

    public $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('nomPrenom')
                ->add('sexe', 'choice', array('choices' => array('M' => 'Masculin', 'F' => 'Feminin')))
                ->add('tel')
                ->add('pays','choice', array('choices'=>$this->getPays()))
                ->add('ville','choice',array('mapped'=>false))
                ->add('adresse', 'text')
                ->add('equipe', 'entity', array(
                    'class' => 'App\AdminBundle\Entity\Equipe',
                    'choice_label' => 'libelle'
                ))
                ->add('capitaine')
                ->add('file2','file', array('mapped'=>false))
                ->add('societe')
                ->add('fonction')
                ->add('membre','choice', array('choices'=>$this->getmembre()))

        ;
    }

    public function getmembre(){
        $data = [];
        $data = array('Founder Members'=>'Founder Members',
                        'Venerable Members'=>'Venerable Members',
                        'Honourable Members'=>'Honourable Members',
                        'Ordinary Members'=>'Ordinary Members',
                        'Ladies Members'=>'Ladies Members',
                        ' Guest Members'=>' Guest Members');
        return $data;
    }

    public function getPays() {
        $query = $this->em->getRepository('AppAdminBundle:Pays')->findAll();
        $data = [];
        $data[0] = "";
        foreach ($query as $k => $v) {
            $data[$k + 1] = $v->getNamePays();
        }
        return $data;
    }

    public function getVille() {
        $query = $this->em->getRepository('AppAdminBundle:Ville')->findAll();
        $data = [];
        $data[0] = "";

        return $data;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\UserBundle\Entity\Joueur'
        ));
    }

}
