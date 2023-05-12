<?php

namespace App\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    
    public $request;
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $factory = $builder->getFormFactory();
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function($event) use
        ($factory) {
            $form = $event->getForm();
            $data = $event->getData();
            if($this->request->attributes->get('_route') == 'app_user_profile')
            {
                $form
                    ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                    ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                    ->add('file','file',array('required'=>false, 'data_class' => null,'mapped'=>false,'multiple'=>'multiple','hidden'=>true))
                    ->add('nom', 'text' , array('mapped'=>false))
                    ->add('prenom','text' , array('mapped'=>false))
                    ->add('numtel','text', array('mapped'=>false));
            }else{
                $form
                    ->add('type','choice', array('choices'=>array('0'=>'','1'=>'Compte Admin','2'=>'Compte User')))
                    ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                    ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                    ->add('plainPassword', 'repeated', array(
                        'type' => 'password',
                        'options' => array('translation_domain' => 'FOSUserBundle'),
                        'first_options' => array('label' => 'form.password'),
                        'second_options' => array('label' => 'form.password_confirmation'),
                        'invalid_message' => 'fos_user.password.mismatch',
                        'required' => false
                    ))
                    ->add('roles', 'choice', array(
                        'choices' => array('ROLE_SUPER_ADMIN'=>'role_super_admin','ROLE_ADMIN' => 'admin','ROLE_USER'=>'user'),
                        'multiple'=>true
                    ))
                    ->add('enabled','checkbox',array('required'=>false))
                    ->add('file','file',array('required'=>false, 'data_class' => null,'mapped'=>false,'multiple'=>'multiple'))
                    ->add('nom', 'text' , array('mapped'=>false))
                    ->add('prenom','text' , array('mapped'=>false))
                    ->add('numtel','text', array('mapped'=>false))
                    ->add('adressefb','text' , array('mapped'=>false))
            ;
            }

        });
    }
 
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\UserBundle\Entity\User'
        ));
    }
}
