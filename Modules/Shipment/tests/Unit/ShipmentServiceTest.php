<?php

namespace Modules\Shipment\tests\Unit;

use Modules\Shipment\DTOs\ShipmentCreateDTO;
use Modules\Shipment\Interfaces\GeolocationServiceInterface;
use Modules\Shipment\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipment\Services\ShipmentService;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class ShipmentServiceTest extends TestCase
{
    private $repositoryMock;
    private $geolocationMock;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->repositoryMock = Mockery::mock(ShipmentRepositoryInterface::class);
        $this->geolocationMock = Mockery::mock(GeolocationServiceInterface::class);
        
        $this->service = new ShipmentService(
            $this->repositoryMock,
            $this->geolocationMock
        );
    }

    public function testCreateShipment()
    {
        $user = User::factory()->make(['id' => 1]);
        $dto = new ShipmentCreateDTO([
            'Akintan David',
            'Adeleke Isaiah',
            '82 Clerkenwell Road, London, UK',
            '6 Rue Massillon, 30020 Nîmes, France'
        ]);
        
        $this->geolocationMock->shouldReceive('getCoordinates')
            ->with('82 Clerkenwell Road, London, UK')
            ->andReturn(['lat' => 1.23, 'lng' => 4.56]);
            
        $this->geolocationMock->shouldReceive('getCoordinates')
            ->with('6 Rue Massillon, 30020 Nîmes, France')
            ->andReturn(['lat' => 7.89, 'lng' => 0.12]);
            
        $this->repositoryMock->shouldReceive('create')
            ->once()
            ->andReturnUsing(function ($data) {
                $this->assertArrayHasKey('tracking_number', $data);
                $this->assertEquals('Sender', $data['sender_name']);
                $this->assertEquals('POINT(1.23 4.56)', $data['origin_coords']);
                return (object) $data;
            });
            
        $result = $this->service->createShipment($dto, $user);
        
        $this->assertEquals('Sender', $result->sender_name);
    }
    
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}