<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerActionRequest;
use App\Http\Requests\CustomerUpdateRequest;

abstract class BaseCustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    abstract protected function getRedirectRoute();
    
    abstract protected function getViewPrefix(): string;

    public function show(Customer $customer)
    {
        return view($this->getViewPrefix() . '.customers.show', compact('customer'));
    }

    public function create()
    {
        return view($this->getViewPrefix() . '.customers.create');
    }

    public function edit(Customer $customer)
    {
        return view($this->getViewPrefix() . '.customers.edit' , compact('customer'));
    }

    public function store(CustomerStoreRequest $request)
    {
        $this->customerService->create($request->validated());
        notyf()->addSuccess(__('تم إضافة العميل بنجاح'));
        return redirect()->route($this->getRedirectRoute());
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->customerService->update($customer, $request->validated());
        notyf()->addSuccess(__('تم تعديل العميل بنجاح'));
        return redirect()->route($this->getRedirectRoute());
    }

    public function destroy(Customer $customer)
    {
        $this->customerService->delete($customer);
        notyf()->addSuccess(__('تم الحذف بنجاح'));
        return redirect()->route($this->getRedirectRoute());
    }

    public function updateAction(CustomerActionRequest $request, Customer $customer)
    {
        $this->customerService->storeOrUpdateAction($request, $customer);

        notyf()->addSuccess(__('تم التعديل بنجاح'));
        return redirect()->route($this->getRedirectRoute());
    }

}
