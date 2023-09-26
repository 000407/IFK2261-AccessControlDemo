<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Location;
use App\Models\Product;
use Illuminate\Session\SessionManager;

class ProductService {
  protected $session;
  protected $instance;

  public function __construct(SessionManager $session) {
    $this->session = $session;
  }
  
  public function upsertLocationStock($productId, $locationId, $quantity) {
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
  }

  public function upsertLocationStock($productId, $locationId, $quantity) {
    $product = Product::find($productId);

    if ($product == null) {
      throw new NotFoundException("PRODUCT", $productId);
    }

    if (!Location::exists($locationId)) {
      throw new NotFoundException("LOCATION", $locationId);
    }

    $product->locations()->syncWithPivotValues($locationId, [
        'quantity' => $quantity,
      ], false);
  }
}