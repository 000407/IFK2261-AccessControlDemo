<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use \Validator;

use App\Enums\Status;
use Illuminate\Validation\Rules\Enum;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllProducts(Request $req)
    {
        $status = 200;
        $responseBody = [
            'message' => 'Operation successful!'
        ];

        $page = $req->input('page') ?? 0;

        try {
          // Retrieval of data
          $responseBody['payload'] = Product::paginate(100, ['*'], 'page', $page);
        } catch (Throwable $e) {
            report($e);

            $status = 500;
            $responseBody = [
                'message' => 'Internal error occurred!!'
            ];
        }
        

        return response()->json($responseBody, $status);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addNewProduct(StoreProductRequest $req)
    {
        $status = 200;
        $responseBody = [
            'message' => 'Operation successful!'
        ];

        try {
            $product = $req->json()->all();

            $saved = Product::create($product);

            $responseBody['data'] = $saved;
        } catch (Throwable $e) {
            report($e);

            $status = 500;
            $responseBody = [
                'message' => 'Internal error occurred!!'
            ];
        }

        return response()->json($responseBody, $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProduct($id, UpdateProductRequest $req)
    {
        $status = 200;
        $responseBody = [
            'message' => 'Operation successful!'
        ];

        try {
            $product = $req->json()->all();
            
            $savedProduct = Product::find($id);

            if ($savedProduct == null) {
                $status = 404;
                $responseBody = [
                    'message' => "No product was found for id $id!"
                ];
            } else {
                $savedProduct->fill($product);
                $savedProduct->save();
            }
        } catch (Throwable $e) {
            report($e);

            $status = 500;
            $responseBody = [
                'message' => 'Internal error occurred!!'
            ];
        }

        return response()->json($responseBody, $status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, $id)
    {
        $status = 200;
        $responseBody = [
            'message' => 'Operation successful!'
        ];

        try {
            $product = Product::find($id);

            if ($product != null) {
              $product->status = 'DELETED';
              $product->save();
            } else {
              $status = 404;
              $responseBody = [
                  'message' => "No product with id $id was found!" 
              ];
            }

        } catch (Throwable $e) {
            report($e);

            $status = 500;
            $responseBody = [
                'message' => 'Internal error occurred!!'
            ];
        }

        return response()->json($responseBody, $status);
    }
}
