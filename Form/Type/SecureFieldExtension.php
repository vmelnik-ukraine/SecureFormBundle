<?php

namespace VMelnik\SecureFormBundle\Form\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use VMelnik\SecureFormBundle\Config\ExtensionConfig;
use Symfony\Component\Form\FormBuilder;

/**
 * Secure form field level type extension
 * 
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class SecureFieldExtension extends AbstractTypeExtension
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
     * Adds client side validation
     *
     * @param FormBuilder $builder The form builder
     * @param array       $options The options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        // globally disabled
        if (!$options[$this->config->getEnabledOptionName()]) {
            return;
        }

        // FIXME: now csv ignores IGNORE option. need deep research
        if ($options[$this->config->getCsvOptionName()]) {
            $this->addCSValidation($builder);
        }
    }

    /**
     * Adds specific class for future validation on client side (js for example)
     * 
     * @param \Symfony\Component\Form\FormBuilder $builder
     */
    protected function addCSValidation(FormBuilder $builder)
    {
        $attrs = $builder->getAttribute('attr');
        if (empty($attrs['class'])) {
            $attrs['class'] = $this->config->getCsvClass();
        } else {
            if (!preg_match('/' . $this->config->getCsvClass() . '/', $attrs['class'])) {
                $attrs['class'] = $attrs['class'] . ' ' . $this->config->getCsvClass();
            }
        }

        $builder->setAttribute('attr', $attrs);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            $this->config->getEnabledOptionName() => $this->config->isEnabled(),
            $this->config->getCsvOptionName() => $this->config->isCsvEnabled(),
            $this->config->getIgnoreFieldsOptionName() => array(),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        // for field level
        return 'field';
    }

}