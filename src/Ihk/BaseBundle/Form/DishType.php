<?php

namespace Ihk\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DishType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('photo','text',array())//            ->add('photo','file', array('label' => 'Dish Photo', 'required' => false))
			->add('score')
            ->add('createdAt')
            ->add('kitchenId')
            ->add('tags', null, array( 'required' => false ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ihk\BaseBundle\Entity\Dish'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ihk_basebundle_dish';
    }
}
