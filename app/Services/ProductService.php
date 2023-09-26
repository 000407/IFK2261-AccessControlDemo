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

    if ($product == null) {
      throw NotFoundException::new("PRODUCT", $productId);
    }

    if (!Location::where('id', $locationId )->exists()) {
      throw NotFoundException::new("LOCATION", $locationId);
    }

    $product->locations()->syncWithPivotValues($locationId, [
        'quantity' => $quantity,
      ], false);
  }
}