@extends('layouts.simple')

@section('title','| الموظفين')

@section('page-title','الموظفين')

@section('page-nav')
	<a class="btn btn-outline-info inline-btn" href="/employees/create">موظف جديد</a>
	<a class="btn btn-outline-info inline-btn" href="/employee/rewards">المكافئات والخصم</a>
@endsection

@section('content')


<table class="table" style="min-width: 80%; margin-left:auto; margin-right:auto;">
	<thead>
		<tr style="text-align: right;">
			<th>#</th>
			<th>اسم الموظف</th>
			<th>رقم الجوال</th>
			<th>كاشير؟</th>
			<th>إجراءات</th>
		</tr>
	</thead>
	@foreach ($employees as $employee)
		<tr>
			<td>{{ $employee->id }}</td>
			<td width="40%">{{ $employee->name }}</td>
			<td>{{ $employee->phone }} @empty($employee->phone) - @endempty</td>
			<td>
				@if ($employee->isCashier) <span class="badge badge-pill badge-primary">كاشير</span> 
				@else <span class="badge badge-pill badge-secondary">ليس كاشير</span>
				@endif
			</td>
			<td><a class="btn btn-sm btn-outline-dark" href="/employee/view/{{$employee->id}}">عرض</a> <a class="btn btn-sm btn-outline-dark" href="/employee/edit/{{$employee->id}}">تعديل المعلومات</a></td>
		</tr>
	@endforeach


</table>


@endsection