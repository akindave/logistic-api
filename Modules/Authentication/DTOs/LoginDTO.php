<?php
namespace Modules\Authentication\DTOs;

class LoginDTO {
    public string $email,$password;
    public function __construct(array $data){
        $this->email = $data['email'];
        $this->password = $data['password'];
    }
}
