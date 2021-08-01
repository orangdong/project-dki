@extends('layouts.app')
@section('isi_halaman')

<div class="card card-body">
    <h2>Masukkan Staff Code Yang Baru</h2>
    <br>
    <form action="">
        <div class="input-group mb-3">
            <input type="text" name="metode_pembayaran" placeholder="Staff Code" class="form-control form-control-solid" autocomplete="off" required />
        </div>
        <div class="input-group mb-3">
            <input type="text" name="metode_pembayaran" placeholder="Konfirmasi Staff Code" class="form-control form-control-solid" autocomplete="off" required />
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Edit"/>
            </div>
        </div>
    </form>
    <br>
    <h5>Staff Code Saat Ini: Zilonglayla515</h5>
</div>

@endsection('isi_halaman')