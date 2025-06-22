<?php
namespace Modules\Authentication\DTOs;

class RegisterDTO {
    public string $name, $email, $password, $role;
    public function __construct(array $data){
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->role = $data['role'] ?? 'user';
    }
}
