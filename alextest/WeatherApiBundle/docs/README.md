To install module just add AlexTest/Weather in src/ folder and clear cache

You may also need to change routes.yaml of the project to this (for inner controller validation)

controllers:
    resource:
        path: ../src
        namespace: App
    type: attribute

You can also use my api key for testing ( add it to .env file)

API_WEATHER_KEY=025033fc5cd6446fb6f154619250104

For running tests 
php bin/phpunit src/bundles/alextest/WeatherApiBundle/Tests/WeatherServiceTest.php

You may need symfony/monolog-bundle and twig bundle composer packages( if not installed already)