<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\BaseController;
use Validator;

class ProductController extends BaseController
{
    public function index() {

        $products = Product::all();

        return $this->sendResponse( ProductResource::collection( $products ), "OK");
    }

    public function store( Request $request ) {
        $input = $request->all();

        $validator = Validator::make( $input, [
            "name" => "required",
            "price" => "required"
        ]);

        if ($validator->fails()) {

            return $this->sendError( $validator->errors() );
        }

        $product = Product::create( $input );

        return $this->sendResponse( new ProductResource( $product ), "Termék felvéve");

    }

    public function show( $id ) {
        $product = Product::find( $id );

        if ( is_null( $product )) {
            return $this->sendError( "A termék nem létezik");
        } 
        
        return $this->sendResponse( new ProductResource( $product ), "Termék betöltve");
    }

    public function update (Request $request, $id ) {

        $input = $request->all();

        $validator = Validator::make( $input, [

            "name" => "required",
            "price" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError( $validator->errors());
        }

        $product = Product::find( $id );
        $product->update( $input );

        return $this->sendResponse( new ProductResource( $product), "Termékadatok frissítve");
    }

    public function destroy( $id ) {

        Product::destroy( $id );

        return $this->sendResponse([], "Termék törölve");
        
    }
}
