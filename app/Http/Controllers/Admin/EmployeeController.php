<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\EmployeesDataTable;
use App\Http\Requests\AssignCustomersRequest;
use App\Http\Requests\Admin\EmployeeStoreRequest;
use App\Http\Requests\Admin\EmployeeUpdateRequest;
use App\Models\Customer;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('admin.employees.index');
    }

    public function show(Employee $employee)
    {   
        return view('admin.employees.show', compact('employee'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(EmployeeStoreRequest $request)
    {   
        $this->employeeService->create($request->validated());
        notyf()->addSuccess(__('تم إضافة الموظف بنجاح'));
        return redirect()->route('admin.employees.index');
    }

    public function edit(Employee $employee)
    {
        $customers = Customer::whereNull('employee_id')
                        ->orWhere('employee_id', $employee->id)
                        ->get();
        return view('admin.employees.edit' , compact('employee', 'customers'));
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $this->employeeService->update($employee, $request->validated());
        notyf()->addSuccess(__('تم تعديل الموظف بنجاح'));
        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->employeeService->delete($employee);
        notyf()->addSuccess(__('تم الحذف بنجاح'));
        return redirect()->route('admin.employees.index');
    }

    public function assignCustomersToEmployee(AssignCustomersRequest $request, Employee $employee)
    {
        $validatedData = $request->validated();
        $this->employeeService->assignCustomers($employee, $validatedData['customer_ids'] ?? []);
        notyf()->addSuccess(__('تم تعديل الموظف بنجاح'));
        return redirect()->back();
    }
}
