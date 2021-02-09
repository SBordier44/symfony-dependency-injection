<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use App\Logger;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class LoggerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $serviceIds = $container->findTaggedServiceIds('with_logger');

        foreach ($serviceIds as $id => $data) {
            $definition = $container->getDefinition($id);
            $definition->addMethodCall('setLogger', [new Reference(Logger::class)]);
        }
    }
}
