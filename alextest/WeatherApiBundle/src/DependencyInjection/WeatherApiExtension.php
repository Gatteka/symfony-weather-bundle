<?php

namespace AlexTest\WeatherApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


class WeatherApiExtension extends Extension
{
    /** @return void */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(\dirname(__DIR__).'/../config')
        );
    
        $loader->load("services.yaml");
       // $loader->load("routes/annotations.yaml");
      //  $loader->load("routes.yaml");


    }
}
