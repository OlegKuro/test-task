<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsController extends Controller
{
    /**
     * @param Request $request
     * @return ResourceCollection
     */
    public function index(Request $request): ResourceCollection
    {
        return new ProductCollection(
            Product::with('brand')
                ->paginate(intval($request->get('per_page', 25)))
        );
    }
}
