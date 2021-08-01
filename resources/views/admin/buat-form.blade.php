@extends('layouts.app')
@section('isi_halaman')

<div class="row">
    <div class="col">
        <!-- begin::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Tanya Pilihan Tunggal</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <label class="required form-label">Pilih Tipe</label>
                <div class="w-100 mb-10">
                    <select name="metode" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-18-0jcq"></option>
                        <option value="teks">Teks</option>
                        <option value="angka">Angka</option>
                    </select>
                </div>
                <div class="mb-10">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!-- end::Card -->
        <!-- begin::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Tanya Pilihan Ganda</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <label class="required form-label">Pilih Tipe</label>
                <div class="w-100 mb-5">
                    <select name="metode" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-18-0jcq"></option>
                        <option value="teks">Teks</option>
                        <option value="angka">Angka</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
                <label class="required form-label">Jumlah Opsi</label>
                <select class="form-select form-select-solid mb-5" name="jumlah_opsi" onchange="jumlahopsi(this);">
                    <option value="">-</option>
                    <?php for($jmlh_sesi=1; $jmlh_sesi<=10;  $jmlh_sesi++){ ?>
                        <option value="<?php echo $jmlh_sesi; ?>"><?php echo $jmlh_sesi; ?></option>
                    <?php } ?>
                </select>
                <div class="mt-3" id="tambah_barang"></div>
            </div>
            <!--end::Body-->
        </div>
        <!-- end::Card -->
    </div>
    <div class="col">
        <!-- begin::Card -->
        <div class="card card-xxl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Members Statistics</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th class="min-w-150px">Authors</th>
                                <th class="min-w-140px">Company</th>
                                <th class="min-w-120px">Progress</th>
                                <th class="min-w-100px text-end">Actions</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Ana Simmons</a>
                                            <span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">Intertico</a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">Web, UI/UX Design</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">50%</span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotone/General/Settings-1.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
        <!-- end::Card -->
        <!-- begin::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Tujuan</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <label class="form-check form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="checkbox" value="kesehatan"/>
                    <span class="form-check-label">
                        Kesehatan
                    </span>
                </label>
                <label class="form-check form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="checkbox" value="it"/>
                    <span class="form-check-label">
                        IT
                    </span>
                </label>
                <label class="form-check form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="checkbox" value="finance"/>
                    <span class="form-check-label">
                        Finance
                    </span>
                </label>
            </div>
            <!--end::Body-->
        </div>
        <!-- end::Card -->
    </div>
</div>

<script>
function jumlahopsi(that){
    var jmlh = that.value;
    var x ="", i;
    for (i=1; i<=jmlh; i++) {
        x = x +
            "<div class=\"mb-5\">" +
            "<label class=\"required form-label\">Untuk Opsi " + i + "</label><br>" +
            "<input type=\"text\" class=\"form-control form-control-solid mb-5\" placeholder=\"Opsi " + i +"\" name=\"opsi" + i + "\" required>" +
            "</div>"
        ;
    }
    document.getElementById("tambah_barang").innerHTML = x;
}
</script>
@endsection('isi_halaman')