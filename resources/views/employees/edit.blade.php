@extends('layouts.simple')

@section('title','| تعديل معلومات:'.$employee->name)

@section('page-title',' تعديل معلومات:'.$employee->name)

@section('content')

<div class="row justify-content-md-center">
	<form class="form col-xl-3 col-lg-4" method="POST" action="/employees/{{ $employee->id }}">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		<div class="form-group ">
			<label for="employeename">اسم الموظف</label>
			<input class="form-control" type="text" name="employeename" id="employeename" placeholder="اسم الموظف" value="{{ $employee->name }}">
		</div>
		<div class="form-group ">
			<label for="phone">رقم الجوال</label>
			<input class="form-control" type="text" name="phone"  id="phone" placeholder="رقم الجوال" value="{{ $employee->phone }}">
			<small id="emailHelp" class="form-text text-muted">يستخدم لغرض التنبيه لوقت الدوام في حال تفعيل ذلك، وللرجوع للرقم في حال الحاجة إليه من قبل الإدارة</small>
		</div>
		<div class="form-group ">	
			<label for="cSalary">الراتب الثابت</label>
			<input class="form-control" type="number" name="cSalary" id="cSalary" placeholder="الراتب الثابت" value="{{ $employee->constantSalary }}">
		</div>
		<div class="form-check form-check-switch form-check-primary">
			<span class="switch">
			  	<input type="checkbox" class="switch" name="isCashier" id="isCashier" @if ($employee->isCashier) checked @endif>
				<label for="isCashier">كاشير ؟</label>
			</span>
		</div>

		<input class="btn btn-outline-success btn-block mt-4" type="submit" value="تحديث">

	</form>
</div>


@endsection

@section('custom-js')

	$("#cSalary").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});

@endsection