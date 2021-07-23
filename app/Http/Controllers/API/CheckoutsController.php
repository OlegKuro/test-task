<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class CheckoutsController extends Controller
{

    protected $apiToModelFields = [
        'address' => 'client_address',
        'name' => 'client_name',
        'shippingPrice' => 'total_shipping_value',
    ];

    /**
     * Validates and stores new checkout.
     *
     * @param Product $product
     * @param StoreCheckoutRequest $request
     * @return JsonResponse
     */
    public function store(Product $product, StoreCheckoutRequest $request): JsonResponse
    {
        $checkout = new Checkout();

        $checkout->fill(
            collect($request->only(array_keys($this->apiToModelFields)))
                ->mapWithKeys(function ($value, $key) {
                    return [$this->apiToModelFields[$key] => $value];
                })
                ->toArray()
        );
        $checkout->total_product_value = $product->price;
        $checkout->product()->associate($product);
        $checkout->save();

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
