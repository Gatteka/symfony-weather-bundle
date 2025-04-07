<?php
namespace AlexTest\WeatherApiBundle\Controller;

use AlexTest\WeatherApiBundle\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Index extends AbstractController
{

    public function __construct(
        private WeatherService $weatherService
        )
    {}

    #[Route('/weather_data/{city}', name: 'get_weather_data', methods:'GET')]
    public function getWeather(string $city): Response|JsonResponse
    {
        $weatherData = $this->weatherService->getWeatherData($city);

        if (isset($weatherData['error'])) {
            return new JsonResponse(['error' => $weatherData['error']], 400);
        }

        return $this->render('@WeatherApi/index.html.twig', [
            'weatherData' => $weatherData
        ]);
    }
}

