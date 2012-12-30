<?php

namespace VMelnik\SecureFormBundle\Form\Event;

use Symfony\Component\Form\Event\FilterDataEvent;

/**
 * Secure form listener, which protects forms on server side
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class SecureFormListener
{
    /**
     * Ignore fields array
     * 
     * @var array
     */
    protected $ignoreFields;

    /**
     * Initialization
     * 
     * @param array $ignoreFields
     */
    public function __construct(array $ignoreFields = array())
    {
        $this->ignoreFields = $ignoreFields;
    }

    /**
     * Ensure that tags removed from fields
     * 
     * @param \Symfony\Component\Form\Event\FilterDataEvent $event
     */
    public function ensureTagsRemoved(FilterDataEvent $event)
    {
        $data = $event->getData();

        if (is_array($data)) {
            foreach ($data as $k => $v) {
                if (!in_array($k, $this->ignoreFields)) {
                    $data[$k] = $this->getClear($v);
                }
            }
            $event->setData($data);
        }
    }

    /**
     * Get filtered data
     * 
     * @param string|array $data
     * 
     * @return mixed
     */
    public function getClear($data)
    {
        if (is_string($data) && $data) {
            $data = strip_tags($data);
        } else if (is_array($data) && !empty($data)) {
            foreach ($data as $k => $v) {
                $data[$k] = $this->getClear($v);
            }
        }

        return $data;
    }

}