<?php

namespace VMelnik\SecureFormBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use VMelnik\SecureFormBundle\DependencyInjection\VMelnikSecureFormExtension;

class VMelnikSecureFormBundle extends Bundle
{
    
    public function getContainerExtension()
    {
        return new VMelnikSecureFormExtension();
    }
    
}
