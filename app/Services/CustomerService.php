<?php

namespace App\Services;

use App\Models\Customer;
use App\Http\Requests\CustomerActionRequest;

class CustomerService extends BaseUserService
{
    public function __construct()
    {
        parent::__construct(new Customer());
    }

    public function storeOrUpdateAction(CustomerActionRequest $request, Customer $customer): void
    {
        $validated = $request->validated();

        $customer->action()->updateOrCreate(
            ['customer_id' => $customer->id],
            $validated
        );
    }
}
