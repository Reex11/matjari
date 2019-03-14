 @extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title',' تعديل جدول  '.$table->name.' '.$weeknum.' - '.$year)

@section('page-nav')
	<form class="form-inline table-responsive-lg" method="POST" action="/shifts/{{$table->id}}/{{$year}}/{{ $weeknum }}">
	@csrf
	@method('PATCH')
	<input type="hidden" name="year" value="{{$year}}">
	<input type="hidden" name="weeknum" value="{{$weeknum}}">
	<input type="hidden" name="table" value="{{$table->id}}">
	<input type="submit" class="btn font-weight-bold btn-outline-success inline-btn ml-2  btn-sm" value="تطبيق التعديلات" >
	<a class="btn font-weight-bold btn-outline-danger inline-btn btn-sm" href="/shifts/{{$table->id}}/{{$year}}/{{$weeknum}}" >إلغاء </a>
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
	<div class="table-responsive">
		<table class="table table-bordered thick-border week-table d-print-block" style="min-width:700px;margin-left:auto; margin-right:auto; font-size:20px;">
			<thead class="thead-dark">
				<tr style="text-align: right;">
					<th></th>
					@foreach ($shifts->unique('period') as $period)
					<th class="text-center thick-border-left">الفترة  {{$period->period}}</th>
					@endforeach
				</tr>
			</thead>

		@foreach ($days as $daynum => $day)
			<tr>
				<td class="week-day thick-border-left text-center">{{ $day['name'] }}<br><small style="font-size: 16px;">{{ $day['date'] }}</small></td>

				@foreach ($shifts->where('day',$daynum) as $shift)
					
					@if ($shift->pos == 1) <td class=""><div class="row">@endif
						
						{{-- STARTING SHIFT DIV --}}

						<div class="col-lg table-pos-{{$shift->pos}}">
							
								<div class="form-row">
									<div class="from-group col-sm-2 mt-3">
							{{-- Point of sale no. --}}
										<h4><span class="badge badge-info text-center mt-1">{{$shift->pos}}</span></h4>
									</div>
									<div class="from-group col-sm-10">

							{{-- Cashiers List --}}
										<label for="employee-{{$shift->id}}" class="sr-only">الكاشير</label>
										<select class="custom-select custom-select-sm mb-2" name="employee-{{$shift->id}}" style="width:100%">
										{{-- Cashier Dropdown with check if NULL --}}
										<option value="none" 
										@if ($shift->employee == NULL)
										selected
										@endif
										>لا يوجد</option>
											{{-- Listing Cashiers --}}
											@foreach ($employees as $employee)
										  		<option value="{{$employee->id}}" 
											  		
											  		@if($shift->employee == $employee->id)
											  		selected
											  		@endif

											  		>{{$employee->name}}
										  		</option>
										  	@endforeach
										</select>
							{{-- Shift Value --}}
										<label for="shift-value-{{$shift->id}}" class="sr-only">قيمة الدورية</label>
										<input class="form-control form-control mb-1 shift-value" style="width:100%;" name="value-{{$shift->id}}" type="number" step="0.25" placeholder="قيمة الوردية" value="{{$shift->value}}">
								
									</div>
								</div>
									
						</div> {{-- ENDING SHIFT DIV --}}

					@if ($shift->pos == count($poss)) </div></td> @endif

				@endforeach

			</tr>
		@endforeach

	@endif

		</table>
	</div>
	</form>
</div>
@endsection

@section('custom-js')
	$(".shift-value").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});
@endsection