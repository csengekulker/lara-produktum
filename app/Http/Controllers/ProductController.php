<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Resources\ProductResource;
use App\Http\Controllers\BaseController;
use Validator;

class ProductController extends BaseController
{
    public function store( Request $request ) {
        $input = $request->all();

        $validator = Validator::make( $input, [
            "name" => "required",
            "price" => "required"
        ]);

        if ($validator->fails()) {

            return $this->sendError( $validator->errors());
        }

        $product = Product::create( $input );

        echo "jo";
        // return $this->sendResponse( new ProductResource( $product ), "Termék felvéve");

    }
}
