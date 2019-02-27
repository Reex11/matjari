@extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title','جدول الأسبوع  '.$weeknum.' - '.$year)

@section('page-nav')
	<a class="btn btn-outline-info inline-btn " href="/shifts/{{$year}}/{{$weeknum}}/edit" ><i class="fas fa-pencil-alt ml-2"></i>تعديل الأسبوع</a>
	<a class="btn btn-outline-info inline-btn " href="/shifts/create" disabled><i class="fas fa-plus ml-2"></i>إضافة أسبوع</a>
@endsection


<?php 

	$week_start = new DateTime();
	$week_start->setISODate($year,$weeknum);
	$week_start = $week_start->modify('-1 day');

	$days = array ( 
		"1" => array (
			"name" => "الأحد",
			"date" => $week_start->format('Y-m-d')
		),
		"2" => array (
			"name" => "الأثنين",
			"date" => $week_start->modify('+1 day')->format('Y-m-d')
		),
		"3" => array (
			"name" => "الثلاثاء",
			"date" => $week_start->modify('+1 day')->format('Y-m-d')
		),
		"4" => array (
			"name" => "الإربعاء",
			"date" => $week_start->modify('+1 day')->format('Y-m-d')
		),
		"5" => array (
			"name" => "الخميس",
			"date" => $week_start->modify('+1 day')->format('Y-m-d')
		),
		"6" => array (
			"name" => "الجمعة",
			"date" => $week_start->modify('+1 day')->format('Y-m-d')
		),
		"7" => array (
			"name" => "السبت",
			"date" => $week_start->modify('+1 day')->format('Y-m-d')
		)

	);
	$poss = array ( 1,2 );
	$periods = array ( 1,2,3 );



?>



@section('content')
<div class="container-fluid">
	@if(count($shifts) < 7)
		<div class="alert alert-warning" role="alert">
		  لا توجد قيم لهذا الأسبوع
		</div>
	@else

		<table class="table table-bordered week-table d-print-block" style="min-width: 80%; margin-left:auto; margin-right:auto; font-size:20px;">
			<thead class="thead-dark">
				<tr style="text-align: right;">
					<th></th>
					<th class="text-center thick-border-left" colspan="2">الصباح</th>
					<th class="text-center thick-border-left" colspan="2">المساء</th>
					<th class="text-center thick-border-left" colspan="2">الليل</th>
				</tr>
			</thead>

		@foreach ($days as $daynum => $day)
			<tr class="@if($daynum == (date("w")+1))table-success @endif">
				<td class="week-day thick-border-left text-center">{{ $day['name'] }}@if($daynum == (date("w")+1))<br><small>{{ $day['date'] }}</small>@endif</td>

				@foreach ($shifts->where('day',$daynum) as $shift)
					@if ($shift->employee == null && $daynum != (date("w")+1) )
					<td class="table-pos-{{$shift->pos}}" style="background-color:#f0f0f0">
					@else
					<td class="table-pos-{{$shift->pos}}">
					@endif
						@if ($shift->employee == NULL)
						لا يوجد
						@else
						{{ $employees->where('id',$shift->employee)->first()->name }}
						@endif
					</td>

				@endforeach


			</tr>
		@endforeach

	@endif

	</table>
</td>
@endsection