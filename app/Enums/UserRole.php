<?php
  
namespace App\Enums;

enum UserRole:string {
    case ROOT = 'ROOT';
    case ADMIN = 'ADMIN';
    case PREMIUM_USER = 'PREMIUM_USER';
    case REGULAR_USER = 'REGULAR_USER';
}