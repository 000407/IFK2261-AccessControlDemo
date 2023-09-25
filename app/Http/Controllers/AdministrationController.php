<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Product;
use App\Models\ProductLocation;
use App\Services\UserService;
use Illuminate\Http\Request;
use Throwable;

class AdministrationController extends Controller {
  protected $userService;

  public function __construct(UserService $userService) {
    $this->userService = $userService;
  }

  public function getAllUsers(Request $req) {
    $page = $req->input('page');
    $perPage = $req->input('perPage');
    return response()->json($this->userService->getAllUsers($page, $perPage), 200);
  }

  public function addRoleToUser($userId, $roleId) {
    try {
      $res = $this->userService->setRoleToUser($userId, $roleId);
      extract($res);
    } catch (Throwable $e) {
      report($e);
      $status = 500;
      $message = 'Internal error occurred!';
    }

    return response()->json(['message' => $message], $status);
  }

  public function addOrUpdateQuantities($productId, $locationId, $quantity) {
    $status = 200;
    $message = 'Operation successfully completed!';

    try {
      $product = Product::find($productId);

      if ($product != null) {
        if (Location::exists($locationId)) {
          $product->locations()->syncWithPivotValues($locationId, [
            'quantity' => $quantity,
          ], false);
        } else {
          $status = 404;
          $message = "No location found for ID $locationId";
        }
      } else {
        $status = 404;
        $message = "No product found for ID $productId";
      }
    } catch (Throwable $e) {
      report($e);
      $message = $e->getMessage();
      $status = 500;
      $message = 'Internal error occurred!';
    }

    return response()->json(['message' => $message], $status);
  }
}
