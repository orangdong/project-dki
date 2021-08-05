@extends('layouts.app')
@section('isi_halaman')

<div class="card">
    <div class="container">
        
    </div>
    <div class="card-body">
        @foreach($export_form as $e)
            @if($e->spek_form->type == "text")
                <label class="form-label">{{ $e->spek_form->pertanyaan }}</label>
            @endif
            @if($e->spek_form->type == "number")

            @endif
            @if($e->spek_form->type == "radio")

            @endif
            @if($e->spek_form->type == "checkbox")

            @endif
        @endforeach
    </div>
</div>

@endsection('isi_halaman')

@section('isi_action')
    <a class="btn btn-sm btn-primary" href="{{ route('download-export') }}">Download PDF</a>
    <a class="btn btn-sm btn-danger" href="{{ route('clear-export') }}">Clear View</a>
@endsection('isi_action')