@extends('layouts.simple')

@section('title','| معلومات: '.$employee->name)

@section('page-title','الموظفون | '.$employee->name)

@section('content')

<div class="row justify-content-md-center">
	<table class="table-borderless  col-xl-3 col-lg-4">
		<tr>
			<td class="font-weight-bold">الاسم</td>
			<td> {{ $employee->name }} </td>
		</tr>
		<tr>
			<td class="font-weight-bold">رقم الجوال</td>
			<td> {{ $employee->phone }} </td>
		</tr>
		<tr>
			<td class="font-weight-bold">كاشير ؟</td>
			<td> @if ($employee->isCashier) <span class="badge badge-primary">كاشير</span> @else <span class="badge badge-secondary">ليس كاشير</span> @endif </td>
		</tr>
		<tr>
			<td class="font-weight-bold">الراتب الشهري</td>
			<td> {{ $employee->constantSalary }} </td>
		</tr>
		<tr>
			<td class="font-weight-bold">مجموع الشفتات للشهر الحالي</td>
			<td> {{ $employee->totalShifts }} </td>
		</tr>
	</table>
	<div class="col-sm-12 text-center mt-5"> <p class="lead">المزيد من المعلومات قريبا ...</p> </div>
</div>




@endsection

@section('custom-js')

	$("#cSalary").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});

@endsection