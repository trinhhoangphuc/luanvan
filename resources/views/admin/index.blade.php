@extends('layouts.admin.master')

@section('title')
    Quản trị Redshop.vn
@endsection

@section('trangchu')
    active
@endsection

@section('noidung')

<script src="{{asset('public/libs/zingchart.min.js')}}"></script>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>

                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chart-box">
                    <p class="title-chart">Thống kê năm 2018</p>
                    <div id="myChart"></div>
                </div>
            </div>
        </div>

    </section>

</div>

<script >
 $(document).ready(function(){
     var myChart = {
      "type": "bar",
		// "title": {
		// 	"text": "Change me please!"
		// },
		"plot": {
			"value-box": {
				"text": "%v"
			},
			"tooltip": {
				"text": "%v"
			}
		},
		"legend": {
			"toggle-action": "hide",
			"header": {
				"text": "Legend Header"
			},
			"item": {
				"cursor": "pointer"
			},
			"draggable": true,
			"drag-handler": "icon"
		},
		"scale-x": {
			"values": [
			"Mon",
			"Wed",
			"Fri"
			]
		},
		"series": [
		{
			"values": [
			3,
			6,
			9
			],
			"text": "apples",
			"palette": 0,
		},
		{
			"values": [
			1,
			4,
			3
			],
			"text": "oranges",
			"palette": 1
		}
		]
	};
	zingchart.render({
		id: "myChart",
		data: myChart,
		height: "480",
		width: "100%"
	});
});
</script>
@endsection