@extends('layouts.app')
@section('isi_halaman')
<style>
    .delete-button:hover{
        color: white;
        background: #D9214E
    }
</style>
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
                <form action="{{ route('dashboard.spek-form-tunggal') }}" method="post">
                    @csrf
                <label class="required form-label">Pilih Tipe</label>
                <div class="w-100 mb-5">
                    <select name="data" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true">
                        <option value=""></option>
                        <option value="text">Teks</option>
                        <option value="number">Angka</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
                <div class="mb-2">
                    <input type="hidden" name="form_id" value="{{ $form_id }}">
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
                <form action="{{ route('dashboard.spek-form-ganda') }}" method="post">
                    @csrf
                <div class="mb-5">
                    <label class="required form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control form-control-solid" autocomplete="off" required />
                </div>
                <label class="form-check form-check-custom form-check-solid mb-5">
                    <input class="form-check-input" type="checkbox" name="radio" value="radio"/>
                    <span class="form-check-label text-gray-700">
                        Hanya boleh memilih 1 opsi
                    </span>
                </label>
                <label class="required form-label">Tipe Opsi</label>
                <div class="w-100 mb-5">
                    <select name="data" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true">
                        <option value=""></option>
                        <option value="text">Teks</option>
                        <option value="number">Angka</option>
                    </select>
                </div>
                <label class="required form-label">Jumlah Opsi</label>
                <select class="form-select form-select-solid mb-5" name="jumlah_opsi" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true" onchange="jumlahopsi(this);">
                    <option value=""></option>
                    <?php for($jmlh_opsi=1; $jmlh_opsi<=10;  $jmlh_opsi++){ ?>
                        <option value="<?= $jmlh_opsi; ?>"><?= $jmlh_opsi; ?></option>
                    <?php } ?>
                </select>
                <div class="mt-3" id="tambah_opsi"></div>
                <div class="mb-2">
                    <input type="hidden" name="form_id" value="{{ $form_id }}">
                    <input type="submit" class="btn btn-sm btn-primary" />
                </div>
                </form>
            </div>
            <!--end::Body-->
        </div>
        <!-- end::Card -->
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 d-flex flex-column mt-5 mb-4">
                <h3 class="card-title fw-bolder text-dark">Ubah Deadline</h3>
                <p class="text-muted fw-bold d-block mt-n2">Current Deadline {{ $valid_until }}</p>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <form action="{{ route('dashboard.edit-valid-until') }}" method="post">
                    @csrf
                    <input type="date" name="valid_until" class="form-control me-2 mb-3">
                    <input type="hidden" name="form_id" class="form-control me-2 mb-3" value="{{ $form_id }}">
                    <input type="submit" class="btn btn-sm btn-primary me-2 mt-3" value="Update">
                </form>
            </div>
            <!--end::Body-->
        </div>
        
    </div>
    <div class="col">
        <!-- begin::Card -->
        <div class="card card-xxl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">{{ $form_title }}</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                @foreach($spek_form as $s)
                    @if($s->type == "number")
                        <div class="mb-5">
                            <label class="required form-label">{{ $s->pertanyaan }}</label>
                            <a href="{{ route('dashboard.hapus-spek-form').'?spek_form_id='.$s->id.'&form_id='.$form_id }}" class="badge badge-danger delete-button" style="float:right">x</a>
                            <input type="{{ $s->type }}" name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" required />
                        </div>
                    @endif
                    @if($s->type == "text")
                        <div class="mb-5">
                            <label class="required form-label">{{ $s->pertanyaan }}</label>
                            <a href="{{ route('dashboard.hapus-spek-form').'?spek_form_id='.$s->id.'&form_id='.$form_id }}" class="badge badge-danger delete-button" style="float:right">x</a>
                            <textarea name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" required></textarea>
                        </div>
                    @endif
                    @if($s->type == "radio")
                        <div class="mb-5">
                            <label class="required form-label">{{ $s->pertanyaan }}</label>
                            <a href="{{ route('dashboard.hapus-spek-form').'?spek_form_id='.$s->id.'&form_id='.$form_id }}" class="badge badge-danger delete-button" style="float:right">x</a>
                            @foreach($s->spek_sub_forms as $ss)
                            <label class="form-check form-check-custom form-check-solid mb-3">
                                <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id }}"/>
                                <span class="form-check-label">
                                    {{ $ss->option }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    @endif
                    @if($s->type == "checkbox")
                        <div class="mb-5">
                            <label class="required form-label">{{ $s->pertanyaan }}</label>
                            <a href="{{ route('dashboard.hapus-spek-form').'?spek_form_id='.$s->id.'&form_id='.$form_id }}" class="badge badge-danger delete-button" style="float:right">x</a>
                            @foreach($s->spek_sub_forms as $ss)
                            <label class="form-check form-check-custom form-check-solid mb-3">
                                <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id.'[]' }}"/>
                                <span class="form-check-label">
                                    {{ $ss->option }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    @endif
                @endforeach
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
                <form action="{{ route('dashboard.edit-tujuan-form') }}" method="post">
                    @csrf
                    @foreach($user_unit as $u)
                        
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" name="tujuan[]" value="{{ $u->unit }}"
                            @foreach($form_tujuan as $f)
                                @if($f->unit_tujuan == $u->unit)
                                    {{ 'checked' }}
                                @endif
                            @endforeach
                            />
                            <span class="form-check-label">
                                {{ $u->unit }}
                            </span>
                        </label>
                    @endforeach
                <div class="mb-2">
                    <input type="hidden" name="form_id" value="{{ $form_id }}">
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
            "<input type=\"text\" autocomplete=\"off\" class=\"form-control form-control-solid mb-5\" name=\"opsi[]\" placeholder=\"Opsi " + i + "\" required>" +
            "</div>"
        ;
    }
    document.getElementById("tambah_opsi").innerHTML = x;
}
</script>
@endsection('isi_halaman')