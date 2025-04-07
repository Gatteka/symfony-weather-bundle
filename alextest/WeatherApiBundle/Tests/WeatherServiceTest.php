<?php
namespace AlexTest\WeatherApiBundle\Tests;

use AlexTest\WeatherApiBundle\Service\WeatherService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class WeatherServiceTest extends TestCase
{
    public function testGetWeatherDataSuccess()
    {
        $mockResponse = new MockResponse('{
            "location": {"name": "London", "country": "UK"},
            "current": {"temp_c": 15, "condition": {"text": "Clear"}, "humidity": 75, "wind_kph": 10, "last_updated": "2025-04-01 10:00"}
        }');
        $mockClient = new MockHttpClient($mockResponse);

        $weatherService = new WeatherService($mockClient, 'weather_api_key');

        $result = $weatherService->getWeatherData('London');

        $this->assertEquals('London', $result['city']);
        $this->assertEquals(15, $result['temperature']);
    }

    public function testGetWeatherDataFailure()
    {
        $mockClient = new MockHttpClient(new MockResponse('', ['http_code' => 500]));

        $weatherService = new WeatherService($mockClient, 'weather_api_key');
        $result = $weatherService->getWeatherData('London');

        $this->assertArrayHasKey('error', $result);
    }
}
