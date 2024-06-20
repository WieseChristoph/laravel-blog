<?php

namespace App\Enums;

enum Role: int
{
    case USER = 0;
    case ADMIN = 1;

    public function name(): string
    {
        return match($this) {
            Role::USER => "User",
            Role::ADMIN => "Admin"
        };
    }

    public static function fromName(string $name): Role
    {
        return match(strtolower($name)) {
            strtolower(Role::USER->name()) => Role::USER,
            strtolower(Role::ADMIN->name()) => Role::ADMIN
        };
    }
}
