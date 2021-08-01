@extends('layouts.app')
@section('isi_halaman')
	<!-- begin::Card -->
	<div class="card">
	 

									<!--begin::Card body-->
									<div class="card-body p-9">
										<div class="row mb-7">
											@if(!$user->surat)
    										<div style="border-radius: 8px; font-weight: 500" class="alert alert-danger" role="alert">
        										Silakan upload surat penugasan sebelum melanjutkan aplikasi
    										</div>
    										@endif
											@if(request()->input('success') == 1)
    										<div style="border-radius: 8px; font-weight: 500" class="alert alert-success" role="alert">
        										{{request()->input('message')}}
    										</div>
    										@endif
											@if($errors->any())
											<div style="border-radius: 8px; font-weight: 500" class="alert alert-danger" role="alert">
												@foreach ($errors->all() as $item)
												{{$item}}
												@endforeach
    										</div>
											@endif
										</div>
										{{-- test file path --}}
										<div class="row mb-7">
											<a href="{{storage_path($user->surat)}}">Surat test</a>
										</div>
										<!--begin::Row-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Full Name</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
												<span class="fw-bolder fs-6 text-dark">{{$user->name}}</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Row-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Email</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8 fv-row">
												<span class="fw-bold fs-6">{{$user->email}}</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<form enctype="multipart/form-data" method="post" action="{{route('dashboard.profile.edit')}}">
											@csrf
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Surat Penugasan
											<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Surat Penugasan"></i></label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <span>
                                                    
                                                        <input type="file" name="surat" class="form-control form-control-solid" />
												</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">NIP
											<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="NIP"></i></label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <span>
                                                    <input type="number" name="nip" class="form-control form-control-solid" value="{{$user->nip}}" />
												</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Jabatan
											<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Jabatan"></i></label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <span>
                                                    <input type="text" name="jabatan" class="form-control form-control-solid" value="{{$user->jabatan}}" />
												</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Unit
											<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Unit"></i></label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <span>
													<select name="unit" required class="form-select form-select-solid mb-3" data-control="select2" data-placeholder="{{$user->unit}}" data-hide-search="true" tabindex="-1" aria-hidden="true">
														<option value="{{$user->unit}}">{{$user->unit}}</option>
														@forelse ($units->where('unit', '!=', $user->unit) as $item)
														<option value="{{$item->unit}}">{{$item->unit}}</option>
														@empty
															
														@endforelse
													</select>
														<br>
														<button type="submit" style="background: #47BE7D" class="btn btn-sm btn-flex btn-primary fw-bolder" >Edit</button>
                                                    </form>
												</span>
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Password Lama</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <form action="" method="post">
                                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password_lama" required autocomplete="current-password" />
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Password Baru</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
                                                <input class="form-control form-control-lg form-control-solid" type="password" name="password_baru" required autocomplete="current-password" />
											</div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="row mb-7">
											<!--begin::Label-->
											<label class="col-lg-4 fw-bold text-muted">Konfirmasi Password Baru</label>
											<!--end::Label-->
											<!--begin::Col-->
											<div class="col-lg-8">
												    <input class="form-control form-control-lg form-control-solid" type="password" name="password_baru_confirm" required autocomplete="current-password" />
                                                    <br><button type="submit" style="background: #f1416c" class="btn btn-sm btn-flex btn-primary fw-bolder" >Ganti Password</button>
                                                </form>
                                            </div>
											<!--end::Col-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Card body-->
	</div>
@endsection('isi_halaman')