@extends('layouts.app')
@section('isi_halaman')

<div class="row">
    <div class="col">
        <!-- begin::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Tanya Jawaban Tunggal</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <form action="" method="post">
                <label class="required form-label">Pilih Tipe</label>
                <div class="w-100 mb-5">
                    <select name="metode" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true">
                        <option value=""></option>
                        <option value="teks">Teks</option>
                        <option value="angka">Angka</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
                <div class="mb-2">
                    <input type="submit" class="btn btn-sm btn-primary"/>
                </div>
                </form>
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
                <form action="" method="post">
                <div class="mb-5">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
                <label class="form-check form-check-custom form-check-solid mb-5">
                    <input class="form-check-input" type="checkbox" value="1jawaban"/>
                    <span class="form-check-label text-gray-700">
                        Hanya boleh memilih 1 opsi
                    </span>
                </label>
                <label class="required form-label">Tipe Opsi</label>
                <div class="w-100 mb-5">
                    <select name="metode" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true">
                        <option value=""></option>
                        <option value="teks">Teks</option>
                        <option value="angka">Angka</option>
                    </select>
                </div>
                <label class="required form-label">Jumlah Opsi</label>
                <select class="form-select form-select-solid mb-5" name="jumlah_opsi" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true" onchange="jumlahopsi(this);">
                    <option value=""></option>
                    <?php for($jmlh_sesi=1; $jmlh_sesi<=10;  $jmlh_sesi++){ ?>
                        <option value="<?php echo $jmlh_sesi; ?>"><?php echo $jmlh_sesi; ?></option>
                    <?php } ?>
                </select>
                <div class="mt-3" id="tambah_barang"></div>
                <div class="mb-2">
                    <input type="submit" class="btn btn-sm btn-primary" />
                </div>
                </form>
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
                    <span class="card-label fw-bolder fs-3 mb-1">Tampilan Form</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="mb-5">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
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
                <form action="" method="post">
                <label class="form-check form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="checkbox" name="tujuan[]" value="kesehatan"/>
                    <span class="form-check-label">
                        Kesehatan
                    </span>
                </label>
                <label class="form-check form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="checkbox" name="tujuan[]" value="it"/>
                    <span class="form-check-label">
                        IT
                    </span>
                </label>
                <label class="form-check form-check-custom form-check-solid mb-3">
                    <input class="form-check-input" type="checkbox" name="tujuan[]" value="finance"/>
                    <span class="form-check-label">
                        Finance
                    </span>
                </label>
                <div class="mb-2">
                    <input type="submit" class="btn btn-sm btn-primary" />
                </div>
                </form>
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