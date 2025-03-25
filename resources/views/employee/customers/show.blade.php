@extends('employee.layouts.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        {{ __('Customer :') }} {{$customer->name}}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12 mb-4">
									<div class="form-group">
										<label class="form-label">Customer Name</label>
										<div class="datagrid-content">{{$customer->name}}</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 mb-4">
									<div class="form-group">
										<label class="form-label">Customer Email</label>
										<div class="datagrid-content"><a class="link-primary" href="mailto:{{$customer->email}}">{{$customer->email}}</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
      </div>
@endsection
