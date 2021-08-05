@extends('layouts.app')
@section('isi_halaman')

<div class="card">
    <div class="container">
        
    </div>
    <div class="card-body">
        @foreach($export_form as $e)
            @if($e->spek_form->type == "text")
                <label class="form-label required">{{ $e->spek_form->pertanyaan }}</label>
                <table class="table table-striped table-row-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <td>NIP</td>
                            <th>Email</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($e->spek_form->form_values as $esf)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $esf->user->name }}</td>
                            <td>{{ $esf->user->nip }}</td>
                            <td>{{ $esf->user->email }}</td>
                            <td>{{ $esf->value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif($e->spek_form->type == "number")
                <label class="form-label required">{{ $e->spek_form->pertanyaan }}</label>
                <table class="table table-striped table-row-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <td>NIP</td>
                            <th>Email</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1 @endphp
                        @foreach($e->spek_form->form_values as $esf)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $esf->user->name }}</td>
                            <td>{{ $esf->user->nip }}</td>
                            <td>{{ $esf->user->email }}</td>
                            <td>{{ $esf->value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            @elseif($e->spek_form->type == "radio" && $e->spek_form->data == "text")
                <script>
                    var ctx = document.getElementById('kt_chartjs_1');

                    // Define colors
                    var primaryColor = KTUtil.getCssVariableValue('--bs-primary');
                    var dangerColor = KTUtil.getCssVariableValue('--bs-danger');
                    var successColor = KTUtil.getCssVariableValue('--bs-success');

                    // Define fonts
                    var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

                    // Chart labels
                    const labels = [
                        
                    ];

                    // Chart data
                    const data = {
                        labels: labels,
                        datasets: [
                            ...
                        ]
                    };

                    // Chart config
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            plugins: {
                                title: {
                                    display: false,
                                }
                            },
                            responsive: true,
                            interaction: {
                                intersect: false,
                            },
                            scales: {
                                x: {
                                    stacked: true,
                                },
                                y: {
                                    stacked: true
                                }
                            }
                        },
                        defaults:{
                            global: {
                                defaultFont: fontFamily
                            }
                        }
                    };

                    var myChart = new Chart(ctx, config);
                </script>

            @elseif($e->spek_form->type == "radio" && $e->spek_form->data == "number")

            @elseif($e->spek_form->type == "checkbox" && $e->spek_form->data == "text")

            @elseif($e->spek_form->type == "checkbox" && $e->spek_form->data == "number")

            @endif
        @endforeach
    </div>
</div>

@endsection('isi_halaman')

@section('isi_action')
    <a class="btn btn-sm btn-primary" href="{{ route('download-export') }}">Download PDF</a>
    <a class="btn btn-sm btn-danger" href="{{ route('clear-export') }}">Clear View</a>
@endsection('isi_action')