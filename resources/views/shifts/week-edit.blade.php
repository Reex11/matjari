@extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title',' تعديل جدول الأسبوع  '.$weeknum.' - '.$year)

@section('page-nav')
	<a class="btn font-weight-bold btn-success inline-btn " href="/shifts/{{$year}}/{{$weeknum}}" >تطبيق التعديلات</a>
	<a class="btn font-weight-bold btn-outline-danger inline-btn " href="/shifts/{{$year}}/{{$weeknum}}" >إلغاء </a>
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

@if(count($shifts) < 7)
	<div class="alert alert-warning" role="alert">
	  لا توجد قيم لهذا الأسبوع
	</div>
@else
<form class="form-inline">
	<table class="table table-bordered week-table" style="min-width: 80%; margin-left:auto; margin-right:auto; font-size:20px;">
		<thead class="thead-dark">
			<tr style="text-align: right;">
				<th></th>
				<th class="text-center thick-border-left" >الصباح</th>
				<th class="text-center thick-border-left" >المساء</th>
				<th class="text-center thick-border-left" >الليل</th>
			</tr>
		</thead>

	@foreach ($days as $daynum => $day)
		<tr class="@if($daynum == (date("w")+1))table-success @endif">
			<td class="week-day thick-border-left text-center">{{ $day }}</td>

			@foreach ($shifts->where('day',$daynum) as $shift)
				
				@if ($shift->pos == 1) <td class=""><div class="row"> 	@endif
				
					@if ($shift->employee == null && $daynum != (date("w")+1) )
					<div class="col-sm table-pos-{{$shift->pos}}" style="background-color:#f0f0f0">
					@else
					<div class="col-sm table-pos-{{$shift->pos}}">
					@endif

						
						<div class="from-group">
								<span class="badge badge-info text-center mb-1">{{$shift->pos}}</span>
								

								<select class="custom-select custom-select-sm col-sm-12">
										<option value="none" 
										@if ($shift->employee == NULL)
										 selected
										@else
										>لا يوجد</option>
									@foreach ($employees as $employee)
								  		<option value="{{$employee->id}}" 
									  		
									  		@if($shift->employee == $employee->id)
									  		selected
									  		@endif

									  		>{{$employee->name}}
								  		</option>
								  	@endforeach
								</select>

									<input class="form-control form-control-sm col-sm-12" style="max-width: 60px;" id="shift-value-{{$shift->id}}" type="text" placeholder="قيمة الوردية" value="{{$shift->value}}">		

								@endif
						</div>
					</div>
				@if ($shift->pos == count($poss)) </div></td> @endif

			@endforeach

		</tr>
	@endforeach

@endif

	</table>
</form>

@endsection