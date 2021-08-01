@extends('layouts.app')
@section('isi_halaman')

<div class="card card-body">
    <h2>Masukkan Staff Code Yang Baru</h2>
    <br>
    @if (request()->input('error') == 0 && request()->input('message'))
    <div style="border-radius: 8px; font-weight: 500" class="alert alert-success" role="alert">
        {{ request()->input('message') }}
    </div>
    @elseif(request()->input('error') == 1 && request()->input('message'))
    <div style="border-radius: 8px; font-weight: 500" class="alert alert-danger" role="alert">
        {{ request()->input('message') }}
    </div>
    @endif
    <form action="{{route('edit-code')}}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="code" placeholder="Staff Code" class="form-control form-control-solid" autocomplete="off" required />
        </div>
        <div class="input-group mb-3">
            <input type="text" name="code_confirmation" placeholder="Konfirmasi Staff Code" class="form-control form-control-solid" autocomplete="off" required />
            <div class="input-group-append">
                <input type="submit" class="btn btn-success ms-3" value="Edit"/>
            </div>
        </div>
    </form>
    <br>
    <h5>Staff Code Saat Ini: {{$staffcode}}</h5>
</div>

@endsection('isi_halaman')