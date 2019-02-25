@extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title','جدول الأسبوع  '.$weeknum.' - '.$year)

@section('page-nav')
	<a class="btn btn-outline-info inline-btn " href="/shifts/{{$year}}/{{$weeknum}}/edit" ><i class="fas fa-pencil-alt ml-2"></i>تعديل الأسبوع</a>
	<a class="btn btn-outline-info inline-btn " href="#" disabled><i class="fas fa-plus ml-2"></i>إضافة أسبوع</a>
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

	<table class="table table-bordered week-table" style="min-width: 80%; margin-left:auto; margin-right:auto; font-size:20px;">
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
			<td class="week-day thick-border-left text-center">{{ $day }}</td>

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

@endsection