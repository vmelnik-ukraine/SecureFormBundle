<?php

namespace VMelnik\SecureFormBundle\Config;

/**
 * Config for secure form type extension
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class ExtensionConfig
{

    /**
     * Is extension enabled flag
     * 
     * @var boolean 
     */
    protected $enabled;
    
    /**
     * Option name to enable/disable extension in forms
     * 
     * @var string 
     */
    protected $enabledOptionName;
    
    /**
     * Is client side validation enabled
     * 
     * @var boolean
     */
    protected $csv;
    
    /**
     * Client side validation class name
     * 
     * @var string 
     */
    protected $csvClass;
    
    /**
     * Client side validation option name to enable/disable this type of validation
     * 
     * @var string
     */
    protected $csvOptionName;
    
    /**
     * Server side filtering with stip tags flag
     * 
     * @var boolean
     */
    protected $ssvStripTags;
    
    /**
     * Strip tags option name to enable/disable this type of filtering
     * 
     * @var string
     */
    protected $ssvStripTagsOptionName;
    
    /**
     * Ignore fields option name
     * 
     * @var string
     */
    protected $ignoreFieldsOptionName;

    /**
     * Initialization of config object
     * 
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->enabled = $config['enabled'];
        $this->enabledOptionName = $config['enabled_option_name'];
        $this->csv = $config['csv']['enabled'];
        $this->csvClass = $config['csv']['class'];
        $this->csvOptionName = $config['csv']['option_name'];
        $this->ssvStripTags = $config['ssv']['strip_tags']['enabled'];
        $this->ssvStripTagsOptionName = $config['ssv']['strip_tags']['option_name'];
        $this->ignoreFieldsOptionName = $config['ignore_fields_option_name'];
    }

    /**
     * Is validation enabled
     * 
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get validation enabled option name
     * 
     * @return string
     */
    public function getEnabledOptionName()
    {
        return $this->enabledOptionName;
    }

    /**
     * Is client side validation enabled
     * 
     * @return boolean
     */
    public function isCsvEnabled()
    {
        return $this->csv;
    }

    /**
     * Get client side validation class name
     * 
     * @return string
     */
    public function getCsvClass()
    {
        return $this->csvClass;
    }

    /**
     * Get client side validation option name
     * 
     * @return string
     */
    public function getCsvOptionName()
    {
        return $this->csvOptionName;
    }

    /**
     * Is server side strip tags filtering enabled
     * 
     * @return boolean
     */
    public function isSsvStripTagsEnabled()
    {
        return $this->ssvStripTags;
    }

    /**
     * Get server side strip tags option name
     * 
     * @return string
     */
    public function getSsvStripTagsOptionName()
    {
        return $this->ssvStripTagsOptionName;
    }

    /**
     * Get ignore fields option name
     * 
     * @return string
     */
    public function getIgnoreFieldsOptionName()
    {
        return $this->ignoreFieldsOptionName;
    }

}