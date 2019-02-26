@extends('layouts.simple')

@section('title','| إضافة موظف جديد')

@section('page-title','إضافة موظف جديد')

@section('content')

<div class="row justify-content-md-center">
<form class="form col-xl-3 col-lg-4" method="POST" action="/projects/create">
	
	<div class="form-group ">
		<label for="name">اسم الموظف</label>
		<input class="form-control" type="text" name="name" id="name" placeholder="اسم الموظف">
	</div>
	<div class="form-group ">
		<label for="phone">رقم الجوال</label>
		<input class="form-control" type="text" name="phone"  id="phone" placeholder="رقم الجوال">
		<small id="emailHelp" class="form-text text-muted">يستخدم لغرض التنبيه لوقت الدوام في حال تفعيل ذلك، وللرجوع للرقم في حال الحاجة إليه من قبل الإدارة</small>
	</div>
	<div class="form-group ">	
		<label for="cSalary">الراتب الثابت</label>
		<input class="form-control" type="text" name="cSalary" id="cSalary" placeholder="الراتب الثابت">
	</div>
	<div class="form-check form-check-switch form-check-primary">
		<label class="form-check-label" for="isCashier">كاشير ؟</label>
		<input class="form-check-input" type="checkbox" value="" name="isCashier" id="isCashier">
	</div>

	<div class="form-check form-check-switch form-check-secondary">
	  
	  <label class="form-check-label" for="defaultCheck2">
	    Secondary checkbox
	  </label>
	  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
	</div>

</form>


@endsection