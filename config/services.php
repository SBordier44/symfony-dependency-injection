<?php

declare(strict_types=1);

use App\Controller\OrderController;
use App\Database\Database;
use App\HasLoggerInterface;
use App\Logger;
use App\Mailer\GmailMailer;
use App\Mailer\MailerInterface;
use App\Mailer\SmtpMailer;
use App\Texter\FaxTexter;
use App\Texter\SmsTexter;
use App\Texter\TexterInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator) {
    $parameters = $configurator->parameters();
    $parameters
        ->set('mailer.gmail_user', 'magali@gmail.com')
        ->set('mailer.gmail_password', 'toto');

    $services = $configurator->services();
    $services->defaults()->autowire(true)->autoconfigure(true);
    $services->instanceof(HasLoggerInterface::class)->tag('with_logger');

    $services
        ->set('order_controller', OrderController::class)
        ->public();

    $services
        ->set('database', Database::class);

    $services
        ->set('logger', Logger::class);

    $services
        ->set('texter.sms', SmsTexter::class)
        ->args(['service.sms.com', 'apiKey123']);

    $services
        ->set('mailer.gmail', GmailMailer::class)
        ->args(['%mailer.gmail_user%', '%mailer.gmail_password%']);

    $services
        ->set('mailer.smtp', SmtpMailer::class)
        ->args(['smtp://localhost', 'user', 'password']);

    $services
        ->set('texter.fax', FaxTexter::class);

    $services
        ->alias(OrderController::class, 'order_controller')->public()
        ->alias(Database::class, 'database')
        ->alias(GmailMailer::class, 'mailer.gmail')
        ->alias(SmtpMailer::class, 'mailer.smtp')
        ->alias(SmsTexter::class, 'texter.sms')
        ->alias(FaxTexter::class, 'texter.fax')
        ->alias(Logger::class, 'logger')
        ->alias(MailerInterface::class, 'mailer.gmail')
        ->alias(TexterInterface::class, 'texter.sms');
};
