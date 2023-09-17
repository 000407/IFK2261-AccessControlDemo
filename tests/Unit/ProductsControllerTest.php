<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;

use Illuminate\Http\Request;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    private $controller;

    protected function setUp() : void {
      parent::setUp();

      $this->controller = $this->app->make('App\Http\Controllers\ProductController');
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
      $request = Request::create('/api/v1.0/products', 'GET');
      
      $response = $this->controller->getAllProducts($request);
      echo json_encode($response);

      $this->assertTrue(true);
    }
}
