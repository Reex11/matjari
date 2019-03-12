@extends('layouts.simple')

@section('title','| المكافآت والخصم')

@section('page-title','المكافآت والخصم')

@section('page-nav')
<a class="btn btn-outline-info inline-btn" href="/rewards/create">جديد</a>
@endsection

@section('content')


<table class="table table-hover" style="min-width: 80%; max-width: 700px; margin-left:auto; margin-right:auto;">

	<thead>
		<tr style="text-align: right;">
			<th>اسم الموظف</th>
			<th width="10%">العملية</th>
			<th class="text-center" width="10%">القيمة</th>
			<th>السبب</th>
			<th>التاريخ</th>
			<th >إجراءات</th>
		</tr>
	</thead>
	@foreach ($rewards as $reward)
		<?php $date = strtotime($reward->date); ?>
		<tr>
			<td class="font-weight-bold">{{ $employees->find($reward->employee)->name }}</td>
			<td>
				@if ($reward->isDeduct) <span class="h5"><span class=" badge badge-pill badge-danger">خصم</span> </span>
				@else <span class="h5"><span class="badge badge-pill badge-success">مكافأة</span></span>
				@endif
			</td>
			@if ($reward->isDeduct)<td class="h4 text-danger text-center" dir="ltr">
			@else<td class="h4 text-success text-center" dir="ltr">
			@endif
			{{ $reward->amount }}</td>
			<td>{{ $reward->title }}</td>
			<td>{{ $reward->date }} - أسبوع  {{ date("w",$date)==0 ? date("W",$date)+1 : date("W",$date) }}</td>
			<td style="width: 200px">
				<a class="btn btn btn-outline-info tooltipbtn" href="/rewards/{{$reward->id}}/edit" data-toggle="tooltip" data-placement="top" title="تعديل"><i class="fas fa-pen"></i></a>
				<form class="my-0" action="{{ route('rewards.destroy', ['id' => $reward->id]) }}" method="POST" style="display: inline-block;">
					<button class="btn btn btn-outline-danger tooltipbtn" data-toggle="tooltip" data-placement="top" title="حذف"><i class="far fa-trash-alt"></i></button>
						@csrf
						@method('DELETE')
				</form>
			</td>
		</tr>
	@endforeach

</table>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<span class="text-danger">تنبيه!! </span>
      	لا ينصح بحذف أي من المكافآت والخصم حتى في حال انتهاء خدم أو رحيلهم ، لأن ذلك سيؤدي إلى حذف جميع البيانات المرتبطة مثل الرواتب والمكافئات وهذا سيؤثر على صحة المعلومات الخاصة بمتجرك .. يمكنك إخفاء الموظف عبر الذهاب إلى صفحة تعديل معلومات الموظف.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">حسنًا</button>
        <a type="btn btn-warning" class="btn btn-primary" id="rewardEditButton">أريد إخفاء <span id="modalrewardName"></span></a>
      </div>
    </div>
  </div>
</div>


@endsection

@section ("custom-js")
	$('#deleteModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var name = button.data('rewardname')
	  var id = button.data('rewardid')
	  
	  var modal = $(this)
	  modal.find('#modalrewardName').text(name)
	  modal.find('#rewardEditButton').attr("href","/rewards/"+id+"/edit")
	})

	$('.tooltipbtn').tooltip({delay: { "show": 500 }});
@endsection