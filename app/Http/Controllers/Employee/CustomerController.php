<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\BaseCustomerController;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\DataTables\Employee\CustomersDataTable;


class CustomerController extends BaseCustomerController
{
    protected function getRedirectRoute()
    {
        return 'employee.customers.index';
    }
    protected function getViewPrefix(): string
    {
        return 'employee';
    }
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render('employee.customers.index');
    }

}
