@extends('layouts.simple')

@section('title','تسجيل مكافأة أو خصم')

@section('page-title','تسجيل مكافأة أو خصم')

@section('content')

<div class="row justify-content-md-center">
	<form class="form col-xl-3 col-lg-4" method="POST" action="/employees">
		{{ csrf_field() }}
		<div class="form-group ">
			<label for="employeename">اسم الموظف</label>
			
			<select class="custom-select" name="employee">
			<option value="none">اختر موظفاً</option>
				{{-- Listing Cashiers --}}
				@foreach ($employees as $employee)
			  		<option value="{{$employee->id}}">{{$employee->name}}</option>
			  	@endforeach
			</select>
		</div>

		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="isDeduction" id="isDeduction1" value="reward" checked>
		  <label class="form-check-label" for="isDeduction1">
		    مكافأة
		  </label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="isDeduction" id="isDeduction2" value="deduction">
		  <label class="form-check-label" for="exampleRadios2">
		    خصم
		  </label>
		</div>

		<div class="form-group">	
			<label for="amount">القيمة</label>
			<input class="form-control" type="number" name="amount" id="amount" placeholder="50.00">
		</div>
		<div class="form-group">
			<label for="title">البيان</label>
			<input class="form-control" type="text" name="title"  id="title" placeholder="البيان">
			<small id="emailHelp" class="form-text text-muted">يجب التعريف بالمكافاة أو الخصم</small>
		</div>
		<div class="form-group">	
			<label for="description">ملاحظة</label>
			<input class="form-control" type="text" name="description" id="description" placeholder="ملاحظاة">
		</div>

		<input class="btn btn-outline-success btn-block mt-4" type="submit" value="إضافة">

	</form>
</div>


@endsection

@section('custom-js')

	$("#cSalary").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});

@endsection