@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Employee
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data"
                class="advanced-form myForm" autocomplete="off" data-parsley-validate novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $employee->name }}" placeholder="Employee Name" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                value="{{ $employee->email }}" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Employee Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{ route('admin.employees.index') }}"
                                    class="btn btn-link link-secondary ms-auto">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('admin.employees.assign-customers', $employee) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h2 class="m-4">Assign Customers:</h2>
                            <div class="card-body">
                                <select name="customer_ids[]" id="select-customers" class="form-control" multiple>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ $employee->customers->contains($customer->id) ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" class="btn btn-primary">Save Assignments</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-customers'), {
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                controlInput: '<input>',
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
    </script>
@endpush
