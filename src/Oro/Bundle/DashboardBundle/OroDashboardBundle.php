<?php

namespace Oro\Bundle\DashboardBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Oro\Bundle\DashboardBundle\DependencyInjection\Compiler\ValueConvertersPass;

class OroDashboardBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ValueConvertersPass());
    }
}
