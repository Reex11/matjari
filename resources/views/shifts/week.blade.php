@extends('layouts.simple')

@section('title','| جدول الأسبوع')

@section('page-title','جدول الأسبوع  '.$weeknum)

@section('page-nav')
	<a class="btn btn-outline-info inline-btn " href="#" disabled>إضافة أسبوع</a>
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

{{-- 

@foreach ($periods as $period)
			

			@if ($pos == 1)
			
			@endif

			@foreach ($shifts->where('day',$daynum)->where('period',$period) as $shift)
			@if ($shift->day == $day && )
			<td>
				@if ($shift->employee == NULL)
				لا يوجد
				@else
				{{ $employees->where('id',$shift->employee)->first()->name }}
				@endif
				 - {{ $shift->value }}
			</td>
			@endforeach
			
		@endforeach --}}


{{-- 
	@foreach ($employees as $employee)
		<tr>
			<td>{{ $employee->id }}</td>
			<td width="40%">{{ $employee->name }}</td>
			<td>{{ $employee->phone }} @empty($employee->phone) - @endempty</td>
			<td>{{ $employee->isCashier }}</td>
			<td><a class="btn btn-sm btn-outline-dark" href="/employee/view/{{$employee->id}}">عرض</a> <a class="btn btn-sm btn-outline-dark" href="/employee/edit/{{$employee->id}}">تعديل المعلومات</a></td>
		</tr>
	@endforeach --}}


</table>

@endsection