<?php

namespace VMelnik\SecureFormBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormEvents;
use VMelnik\SecureFormBundle\Form\Event\SecureFormListener;
use VMelnik\SecureFormBundle\Config\ExtensionConfig;

/**
 * Secure form type extension
 * 
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class SecureFormExtension extends AbstractTypeExtension
{

    /**
     * Configuration
     * 
     * @var \VMelnik\SecureFormBundle\Config\ExtensionConfig 
     */
    protected $config;

    /**
     * Initialization
     * 
     * @param \VMelnik\SecureFormBundle\Config\ExtensionConfig $config
     */
    public function __construct(ExtensionConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Adds secure filters to form
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array       $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // validation disabled
        if (!$options[$this->config->getEnabledOptionName()]) {
            return;
        }

        // strip tags filtering
        if ($options[$this->config->getSsvStripTagsOptionName()]) {
            $this->addStripTagsListener($builder, $options[$this->config->getIgnoreFieldsOptionName()]);
        }
    }

    /**
     * Adds listener to strip tags from form data
     * 
     * @param \Symfony\Component\Form\FormBuilder $builder
     */
    protected function addStripTagsListener(FormBuilder $builder, $ignoreFields)
    {
        $listener = new SecureFormListener($ignoreFields);
        $builder->addEventListener(FormEvents::BIND_CLIENT_DATA, array($listener, 'ensureTagsRemoved'));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            $this->config->getEnabledOptionName() => $this->config->isEnabled(),
            $this->config->getSsvStripTagsOptionName() => $this->config->isSsvStripTagsEnabled(),
            $this->config->getIgnoreFieldsOptionName() => array(),
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        // extension only for form level
        return 'form';
    }

}