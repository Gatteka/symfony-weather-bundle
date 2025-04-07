<?php
namespace AlexTest\WeatherApiBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;


#[Autoconfigure(bind: ['$apiKey' => '%env(API_WEATHER_KEY)%'])]
class WeatherService
{

    public function __construct(
      private HttpClientInterface $client,
      private LoggerInterface $logger,
      private string $apiKey
      ){}

    public function getWeatherData(string $city): array
    {
        if(!preg_match('/^[\p{L}]+$/u', $city)) {
            return ['error' => 'Wrong data type.'];
        }

        $url = "https://api.weatherapi.com/v1/current.json?key={$this->apiKey}&q={$city}";
        
        try {
            $response = $this->client->request('GET', $url);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                return ['error' => 'Unable to fetch weather data.'];
            }

            $data = $response->toArray();

            return [
                'city' => $data['location']['name'],
                'country' => $data['location']['country'],
                'temperature' => $data['current']['temp_c'],
                'condition' => $data['current']['condition']['text'],
                'humidity' => $data['current']['humidity'],
                'wind_speed' => $data['current']['wind_kph'],
                'last_updated' => $data['current']['last_updated'],
            ];
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}
