@extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title',' تعديل جدول الأسبوع  '.$weeknum.' - '.$year)

@section('page-nav')
	<form class="form-inline table-responsive-lg" method="POST" action="/shifts/{{$year}}/{{ $weeknum }}">
	@csrf
	@method('PATCH')
	<input type="hidden" name="year" value="{{$year}}">
	<input type="hidden" name="weeknum" value="{{$weeknum}}">
	<input type="submit" class="btn font-weight-bold btn-outline-success inline-btn ml-2  btn-sm" value="تطبيق التعديلات" >
	<a class="btn font-weight-bold btn-outline-danger inline-btn btn-sm" href="/shifts/{{$year}}/{{$weeknum}}" >إلغاء </a>
@endsection


<?php 
	$days = array ( 
		1 => "الأحد", 
		2 => "الأثنين", 
		3 => "الثلاثاء", 
		4 => "الإربعاء", 
		5 => "الخميس" ,
		6 => "الجمعة", 
		7 => "السبت"
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
		<table class="table table-bordered week-table" style="min-width:700px;margin-left:auto; margin-right:auto; font-size:20px;">
			<thead class="thead-dark">
				<tr style="text-align: right;">
					<th></th>
					<th class="text-center thick-border-left" >الصباح</th>
					<th class="text-center thick-border-left" >المساء</th>
					<th class="text-center thick-border-left" >الليل</th>
				</tr>
			</thead>

		@foreach ($days as $daynum => $day)
			<tr>
				<td class="week-day thick-border-left text-center">{{ $day }}</td>

				@foreach ($shifts->where('day',$daynum) as $shift)
					
					@if ($shift->pos == 1) <td class=""><div class="row">@endif
						
						{{-- STARTING SHIFT DIV --}}

						<div class="col-lg table-pos-{{$shift->pos}}">
							
								<div class="form-row">
									<div class="from-group col-sm-2 mt-3">
							{{-- Point of sale no. --}}
										<h4><span class="badge badge-info text-center mt-1">{{$shift->pos}}</span></h4>
									</div>
							{{-- Shift Value --}}
									<div class="from-group col-sm-10">
										<label for="shift-value-{{$shift->id}}" class="sr-only">قيمة الدورية</label>
										<input class="form-control form-control mb-1 shift-value" style="width:100%;" name="value-{{$shift->id}}" type="number" step="0.25" placeholder="قيمة الوردية" value="{{$shift->value}}">
								
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
									</div>
								</div>
									
						</div> {{-- ENDING SHIFT DIV --}}

					@if ($shift->pos == count($poss)) </div></td> @endif

				@endforeach

			</tr>
		@endforeach

	@endif

		</table>
	</form>
</div>
@endsection

@section('custom-js')
	$(".shift-value").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});
@endsection