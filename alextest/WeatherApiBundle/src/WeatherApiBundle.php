<?php
namespace AlexTest\WeatherApiBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use AlexTest\WeatherApiBundle\DependencyInjection\WeatherApiExtension;

class WeatherApiBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new WeatherApiExtension();

    }
}
