<?php

declare(strict_types=1);

use App\Controller\OrderController;
use App\DependencyInjection\LoggerCompilerPass;
use App\HasLoggerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerCacheFile = __DIR__ . '/config/cache/container.php';

$start = microtime(true);
require __DIR__ . '/vendor/autoload.php';

if (file_exists($containerCacheFile)) {
    require $containerCacheFile;
    $container = new ProjectServiceContainer();
} else {
    $container = new ContainerBuilder();

    $container->registerForAutoconfiguration(HasLoggerInterface::class)->addTag('with_logger');

    //$loader = new PhpFileLoader($container, new FileLocator([__DIR__ . '/config']));
    //$loader->load('services.php');

    $loader = new YamlFileLoader($container, new FileLocator([__DIR__ . '/config']));
    $loader->load('services.yaml');

    $container->addCompilerPass(new LoggerCompilerPass());
    $container->compile();

    $dumper = new PhpDumper($container);
    if (!file_exists(__DIR__ . '/config/cache')) {
        if (!mkdir($concurrentDirectory = __DIR__ . '/config/cache') && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
    }
    file_put_contents($containerCacheFile, $dumper->dump());
}

$controller = $container->get(OrderController::class);

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'POST') {
    $controller->placeOrder();

    $duration = microtime(true) - $start;
    var_dump('Durée de chargement du container : ' . $duration * 1000);

    return;
}

include __DIR__ . '/views/form.html.php';
