@extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title','جدول  '.$table->name.' '.$weeknum.'-'.$year)

@section('page-nav')
	<a class="btn btn-outline-info inline-btn btn-sm" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum}}/edit" ><i class="fas fa-pencil-alt ml-2"></i>تعديل الأسبوع</a>
	<a class="btn btn-outline-info inline-btn btn-sm" href="/shifts/create/{{$table->id}}"><i class="fas fa-plus ml-2"></i>إضافة أسبوع</a>
@endsection

@section('left-page-nav')
	<a class="btn btn-outline-info inline-btn btn-sm" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum-1}}"> <i class="fas fa-chevron-right"></i>  السابق</a>
	<a class="btn btn-outline-info inline-btn btn-sm" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum+1}}">التالي <i class="fas fa-chevron-left"></i> </a>
	
	<div class="dropdown btn inline-btn">
		<button class="btn btn-outline-info inline-btn btn-sm dropdown-toggle" type="button" id="weeks-nav" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  أكثر ..
		</button>	
		<div class="dropdown-menu" aria-labelledby="weeks-nav">
			<a class="dropdown-item" href="/shifts/{{$table->id}}">الأسبوع الحالي</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">الأسابيع السابقة</a>
			<a class="dropdown-item" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum-3}}">الأسبوع {{$weeknum-3}}</a>
	    	<a class="dropdown-item" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum-2}}">الأسبوع {{$weeknum-2}}</a>
	    	<a class="dropdown-item" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum-1}}">الأسبوع {{$weeknum-1}}</a>
	    	<div class="dropdown-divider"></div>
	    	<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">الأسابيع التالية</a>
	    	<a class="dropdown-item" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum+1}}">الأسبوع {{$weeknum+1}}</a>
	    	<a class="dropdown-item" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum+2}}">الأسبوع {{$weeknum+2}}</a>
	    	<a class="dropdown-item" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum+3}}">الأسبوع {{$weeknum+3}}</a>
	  	</div>

	</div>
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
		  لا توجد قيم لهذا الأسبوع | <a href="/shifts/create/{{ $table->id }}/{{ $year }}/{{ $weeknum }}">إنشاء هذا الأسبوع</a>
		</div>
	@else
<div class="table-responsive">
	<table class="table table-bordered thick-border week-table d-print-block" style="min-width: 80%; margin-left:auto; margin-right:auto;">
			<thead class="thead-dark">
				<tr style="text-align: right;">
					<th></th>
					@foreach ($shifts->unique('period') as $period)
					<th class="text-center thick-border-left" colspan="{{$shifts->where('period',$period->period)->max('pos')}}">الفترة  {{$period->period}}</th>
					@endforeach
				</tr>
			</thead>



		@foreach ($days as $daynum => $day)
			<tr class="@if($daynum == (date("w")+1))table-success @endif">
				<td class="week-day thick-border-left text-center">{{ $day['name'] }}<br><small style="font-size: 16px;">{{ $day['date'] }}</small></td>

				@foreach ($shifts->where('day',$daynum) as $shift)
					@if ($shift->employee == null && $daynum != (date("w")+1) )
					<td class="table-pos-{{$shift->pos}} text-center" style="background-color:#f0f0f0">
					@else
					<td class="table-pos-{{$shift->pos}} text-center">
					@endif
						@if ($shift->employee == NULL)
						لا يوجد
						@else
						<div class="col-sm-12"> 
						{{ $shift->employee->name }}
						</div>
						<div class="col-sm-12">
						{{ $shift->value }}
						</div>
						@endif
					</td>

				@endforeach


			</tr>
		@endforeach

	@endif

	</table>

</div>

@endsection