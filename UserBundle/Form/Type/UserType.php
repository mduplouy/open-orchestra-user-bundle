<?php

namespace OpenOrchestra\UserBundle\Form\Type;

use OpenOrchestra\UserBundle\EventSubscriber\AddSubmitButtonSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class UserType
 */
class UserType extends AbstractType
{
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles', 'collection', array(
            'type' => 'orchestra_role_choice',
            'allow_add' => true,
            'allow_delete' => true,
            'attr' => array(
                'data-prototype-label-add' => $this->translator->trans('open_orchestra_backoffice.form.field_option.add'),
                'data-prototype-label-new' => $this->translator->trans('open_orchestra_backoffice.form.field_option.new'),
                'data-prototype-label-remove' => $this->translator->trans('open_orchestra_backoffice.form.field_option.delete'),
            )
        ));
        $builder->addEventSubscriber(new AddSubmitButtonSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OpenOrchestra\UserBundle\Document\User'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user';
    }

}
