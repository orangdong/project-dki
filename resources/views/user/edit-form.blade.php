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
        <div class="alert alert-info mb-10">{{ $form->description }}</div>
        <form action="{{ route('dashboard.submit-form') }}" method="post">
            @csrf
            @foreach($form->spek_forms as $s)
                
                @if($s->type == "number")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        <input type="{{ $s->type }}" name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" value="{{ $s->user_values->value }}" required />
                    </div>
                @endif
                @if($s->type == "text")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        <textarea name="{{ $s->id }}" class="form-control form-control-solid" autocomplete="off" required>{{ $s->user_values->value }}</textarea>
                    </div>
                @endif
                @if($s->type == "radio")
                    <div class="mb-5">
                        <label class="required form-label">{{ $s->pertanyaan }}</label>
                        @foreach($s->spek_sub_forms as $ss)
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id }}" value="{{ $ss->option }}"
                                @if($ss->option == $s->user_values->value)
                                    {{ 'checked' }}
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
                        @php 
                            $value_array = json_decode($s->user_values->value)
                        @endphp
                        @foreach($s->spek_sub_forms as $ss)
                        <label class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="{{ $s->type }}" name="{{ $s->id.'[]' }}" value="{{ $ss->option }}" 
                                @if(in_array($ss->option, $value_array))
                                    {{ 'checked' }}
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
                <input type="hidden" name="form_id" value="{{ $form_id }}"/>
                <input type="submit" class="btn btn-sm btn-success">
            </div>
        </form>
    </div>
    <!--begin::Body-->
</div>
<!-- end::Card -->

@endsection('isi_halaman')