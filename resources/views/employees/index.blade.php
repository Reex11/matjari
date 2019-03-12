@extends('layouts.simple')

@section('title','| الموظفين')

@section('page-title','الموظفين')

@section('page-nav')
	<a class="btn btn-outline-info inline-btn" href="/employees/create">موظف جديد</a>
	<a class="btn btn-outline-info inline-btn" href="/rewards">المكافئات والخصم</a>
@endsection

@section('content')

<div class="table-responsive">
<table class="table" style="min-width: 600px; max-width: 700px; margin-left:auto; margin-right:auto;">

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
			<td width="30%">{{ $employee->name }}</td>
			<td>{{ $employee->phone }} @empty($employee->phone) - @endempty</td>
			<td>
				@if ($employee->isCashier) <span class="badge badge-pill badge-primary">كاشير</span> 
				@else <span class="badge badge-pill badge-secondary">ليس كاشير</span>
				@endif
			</td>
			<td>
				<a class="btn btn-sm btn-outline-dark" href="/employees/{{$employee->id}}">عرض</a>
				<a class="btn btn-sm btn-outline-dark" href="/employees/{{$employee->id}}/edit">تعديل </a>

			</td>
		</tr>
	@endforeach

</table>
</div>


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
      	لا ينصح بحذف أي من الموظفين حتى في حال انتهاء خدم أو رحيلهم ، لأن ذلك سيؤدي إلى حذف جميع البيانات المرتبطة مثل الرواتب والمكافئات وهذا سيؤثر على صحة المعلومات الخاصة بمتجرك .. يمكنك إخفاء الموظف عبر الذهاب إلى صفحة تعديل معلومات الموظف.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">حسنًا</button>
        <a type="btn btn-warning" class="btn btn-primary" id="employeeEditButton">أريد إخفاء <span id="modalEmployeeName"></span></a>
      </div>
    </div>
  </div>
</div>


@endsection

@section ("custom-js")
	$('#deleteModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var name = button.data('employeename')
	  var id = button.data('employeeid')
	  
	  var modal = $(this)
	  modal.find('#modalEmployeeName').text(name)
	  modal.find('#employeeEditButton').attr("href","/employees/"+id+"/edit")
	})
@endsection