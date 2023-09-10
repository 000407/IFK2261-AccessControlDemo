<?php
  
namespace App\Enums;

enum Status:string {
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case DELETED = 'DELETED';
}