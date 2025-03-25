<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\DataTables\Admin\CustomersDataTable;
use App\Http\Controllers\BaseCustomerController;


class CustomerController extends BaseCustomerController
{
    protected function getRedirectRoute()
    {
        return 'admin.customers.index';
    }
    protected function getViewPrefix(): string
    {
        return 'admin';
    }
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render('admin.customers.index');
    }
    
}
