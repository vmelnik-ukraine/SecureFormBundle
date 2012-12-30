<?php

namespace VMelnik\SecureFormBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VMelnikSecureFormBundle extends Bundle
{
    
    public function getContainerExtension()
    {
        return new VMelnikSecureFormExtension();
    }
    
}
