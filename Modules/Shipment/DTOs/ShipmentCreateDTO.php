<?php
namespace Modules\Shipment\DTOs;

class ShipmentCreateDTO {
    public string $sender_name, $receiver_name, $origin_address, $destination_address;
    public function __construct(array $data){
      $this->sender_name = $data['sender_name'];
      $this->receiver_name = $data['receiver_name'];
      $this->origin_address = $data['origin_address'];
      $this->destination_address = $data['destination_address'];
    }
  }
  