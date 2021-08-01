@extends('layouts.dark')
@section('isi_halaman')
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" enctype="multipart/form-data" id="kt_sign_up_form" action="{{ route('register') }}" method="post">
                            @csrf
							<!--begin::Heading-->
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Buat Akun Baru</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Sudah punya akun?
								<a href="{{ route('login') }}" class="link-primary fw-bolder">Login</a></div>
								<!--end::Link-->
							</div>
							<!--end::Heading-->
							<!--begin::Input group-->
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
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Name</label>
								<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="name" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">NIP</label>
								<input class="form-control form-control-lg form-control-solid" type="number" placeholder="" name="nip" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Jabatan</label>
								<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="jabatan" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Unit</label>
								<select name="unit" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true"  tabindex="-1" aria-hidden="true">
									<option value=""></option>
									@forelse (App\Models\UserUnit::get() as $item)
									<option value="{{$item->unit}}">{{$item->unit}}</option>
									@empty
										
									@endforelse
								</select>
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10 fv-row" data-kt-password-meter="true">
								<!--begin::Wrapper-->
								<div class="mb-1">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6">Password</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
									</div>
									<!--end::Input wrapper-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Hint-->
								<div class="text-muted"></div>
								<!--end::Hint-->
							</div>
							<!--end::Input group=-->
							<!--begin::Input group-->
							<div class="fv-row mb-5">
								<label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
								<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password_confirmation" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Staff Code</label>
								<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="staff_code" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<button type="submit" class="btn btn-lg btn-primary">
									Daftar
								</button>
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
@endsection('isi_halaman')