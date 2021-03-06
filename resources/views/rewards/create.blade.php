@extends('layouts.simple')

@section('title','تسجيل مكافأة أو خصم')

@section('page-title','تسجيل مكافأة أو خصم')

@section('content')

<div class="row justify-content-md-center">
	<form class="form col-xl-6 col-lg-8" method="POST" action="/rewards">
		@csrf
		<div class="row">
			<div class="form-group col-md-6" >
				<label for="employee">اسم الموظف *</label>
				
				<select class="custom-select" name="employee">
				<option value="none">اختر موظفاً</option>
					{{-- Listing Cashiers --}}
					@foreach ($employees as $employee)
				  		<option value="{{$employee->id}}">{{$employee->name}}</option>
				  	@endforeach
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="employee">نوع العملية *</label>
				<div class="col btn-group btn-group-toggle" dir="ltr">
					<label class="btn btn-outline-danger col isDeductRadio" for="isDeduction2">
					  <input autocomplete="off" type="radio" name="isDeduct" id="isDeduction2" value="1">
					  
					    خصم
					</label>
					<label class="btn btn-outline-success col isDeductRadio " for="isDeduction1">
					  <input autocomplete="off" type="radio" name="isDeduct" id="isDeduction1" value="0" checked>
					  
					    مكافأة
					</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label id="reason" for="title">سبب المكافأة *</label>
				<input class="form-control" type="text" name="title"  id="title" placeholder="مثال:تقفيل الحسابات " required>
				<small id="emailHelp" class="form-text text-danger"></small>
			</div>

			<div class="form-group col">	
				<label for="amount">القيمة *</label>
				<input class="form-control" type="number" name="amount" id="amount" placeholder="0.00" required>
			</div>
		</div>



		<div class="form-group">	
			<label for="description">ملاحظة</label>
			<input class="form-control" type="text" name="description" id="description" placeholder="">
		</div>

		<div class="form-group">
			<label id="reason" for="title">التاريخ *</label>
			<a class="btn btn-outline-info btn-sm" tabindex onclick="$('#datepicker').data('DateTimePicker').date('{{ date("Y-m-d") }}')">إنتقل إلى تاريخ اليوم</a>
            <div class='input-group' id='datepicker'>
                <input type="hidden" name="date" class="form-control" value="{{ date("Y-m-d") }}">
            </div>
		</div>
		

		<input class="btn btn-outline-danger btn-block mt-4 " id="submit" type="submit" value="إختر نوع العملية" disabled>

	</form>
</div>


@endsection

@section('custom-js')
	var counter = 1;
	$("#amount").change(function () {
		this.value = parseFloat(this.value).toFixed(2)
	});

	$(".isDeductRadio").click(function(){
        var radioValue = $("input[name='isDeduct']:checked").val();
        if(radioValue){
            console.log(counter+" "+radioValue);
            counter = counter + 1;
        }

        if(radioValue == 0) {
        	$("#submit").removeAttr('disabled');
        	$("#submit").removeClass('btn-outline-danger');
        	$("#submit").addClass('btn-outline-success');
        	$("#reason").text("سبب المكافأة *");
        	$("#submit").val("إضافة المكافأة");
    	} else {
    		$("#submit").removeAttr('disabled');
    		$("#submit").removeClass('btn-outline-success');
    		$("#submit").addClass('btn-outline-danger');
    		$("#reason").text("سبب الخصم *");
    		$("#submit").val("إضافة الخصم");
    	}

        $("input[name='isDeduct']").each(function(){
        	if ( $(this).prop("checked") ) {
        			$(this).parent().addClass("active");
        	
        	} else {
	        		$(this).parent().removeClass("active");
        	}
    	});
    });

    $(function () {
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'ar-kw',
        	inline:true

    	});
    });


@endsection