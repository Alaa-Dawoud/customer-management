@extends('admin.layouts.master')

@section('content')
    <form action="{{route('admin.customers.update', $customer->id)}}" method="POST" enctype="multipart/form-data" class="advanced-form myForm" autocomplete="off" data-parsley-validate novalidate>
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Edit Customer
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
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
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $customer->name }}" placeholder="Customer Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="{{ $customer->email }}" placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Customer Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{route('admin.customers.index')}}" class="btn btn-link link-secondary ms-auto">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
