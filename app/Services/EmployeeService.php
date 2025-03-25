<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Employee;

class EmployeeService extends BaseUserService
{
    public function __construct()
    {
        parent::__construct(new Employee());
    }

    public function assignCustomers(Employee $employee, array $customerIds = []): void
    {
        $employee->customers()->update(['employee_id' => null]);

        if (!empty($customerIds)) {
            Customer::whereIn('id', $customerIds)->update(['employee_id' => $employee->id]);
        }
    }
}
