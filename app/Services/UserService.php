<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Session\SessionManager;

class UserService {
  protected $session;
  protected $instance;

  public function __construct(SessionManager $session) {
    $this->session = $session;
  }

  public function setRoleToUser(int $userId, int $roleId) {
    $user = User::find($userId);

    if ($user != null) {
      if (Role::exists($roleId)) {
        $user->userRoles()->attach($roleId);
      } else {
        $status = 404;
        $message = "No role found for ID $roleId";
      }
    } else {
      $status = 404;
      $message = "No user found for ID $userId";
    }
    
    return [
      'status' => $status,
      'message' => $message
    ];
  }

  public function getAllUsers(int $page, int $perPage) {
    return User::paginate($perPage, ['*'], 'page', $page);
  }
}