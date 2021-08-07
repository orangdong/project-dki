
@extends('layouts.dark')
@section('isi_halaman')
<!--begin::Wrapper-->
<div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Reset Password</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Enter your new password.</div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<form method="post" action="{{ route('password.update') }}">
							    @csrf
							    <input type="hidden" name="token" value="{{ $request->route('token') }}">
							    <div class="fv-row mb-10">
								@if ($errors->any())
    								<div class="alert alert-danger" role="alert">
									<p class="fw-bolder text-gray-800 fs-6">Something Went Wrong</p>
           						 @foreach ($errors->all() as $error)
									<span style="color: rgb(187, 8, 8)" class="text-mute fw-bold d-block">{{$error}}</span>
            					@endforeach	
									</div>
								@endif
								</div>
							<div class="fv-row mb-10">
								<label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
								<input class="form-control form-control-solid" type="email" placeholder="" name="email" value="{{request()->input('email')}}" autocomplete="off" readonly/>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fw-bolder text-gray-900 fs-6">New Password</label>
								<input class="form-control form-control-solid" type="password" placeholder="" name="password"/>
							</div>
							<div class="fv-row mb-10">
								<label class="form-label fw-bolder text-gray-900 fs-6">Confirm Password</label>
								<input class="form-control form-control-solid" type="password" placeholder="" name="password_confirmation"/>
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="d-flex flex-wrap justify-content-center pb-lg-0">
								<button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">
						            Submit
								</button>
								<a href="{{route('login')}}" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
@endsection('isi_halaman')
