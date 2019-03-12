@extends('layouts.simple')

@section('title','| معلومات: '.$employee->name)

@section('page-title','الموظفون | '.$employee->name)

@section('content')

<div class="row justify-content-md-center">
	<table class="table-borderless  col-xl-6 col-lg-6">
		<tr class="row">
			<td class="font-weight-bold text-left col-sm-6">الاسم</td>
			<td class="col-sm-6"> {{ $employee->name }} </td>
		</tr>
		<tr class="row">
			<td class="font-weight-bold text-left col-sm-6">رقم الجوال</td>
			<td class="col-sm-6"> {{ $employee->phone }} </td>
		</tr>
		<tr class="row">
			<td class="font-weight-bold text-left col-sm-6">كاشير ؟</td>
			<td class="col-sm-6"> @if ($employee->isCashier) <span class="badge badge-primary">كاشير</span> @else <span class="badge badge-secondary">ليس كاشير</span> @endif </td>
		</tr>
		<tr class="row">
			<td class="font-weight-bold text-left col-sm-6">الراتب الشهري</td>
			<td class="col-sm-6"> {{ $employee->constantSalary }} </td>
		</tr>


	</table>
{{-- 	<div class="col-sm-12 text-center mt-5"> <p class="lead">المزيد من المعلومات قريبا ...</p> </div>
 --}}</div>




@endsection

@section('custom-js')

	$("#cSalary").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});

@endsection