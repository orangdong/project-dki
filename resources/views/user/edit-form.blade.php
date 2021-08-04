@extends('layouts.app')
@section('isi_halaman')

<!-- begin::Card -->
<div class="card card-xl-stretch mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">{{ $form->title }}</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <div class="alert alert-info mt-n5 mb-10">
            <p class="fw-bolder text-gray-800 fs-6">Deskripsi</p>
            
            {{ $form->description }}</div>
        <form action="{{ route('dashboard.submit-form') }}" method="post">
            @csrf
            @foreach($spek_form as $s)
                @foreach($s->form_values as $ss)
                    @php
                        $spek_form_values = $ss->value
                    @endphp
                @endforeach
                
                @if($s->type == "number")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        <input type="{{ $s->type }}" name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" value="@if(isset($spek_form_values)){{ $spek_form_values }}@endif" 
                            @if(isset($spek_form_values))
                                {{ 'disabled ' }}
                            @endif
                        required />
                    </div>
                @endif
                @if($s->type == "text")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        <textarea name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" 
                            @if(isset($spek_form_values))
                                {{ 'disabled ' }}
                            @endif    
                        required>@if(isset($spek_form_values)){{ $spek_form_values }}@endif</textarea>
                    </div>
                @endif
                @if($s->type == "radio")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        @foreach($s->spek_sub_forms as $ss)
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id }}" value="{{ $ss->option }}"
                                @if(isset($spek_form_values))
                                    {{ 'disabled ' }}
                                    @if($ss->option == $spek_form_values)
                                        {{ 'checked' }}
                                    @endif
                                @endif
                            />
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
                        @if(isset($spek_form_values))
                            @php 
                                $value_array = json_decode($spek_form_values)
                            @endphp
                        @endif
                        @foreach($s->spek_sub_forms as $ss)
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id.'[]' }}" value="{{ $ss->option }}" 
                                @if(isset($value_array))
                                    {{ 'disabled ' }}
                                    @if(in_array($ss->option, $value_array))
                                        {{ 'checked' }}
                                    @endif
                                @endif
                            />
                            <span class="form-check-label">
                                {{ $ss->option }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                @endif
            @endforeach
            <div class="mb-5">
                <input type="hidden" name="form_id" value="{{ $form->id }}"/>
                <input type="submit" class="btn btn-sm btn-success">
            </div>
        </form>
    </div>
    <!--begin::Body-->
</div>
<!-- end::Card -->

@endsection('isi_halaman')