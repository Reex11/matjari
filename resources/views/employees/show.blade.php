@extends('layouts.simple')

@section('title','| معلومات: '.$employee->name)

@section('page-title','الموظفون | '.$employee->name)

@section('page-nav')
	<a class="btn btn-outline-info inline-btn btn-sm" href="/employees/{{$employee->id}}/edit"><i class="fas fa-pencil-alt ml-2"></i>تعديل </a>
	{{-- <a class="btn btn-outline-info inline-btn btn-sm" href="/salaries/employee/{{$employee->id}}"><i class="fas fa-file-invoice-dollar ml-2"></i>الرواتب</a> --}}
@endsection

@section('content')

<div class="row justify-content-md-center">
	<div class="col-xl-6 col-lg-6 ">
		<table class="table-borderless mb-3" width="100%">
			<tr class="row">
				<td class="font-weight-bold text-left col-sm-4">الاسم</td>
				<td class="col-sm-8"><input class="form-control disabled" value="{{ $employee->name }}" disabled> </td>
			</tr>
			<tr class="row">
				<td class="font-weight-bold text-left col-sm-4">رقم الجوال</td>
				<td class="col-sm-8"><input class="form-control disabled" value="{{ $employee->phone }}" disabled> </td>
			</tr>
			<tr class="row">
				<td class="font-weight-bold text-left col-sm-4">كاشير ؟</td>
				<td class="col-sm-8 h4"> @if ($employee->isCashier) <span class="badge badge-primary">كاشير</span> @else <span class="badge badge-secondary">ليس كاشير</span> @endif </td>
			</tr>
			<tr class="row">
				<td class="font-weight-bold text-left col-sm-4">الراتب الشهري</td>
				<td class="col-sm-8"><input class="form-control disabled" value="{{ $employee->constantSalary }}" disabled> </td>
			</tr>
			
		</table>

	</div>
	
{{-- 	<div class="col-sm-12 text-center mt-5"> <p class="lead">المزيد من المعلومات قريبا ...</p> </div> --}}
</div>




@endsection

@section('custom-js')

	$("#cSalary").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});

@endsection