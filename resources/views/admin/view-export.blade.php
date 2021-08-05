@extends('layouts.app')
@section('isi_halaman')
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


<div class="card">
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
                        @php 
                            $no=1
                            $num_of_elements = count($arr)
                            $variance = 0.0 
                        @endphp
                        @foreach($e->spek_form->form_values as $esf)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $esf->user->name }}</td>
                            <td>{{ $esf->user->nip }}</td>
                            <td>{{ $esf->user->email }}</td>
                            <td>{{ $esf->value }}</td>
                        </tr>
                            @php
                            
                                
                                    // calculating mean using array_sum() method
                            $average = array_sum($arr)/$num_of_elements;
                                
                            foreach($arr as $i)
                            {
                                // sum of squares of differences between 
                                            // all numbers and means.
                                $variance += pow(($i - $average), 2);
                            }
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Average</td>
                            <td>{{ $average }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Standard Deviation</td>
                            <td>{{ $std }}</td>
                        </tr>
                    </tfoot>
                </table>

            @elseif($e->spek_form->type == "radio" && $e->spek_form->data == "text")
                @php $jumlah = [] @endphp
                @foreach($e->spek_form->spek_sub_forms as $ess)
                    @php
                    array_push($jumlah, App\Models\FormValue::where('value',$ess->option)->count())
                    @endphp
                @endforeach
                            <div id="kt_amcharts_{{ $e->spek_form->pertanyaan }}" style="height: 500px;"></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                am4core.useTheme(am4themes_animated);
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->pertanyaan }}', am4charts.XYChart)
                                chart.colors.step = 2;

                                chart.legend = new am4charts.Legend()
                                chart.legend.position = 'top'
                                chart.legend.paddingBottom = 20
                                chart.legend.labels.template.maxWidth = 95

                                var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
                                xAxis.dataFields.category = 'category'
                                xAxis.renderer.cellStartLocation = 0.1
                                xAxis.renderer.cellEndLocation = 0.9
                                xAxis.renderer.grid.template.location = 0;

                                var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                yAxis.min = 0;

                                function createSeries(value, name) {
                                    var series = chart.series.push(new am4charts.ColumnSeries())
                                    series.dataFields.valueY = value
                                    series.dataFields.categoryX = 'category'
                                    series.name = name

                                    series.events.on('hidden', arrangeColumns);
                                    series.events.on('shown', arrangeColumns);

                                    var bullet = series.bullets.push(new am4charts.LabelBullet())
                                    bullet.interactionsEnabled = false
                                    bullet.dy = 30;
                                    bullet.label.text = '{valueY}'
                                    bullet.label.fill = am4core.color('#ffffff')

                                    return series;
                                }

                                chart.data = [
                                    @php $i=0 @endphp
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!! 
                                            "{".
                                                "category: '".$ess->option."',
                                                first: ".$jumlah[$i++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                ]


                                createSeries('first', '{{ $e->spek_form->pertanyaan }}');


                                function arrangeColumns() {

                                    var series = chart.series.getIndex(0);

                                    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                                    if (series.dataItems.length > 1) {
                                        var x0 = xAxis.getX(series.dataItems.getIndex(0), 'categoryX');
                                        var x1 = xAxis.getX(series.dataItems.getIndex(1), 'categoryX');
                                        var delta = ((x1 - x0) / chart.series.length) * w;
                                        if (am4core.isNumber(delta)) {
                                            var middle = chart.series.length / 2;

                                            var newIndex = 0;
                                            chart.series.each(function (series) {
                                                if (!series.isHidden && !series.isHiding) {
                                                    series.dummyData = newIndex;
                                                    newIndex++;
                                                }
                                                else {
                                                    series.dummyData = chart.series.indexOf(series);
                                                }
                                            })
                                            var visibleCount = newIndex;
                                            var newMiddle = visibleCount / 2;

                                            chart.series.each(function (series) {
                                                var trueIndex = chart.series.indexOf(series);
                                                var newIndex = series.dummyData;

                                                var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                                series.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                                series.bulletsContainer.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                            })
                                        }
                                    }
                                }

                                });
                                </script>
                

            @elseif($e->spek_form->type == "radio" && $e->spek_form->data == "number")
                    @php $jumlah = [] @endphp
                        @foreach($e->spek_form->spek_sub_forms as $ess)
                            @php
                            array_push($jumlah, App\Models\FormValue::where('value',$ess->option)->count())
                            @endphp
                        @endforeach
                            <div id="kt_amcharts_{{ $e->spek_form->pertanyaan }}" style="height: 500px;"></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                am4core.useTheme(am4themes_animated);
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->pertanyaan }}', am4charts.XYChart)
                                chart.colors.step = 2;

                                chart.legend = new am4charts.Legend()
                                chart.legend.position = 'top'
                                chart.legend.paddingBottom = 20
                                chart.legend.labels.template.maxWidth = 95

                                var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
                                xAxis.dataFields.category = 'category'
                                xAxis.renderer.cellStartLocation = 0.1
                                xAxis.renderer.cellEndLocation = 0.9
                                xAxis.renderer.grid.template.location = 0;

                                var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                yAxis.min = 0;

                                function createSeries(value, name) {
                                    var series = chart.series.push(new am4charts.ColumnSeries())
                                    series.dataFields.valueY = value
                                    series.dataFields.categoryX = 'category'
                                    series.name = name

                                    series.events.on('hidden', arrangeColumns);
                                    series.events.on('shown', arrangeColumns);

                                    var bullet = series.bullets.push(new am4charts.LabelBullet())
                                    bullet.interactionsEnabled = false
                                    bullet.dy = 30;
                                    bullet.label.text = '{valueY}'
                                    bullet.label.fill = am4core.color('#ffffff')

                                    return series;
                                }

                                chart.data = [
                                    @php $i=0 @endphp
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!! 
                                            "{".
                                                "category: '".$ess->option."',
                                                first: ".$jumlah[$i++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                ]


                                createSeries('first', '{{ $e->spek_form->pertanyaan }}');


                                function arrangeColumns() {

                                    var series = chart.series.getIndex(0);

                                    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                                    if (series.dataItems.length > 1) {
                                        var x0 = xAxis.getX(series.dataItems.getIndex(0), 'categoryX');
                                        var x1 = xAxis.getX(series.dataItems.getIndex(1), 'categoryX');
                                        var delta = ((x1 - x0) / chart.series.length) * w;
                                        if (am4core.isNumber(delta)) {
                                            var middle = chart.series.length / 2;

                                            var newIndex = 0;
                                            chart.series.each(function (series) {
                                                if (!series.isHidden && !series.isHiding) {
                                                    series.dummyData = newIndex;
                                                    newIndex++;
                                                }
                                                else {
                                                    series.dummyData = chart.series.indexOf(series);
                                                }
                                            })
                                            var visibleCount = newIndex;
                                            var newMiddle = visibleCount / 2;

                                            chart.series.each(function (series) {
                                                var trueIndex = chart.series.indexOf(series);
                                                var newIndex = series.dummyData;

                                                var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                                series.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                                series.bulletsContainer.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                            })
                                        }
                                    }
                                }

                                });
                                </script>
            @elseif($e->spek_form->type == "checkbox" && $e->spek_form->data == "text")
                    @php $i=1 @endphp
                    @foreach($e->spek_form->spek_sub_forms as $ess)
                        <?php
                            $form_value = App\Models\FormValue::where('spek_form_id', $e->spek_form->id)->get();
                            $temp = 0;
                            if($i == 1){
                                $jumlah = array();
                            }
                            
                        ?>
                        
                            @foreach($form_value as $fv)
                                @php
                                    $array = json_decode($fv->value)
                                @endphp
                                @foreach ($array as $a)
                                    
                                    @if($a == $ess->option)
                                        @php
                                        $temp++
                                            
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                        <?php
                        array_push($jumlah, $temp);
                        $i++;
                        ?>
                    @endforeach
                            <div id="kt_amcharts_{{ $e->spek_form->pertanyaan }}" style="height: 500px;"></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                am4core.useTheme(am4themes_animated);
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->pertanyaan }}', am4charts.XYChart)
                                chart.colors.step = 2;

                                chart.legend = new am4charts.Legend()
                                chart.legend.position = 'top'
                                chart.legend.paddingBottom = 20
                                chart.legend.labels.template.maxWidth = 95

                                var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
                                xAxis.dataFields.category = 'category'
                                xAxis.renderer.cellStartLocation = 0.1
                                xAxis.renderer.cellEndLocation = 0.9
                                xAxis.renderer.grid.template.location = 0;

                                var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                yAxis.min = 0;

                                function createSeries(value, name) {
                                    var series = chart.series.push(new am4charts.ColumnSeries())
                                    series.dataFields.valueY = value
                                    series.dataFields.categoryX = 'category'
                                    series.name = name

                                    series.events.on('hidden', arrangeColumns);
                                    series.events.on('shown', arrangeColumns);

                                    var bullet = series.bullets.push(new am4charts.LabelBullet())
                                    bullet.interactionsEnabled = false
                                    bullet.dy = 30;
                                    bullet.label.text = '{valueY}'
                                    bullet.label.fill = am4core.color('#ffffff')

                                    return series;
                                }

                                chart.data = [
                                    <?php $ii=0; ?>
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!!   
                                            "{".
                                                "category: '".$ess->option."',
                                                first: ".$jumlah[$ii++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                ]


                                createSeries('first', '{{ $e->spek_form->pertanyaan }}');


                                function arrangeColumns() {

                                    var series = chart.series.getIndex(0);

                                    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                                    if (series.dataItems.length > 1) {
                                        var x0 = xAxis.getX(series.dataItems.getIndex(0), 'categoryX');
                                        var x1 = xAxis.getX(series.dataItems.getIndex(1), 'categoryX');
                                        var delta = ((x1 - x0) / chart.series.length) * w;
                                        if (am4core.isNumber(delta)) {
                                            var middle = chart.series.length / 2;

                                            var newIndex = 0;
                                            chart.series.each(function (series) {
                                                if (!series.isHidden && !series.isHiding) {
                                                    series.dummyData = newIndex;
                                                    newIndex++;
                                                }
                                                else {
                                                    series.dummyData = chart.series.indexOf(series);
                                                }
                                            })
                                            var visibleCount = newIndex;
                                            var newMiddle = visibleCount / 2;

                                            chart.series.each(function (series) {
                                                var trueIndex = chart.series.indexOf(series);
                                                var newIndex = series.dummyData;

                                                var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                                series.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                                series.bulletsContainer.animate({ property: 'dx', to: dx }, series.interpolationDuration, series.interpolationEasing);
                                            })
                                        }
                                    }
                                }

                                });
                                </script>

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

