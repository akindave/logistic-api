<?php
namespace Modules\Shipment\Services;

use Modules\Shipment\Interfaces\GeolocationServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeolocationService implements GeolocationServiceInterface
{
    private string $apiKey;
    private string $baseUrl = 'https://api.opencagedata.com/geocode/v1/json';

    public function __construct()
    {
        $this->apiKey = config('services.opencage.key');
    }

    public function getCoordinates(string $address): ?array
    {
        try {
            $response = Http::get($this->baseUrl, [
                'q' => $address,
                'key' => $this->apiKey,
                'limit' => 1,
            ]);

            $data = $response->json();
            
            if ($response->successful() && !empty($data['results'])) {
                $geometry = $data['results'][0]['geometry'];
                return [
                    'lat' => $geometry['lat'],
                    'lng' => $geometry['lng']
                ];
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Geolocation API error: ' . $e->getMessage());
            return null;
        }
    }
}