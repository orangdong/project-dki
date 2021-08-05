@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!-- begin::Card -->
<div class="card card-xl-stretch mb-xl-8">
    <div class="card-body">
        <form action="{{ route('submit-export') }}" method="post">
            @csrf
            <table id="export" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                        <th>No</th>
                        <th>Form</th>
                        <th>Pertanyaan</th>
                        <th>Data</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1
                    @endphp
                    @foreach($spek_form as $s)
                    <tr>
                        <td>
                            {{ $no++ }}
                        </td>
                        <td>{{ $s->form->title }}</td>
                        <td>{{ $s->pertanyaan }}</td>
                        <th>{{ $s->type }}</th>
                        <td>
                            <label class="form-check form-check-custom form-check-solid mb-3">
                                <input class="form-check-input" type="checkbox" name="spek_form_id[]" value="{{ $s->id }}"/>
                                <span class="form-check-label"></span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <input class="btn btn-sm btn-success" type="submit" value="Insert"/>
        </form>
    </div>
</div>

<!-- end::Card -->

<script>
    $("#export").DataTable({
 "language": {
  "lengthMenu": "Show _MENU_",
 },
 "dom":
  "<'row'" +
  "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
  "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
  ">" +

  "<'table-responsive'tr>" +

  "<'row'" +
  "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
  "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
  ">"
});
</script>
 

@endsection('isi_halaman')