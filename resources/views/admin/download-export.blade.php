<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="shortcut icon" href="{{ asset('media/logos/logo-dki.png') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</head>

<body onclick="window.print()">
<div class="container">
<div class="card">
    <label style="font-size: 22px; font-weight: 600" class="form-label mt-5 ms-5">Form Export</label>
    <p class="text-muted mb-4 mt-n1 ms-6">{{\Carbon\Carbon::now('Asia/Jakarta')}}</p>
    <div class="card-body">
        @foreach($export_form as $e)
            @if($e->spek_form->type == "text")
                <label style="font-size: 18px; font-weight: 500" class="form-label mb-4">{{ $e->spek_form->pertanyaan }}</label>
                <div class="table-responsive">

                
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
            </div>
            @elseif($e->spek_form->type == "number")
                <label style="font-size: 18px; font-weight: 500" class="form-label mb-4">{{ $e->spek_form->pertanyaan }}</label>
                <div class="table-responsive">

                
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
                        @endphp 
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
            </div>
            @elseif($e->spek_form->type == "radio" && $e->spek_form->data == "text")
                @php $jumlah = [] @endphp
                @foreach($e->spek_form->spek_sub_forms as $ess)
                    @php
                    array_push($jumlah, App\Models\FormValue::where('value',$ess->option)->count())
                    @endphp
                @endforeach
                <label style="font-size: 18px; font-weight: 500" class="form-label mb-4">{{ $e->spek_form->pertanyaan }}</label>

                            <div id="kt_amcharts_pie{{ $e->spek_form->pertanyaan }}" style="height: 280px;"></div>
                            <script>
                                am4core.ready(function () {
                                    // Themes begin
                                    //am4core.useTheme(am4themes_dataviz);
                                    // Themes end

                                    // Create chart
                                    chart = am4core.create('kt_amcharts_pie{{ $e->spek_form->pertanyaan }}', am4charts.PieChart);
                                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                                    chart.data = [
                                    @php $i=0 @endphp
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!! 
                                            "{".
                                                "country: '".$ess->option."',
                                                value: ".$jumlah[$i++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                    ];

                                    var series = chart.series.push(new am4charts.PieSeries());
                                    series.dataFields.value = 'value';
                                    series.dataFields.radiusValue = 'value';
                                    series.dataFields.category = 'country';
                                    series.slices.template.cornerRadius = 6;
                                    series.colors.step = 3;

                                    series.hiddenState.properties.endAngle = -90;

                                    chart.legend = new am4charts.Legend();

                                    }); // end am4core.ready()
                            </script>
        
                            <div id="kt_amcharts_{{ $e->spek_form->id }}" style="height: 280px;"></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->id }}', am4charts.XYChart)
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
                        <label style="font-size: 18px; font-weight: 500" class="form-label mb-4">{{ $e->spek_form->pertanyaan }}</label>
                            
                            <div id="kt_amcharts_pie{{ $e->spek_form->id }}" style="height: 280px;"></div>
                            <script>
                                am4core.ready(function () {
                                    // Themes begin
                                    //am4core.useTheme(am4themes_dataviz);
                                    // Themes end

                                    // Create chart
                                    chart = am4core.create('kt_amcharts_pie{{ $e->spek_form->id }}', am4charts.PieChart);
                                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                                    chart.data = [
                                    @php $ii=0 @endphp
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!! 
                                            "{".
                                                "country: '".$ess->option."',
                                                value: ".$jumlah[$ii++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                    ];

                                    var series = chart.series.push(new am4charts.PieSeries());
                                    series.dataFields.value = 'value';
                                    series.dataFields.radiusValue = 'value';
                                    series.dataFields.category = 'country';
                                    series.slices.template.cornerRadius = 6;
                                    series.colors.step = 3;

                                    series.hiddenState.properties.endAngle = -90;

                                    chart.legend = new am4charts.Legend();

                                    }); // end am4core.ready()
                            </script>


                            <div id="kt_amcharts_{{ $e->spek_form->id }}" style="height: 280px;"></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->id }}', am4charts.XYChart)
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
                    <label style="font-size: 18px; font-weight: 500" class="form-label mb-4">{{ $e->spek_form->pertanyaan }}</label>
                            <div id="kt_amcharts_pie{{ $e->spek_form->id }}" style="height: 280px;"></div>
                            <script>
                                am4core.ready(function () {
                                    // Themes begin
                                    //am4core.useTheme(am4themes_dataviz);
                                    // Themes end

                                    // Create chart
                                    chart = am4core.create('kt_amcharts_pie{{ $e->spek_form->id }}', am4charts.PieChart);
                                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                                    chart.data = [
                                    @php $ii=0 @endphp
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!! 
                                            "{".
                                                "country: '".$ess->option."',
                                                value: ".$jumlah[$ii++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                    ];

                                    var series = chart.series.push(new am4charts.PieSeries());
                                    series.dataFields.value = 'value';
                                    series.dataFields.radiusValue = 'value';
                                    series.dataFields.category = 'country';
                                    series.slices.template.cornerRadius = 6;
                                    series.colors.step = 3;

                                    series.hiddenState.properties.endAngle = -90;

                                    chart.legend = new am4charts.Legend();

                                    }); // end am4core.ready()
                            </script>
                    
                                <div id="kt_amcharts_{{ $e->spek_form->id }}" style="height: 280px;" ></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->id }}', am4charts.XYChart)
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
                         <div id="kt_amcharts_pie{{ $e->spek_form->id }}" style="height: 280px;"></div>
                            <script>
                                am4core.ready(function () {
                                    // Themes begin
                                    //am4core.useTheme(am4themes_dataviz);
                                    // Themes end

                                    // Create chart
                                    chart = am4core.create('kt_amcharts_pie{{ $e->spek_form->id }}', am4charts.PieChart);
                                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                                    chart.data = [
                                    @php $ii=0 @endphp
                                    @foreach($e->spek_form->spek_sub_forms as $ess) // putaran
                                        
                                        {!! 
                                            "{".
                                                "country: '".$ess->option."',
                                                value: ".$jumlah[$ii++].
                                            "},"
                                        !!}
                                        
                                    @endforeach
                                    ];

                                    var series = chart.series.push(new am4charts.PieSeries());
                                    series.dataFields.value = 'value';
                                    series.dataFields.radiusValue = 'value';
                                    series.dataFields.category = 'country';
                                    series.slices.template.cornerRadius = 6;
                                    series.colors.step = 3;

                                    series.hiddenState.properties.endAngle = -90;

                                    chart.legend = new am4charts.Legend();

                                    }); // end am4core.ready()
                            </script>


                            <div id="kt_amcharts_{{ $e->spek_form->id }}" style="height: 280px;"></div>
                                <script>
                                am4core.ready(function () {

                                // Themes begin
                                // Themes end

                                var chart = am4core.create('kt_amcharts_{{ $e->spek_form->id }}', am4charts.XYChart)
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
            @endif
        @endforeach
    </div>
</div>
</div>


    <!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
		
		<script src="{{ asset('js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('js/custom/widgets.js') }}"></script>
		
		<!--end::Page Custom Javascript-->
</body>

</html>