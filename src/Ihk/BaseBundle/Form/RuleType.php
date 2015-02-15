<?php

namespace Ihk\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RuleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('dayInWeek')
            ->add('starttime')
            ->add('endtime')
            ->add('address')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ihk\BaseBundle\Entity\Rule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ihk_basebundle_rule';
    }
}
