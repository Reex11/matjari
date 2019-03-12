@extends('layouts.simple')

@section('title','تعديل مكافأة أو خصم')

@section('page-title','تعديل مكافأة أو خصم')

@section('content')

<div class="row justify-content-md-center">
	<form class="form col-xl-6 col-lg-8" method="POST" action="/rewards/{{ $reward->id }}">
		@csrf
		@method('PATCH')
		<div class="row">
			<div class="form-group col" >
				<label for="employee">اسم الموظف *</label>
				
				<select class="custom-select" name="employee">
				<option value="none">اختر موظفاً</option>
					{{-- Listing Cashiers --}}
					@foreach ($employees as $employee)
				  		<option value="{{$employee->id}}" @if($reward->employee == $employee->id) selected @endif>{{$employee->name}}</option>
				  	@endforeach
				</select>
			</div>

			<div class="form-group col">
				<label>نوع العملية:*</label>
				<div class="col btn-group btn-group-toggle" dir="ltr">
					<label class="btn btn-outline-danger col isDeductRadio @if($reward->isDeduct) active @endif" for="isDeduction2">
					  <input autocomplete="off" type="radio" name="isDeduct" id="isDeduction2" value="1" @if($reward->isDeduct) checked @endif>
					  
					    خصم
					</label>
					<label class="btn btn-outline-success col isDeductRadio @if(!$reward->isDeduct) active @endif" for="isDeduction1">
					  <input autocomplete="off" type="radio" name="isDeduct" id="isDeduction1" value="0" @if(!$reward->isDeduct) checked @endif>
					  
					    مكافأة
					</label>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="form-group col">
				<label id="reason" for="title">سبب @if($reward->isDeduct) الخصم @else المكافأه @endif*</label>
				<input class="form-control" type="text" name="title" id="title" placeholder="مثال:تقفيل الحسابات " value="{{$reward->title}}">
				<small id="emailHelp" class="form-text text-danger"></small>
			</div>

			<div class="form-group col">	
				<label for="amount">القيمة *</label>
				<input class="form-control" type="number" name="amount" id="amount" placeholder="0.00" value="{{$reward->amount}}">
			</div>
		</div>



		<div class="form-group">	
			<label for="description">ملاحظة</label>
			<input class="form-control" type="text" name="description" id="description" placeholder="" value="{{$reward->description}}">
		</div>

		<div class="form-group">
			<label id="reason" for="title">التاريخ *</label>
			<a class="btn btn-outline-info btn-sm" tabindex onclick="$('#datepicker').data('DateTimePicker').date('{{ date("Y-m-d") }}')">انتقل إلى تاريخ اليوم</a>
            <div class='input-group' id='datepicker'>
                <input type="hidden" name="date" class="form-control" value="{{ $reward->date }}">
            </div>
		</div>
		

		<input class="btn btn-warning btn-block mt-4 " id="submit" type="submit" value="تعديل العملية" >

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