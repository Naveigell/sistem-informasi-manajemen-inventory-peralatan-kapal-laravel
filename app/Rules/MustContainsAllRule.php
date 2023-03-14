<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\RequestOrder;
use Illuminate\Contracts\Validation\Rule;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MustContainsAllRule implements Rule
{
    private $ids;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function passes($attribute, $value)
    {
        $requestOrderDetailProductIds = RequestOrder::findOrFail(request()->get('request_id'))
                                            ->load('requestOrderDetails')
                                            ->requestOrderDetails
                                            ->pluck('product_id')
                                            ->unique();

        // check the total of ids and request order detail, if the total is same, it's mean the admin have chosen all of
        // requested product
        $totalProduct = Product::whereIn('id', $this->ids)
            ->get()
            ->filter(fn ($product) => $requestOrderDetailProductIds->contains($product->id))
            ->count();

        return $totalProduct == $requestOrderDetailProductIds->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The order product must be contains all request product';
    }
}
