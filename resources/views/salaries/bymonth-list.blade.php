@extends('layouts.simple')

@section('title',' رواتب شهر '.$month.' - '.$year)

@section('page-title',' رواتب شهر '.$month.' - '.$year)

@section('page-nav')
{{-- <a class="btn btn-outline-info inline-btn" href="/rewards/create">جديد</a> --}}
@endsection

<?php
$total['constantSalary'] = 0;
$total['totalShifts'] = 0;
$total['totalRewards'] = 0;
$total['totalDeducts'] = 0;
$total['total'] = 0;

?>


@section('content')


<div class="table-responsive">
<table class="table table-hover " style="min-width: 300; max-width: 800px; margin-left:auto; margin-right:auto;">

	<thead>
		<tr style="text-align: right;">
			<th>اسم الموظف</th>
			<th>الراتب الأساسي</th>
			<th>مجموع الورديات</th>
			<th>مجموع المكافآت</th>
			<th>مجموع الخصومات</th>
			<th>مجموع المستحقات</th>
		</tr>
	</thead>
	@foreach ($salaries as $salary)
		<tr>
			<td class="font-weight-bold">{{ $employees->find($salary->employee)->name }}</td>
			<td class="pr-4">{{ $salary->constantSalary }} ر.س</td>
			<td class="pr-4">{{ $salary->totalShifts }} ر.س</td>
			<td class="pr-4">{{ $salary->totalRewards }} ر.س</td>
			<td class="pr-4">{{ $salary->totalDeducts }} ر.س</td>
			<td class="pr-4 font-weight-bold">{{ $salary->total }} ر.س</td>
{{-- 			<td class=""><a href="/salaries/{{ $salary->id }}" class="btn btn btn-outline-info tooltipbtn" data-toggle="tooltip" data-placement="top" title="تفاصيل"><i class="far fa-file-alt"></i></i></a></td> --}}
			
		</tr>
		<?php
			$total['constantSalary'] += $salary->constantSalary;
			$total['totalShifts'] += $salary->totalShifts;
			$total['totalRewards'] += $salary->totalRewards;
			$total['totalDeducts'] += $salary->totalDeducts;
			$total['total'] += $salary->total;

			$total['constantSalary']  = sprintf("%.2f", $total['constantSalary']);
			$total['totalShifts']  = sprintf("%.2f", $total['totalShifts']);
			$total['totalRewards'] = sprintf("%.2f", $total['totalRewards']);
			$total['totalDeducts'] = sprintf("%.2f", $total['totalDeducts']);
			$total['total']        = sprintf("%.2f", $total['total']);
		?>
	@endforeach
		<tr class="table-secondary font-weight-bolder ">
			<td >المجموع</td>
			<td class="pr-4">{{ $total['constantSalary'] }} ر.س</td>
			<td class="pr-4">{{ $total['totalShifts'] }} ر.س</td>
			<td class="pr-4">{{ $total['totalRewards'] }} ر.س</td>
			<td class="pr-4">{{ $total['totalDeducts'] }} ر.س</td>
			<td class="pr-4">{{ $total['total'] }} ر.س</td>
		</tr>

</table>
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