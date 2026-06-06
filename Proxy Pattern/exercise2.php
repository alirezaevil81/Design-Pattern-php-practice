<?php

interface Subject
{
    public function request(): void;
}

function clientCode(Subject $subject): void
{
    $subject->request();
    $subject->request();
}


class WeatherService implements Subject
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct(string $apiKey, string $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    public function request(): void
    {
        // Make an HTTP request to the remote API to retrieve weather information
        // using the API key and base URL provided.
        // ...
        echo "WeatherService: Retrieving weather information from remote API.\n";
    }
}


class WeatherServiceProxy implements Subject
{
    private WeatherService $weatherService;
    private array $cache;

    public function __construct(string $apiKey, string $baseUrl)
    {
        $this->weatherService = new WeatherService($apiKey, $baseUrl);
        $this->cache = [];
    }

    public function request(): void
    {
        // Check if the weather information is already in the cache.
        $cacheKey = $this->generateCacheKey();
        if (isset($this->cache[$cacheKey])) {
            echo "WeatherServiceProxy: Retrieving weather information from cache.\n";
            return;
        }

        // Otherwise, retrieve the weather information from the remote API.
        $this->weatherService->request();

        // Cache the retrieved weather information for future requests.
        $this->cache[$cacheKey] = true;
    }


    private function generateCacheKey(): string
    {
        // Generate a cache key based on the current date and time.
        return date('Y-m-d H:i');
    }
}



echo "Client: Executing the client code with a real weather service:\n";
$weatherService = new WeatherService('your_api_key', 'https://api.weather.com');
clientCode($weatherService);

echo "\n";

echo "Client: Executing the same client code with a weather service proxy:\n";
$weatherServiceProxy = new WeatherServiceProxy('your_api_key', 'https://api.weather.com');
clientCode($weatherServiceProxy);

