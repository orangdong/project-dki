@extends('layouts.app')
@section('isi_halaman')
<div class="row">
    <div class="col">
        <!-- begin::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">History Form</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                @foreach($form as $f)
                <!--begin::Item-->
                <div class="d-flex align-items-center bg-light-info rounded p-5 mb-3">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-info me-5">
                        <!--begin::Svg Icon | path: icons/duotone/Home/Library.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                    <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2">
                        <a href="{{ route('dashboard.buat-form').'?id='.$f->id }}" class="fw-bolder text-gray-800 text-hover-primary fs-6">{{ $f->title }}</a>
                        <span class="text-muted fw-bold d-block">Valid Until {{ $f->valid_until }}</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Lable-->
                    <form action="{{ route('dashboard.edit-valid-until') }}" method="post">
                        @csrf
                        <input type="date" name="valid_until" class="form-control me-2 mb-3">
                        <input type="hidden" name="form_id" class="form-control me-2 mb-3" value="{{ $f->id }}">
                        <input type="submit" class="btn btn-sm btn-info me-2" style="float:right" value="Update">
                    </form>
                    <!--end::Lable-->
                </div>
                <!--end::Item-->
                @endforeach
            </div>
            <!--end::Body-->
        </div>
        <!-- end::Card -->
    </div>
    <div class="col">
        <!-- begin::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Buat Form Baru</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <form action="{{route('dashboard.new-form')}}" method="post">
                    @csrf
                <div class="mb-10">
                    <label class="required form-label">Judul</label>
                    <input type="text" name="judul" class="form-control form-control-solid" autocomplete="off" required />
                </div>
                <div class="mb-10">
                    <label class="required form-label">Deskripsi</label>
                    <textarea type="text" name="deskripsi" class="form-control form-control-solid" autocomplete="off" required></textarea>
                </div>
                <div class="mb-10">
                    <label class="required form-label">Valid Until</label>
                    <input type="date" class="form-control form-control-solid" name="valid_until" placeholder="Pick a date" id="kt_datepicker_2"/>
                </div>
                <div class="mb-10">
                    <input type="submit" class="btn btn-sm btn-success" value="Add"/>
                </div>
                </form>
            </div>
            <!--end::Body-->
        </div>
        <!-- end::Card -->
    </div>

</div>

        
<script>
    $("#kt_datepicker_2").flatpickr();
</script>
    
 

@endsection('isi_halaman')