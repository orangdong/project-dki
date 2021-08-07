@extends('layouts.dark')
@section('isi_halaman')
<!--begin::Wrapper-->
<div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Forgot Password ?</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<form method="post" action="{{ route('password.email') }}">
							    @csrf
							    <div class="fv-row mb-10">
								@if ($errors->any())
    								<div class="alert alert-danger" role="alert">
									<p class="fw-bolder text-gray-800 fs-6">Something Went Wrong</p>
           						 @foreach ($errors->all() as $error)
									<span style="color: rgb(187, 8, 8)" class="text-mute fw-bold d-block">{{$error}}</span>
            					@endforeach	
									</div>
								@endif
								@if (session('status'))
                                    <div style="font-size: 16px;line-height: 1.25rem;color: rgba(5, 150, 105);font-weight: 500;" class="mb-4">
										{{ session('status') }}
									</div>
                                @endif
								</div>
							<div class="fv-row mb-10">
								<label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
								<input class="form-control form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
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