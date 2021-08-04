@extends('layouts.app')
@section('isi_halaman')

<!-- begin::Card -->
<div class="card card-xl-stretch mb-xl-8">
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
            @foreach($form_value->where('spek_form_id',$s->id) as $ss) 
                @if($s->type == "number")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        <input type="{{ $s->type }}" name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" value="{{ $ss->value }}" required />
                    </div>
                @endif
                @if($s->type == "text")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        <textarea name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" required>{{ $ss->value }}</textarea>
                    </div>
                @endif
                @if($s->type == "radio")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        @foreach($s->spek_sub_forms as $sss)
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id }}" value="{{ $sss->option }}"
                                @if($sss->option == $ss->value)
                                    {{ 'checked' }}
                                @endif
                            />
                            <span class="form-check-label">
                                {{ $sss->option }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                @endif
                @if($s->type == "checkbox")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        @php 
                            $value_array = json_decode($ss->value)
                        @endphp
                        @foreach($s->spek_sub_forms as $sss)
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id.'[]' }}" value="{{ $sss->option }}" 
                                @if(in_array($sss->option, $value_array))
                                    {{ 'checked' }}
                                @endif
                            />
                            <span class="form-check-label">
                                {{ $sss->option }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                @endif
            @endforeach
            @endforeach
    </div>
    <!--begin::Body-->
</div>
<!-- end::Card -->

@endsection('isi_halaman')