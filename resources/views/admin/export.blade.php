@extends('layouts.app')
@section('isi_halaman')


<!-- begin::Card -->
<div class="card card-xl-stretch mb-xl-8">
    <form action="" method="post">
        <table id="export" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>No</th>
                    <th>Form</th>
                    <th>Pertanyaan</th>
                    <th>Tipe</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Survey Kemampuan Teknologi</td>
                    <td>Seberapa yakin Anda dengan kemampuan Anda?</td>
                    <th>Angka</th>
                    <td><input type="checkbox" name="id_spek_form" value="1"/></td>
                </tr>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
        <a class="btn btn-sm btn-success" type="submit">Export</a>
    </form>
</div>

<!-- end::Card -->

    
 

@endsection('isi_halaman')