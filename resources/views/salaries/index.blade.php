@extends('layouts.simple')

@section('title','الرواتب')

@section('page-title','الرواتب')

@section('page-nav')
	<a class="btn btn-outline-info inline-btn" href="/rewards">المكافئات والخصم</a>

{{-- <a class="btn btn-outline-info inline-btn" href="/rewards/create">جديد</a> --}}
@endsection


@section('content')

<div class="row justify-content-center">
	<div class="col-md-8">

			<ul class="list-group list-group-horizontal-md mx-auto mb-3" style="width: fit-content;" >
			  <li class="list-group-item">
			  	الشهر الحالي  : <span class="text-info" id="currentmonth"></span>
			  </li>
			  <li class="list-group-item">
			  	الرواتب  : <span class="text-info" id="daystonextmonth"></span>
			  </li>		  
			</ul>

		<div class="table-responsive">
			<table class="table table-hover mt-3" style="min-width: 500px;">

				<thead>
					<tr>
						<th>الشهر</th>
						<th>الحالة</th>
						<th>إجراءات</th>
					</tr>
				</thead>
						<?php 

							$currentDate = new DateTime(date("Y-m-01"));
							if ($months->count() > 0)
								$salaryDate = new DateTime($months->first()->year."-".$months->first()->month);
							else {
								$salaryDate = new DateTime(date("Y-m-01"));
								$salaryDate->modify("-3 month");
							}
							
						?>
						@while ( $salaryDate < $currentDate ) 
							<tr>
								<td class="font-weight-bold">{{ $currentDate->format('Y-m') }}</td>
								<td>غير محسوب</td>
								<td>
									<form class="my-0" action="/salaries/createmonth" method="POST">
										@csrf
										<input type="hidden" name="year" value="{{ $currentDate->format('Y') }}">
										<input type="hidden" name="month" value="{{ $currentDate->format('m') }}">
									<button type="submit" class="btn btn btn-outline-success tooltipbtn" data-toggle="tooltip" data-placement="top" title="حساب"><i class="fas fa-play"></i></button>
									</form>
								</td>
							</tr>
							<?php $currentDate->modify("-1 month") ?>
						@endwhile

				@if ($months->count())
						@foreach ($months as $month)
							<tr>
								<td class="font-weight-bold">{{ $month->year }}-{{ sprintf("%02d", $month->month) }}</td>
								<td>آخر حساب {{date('d-m-Y h:i', strtotime($month->updated_at)) }}@if (date('a', strtotime($month->updated_at)) === "am")ص @else م @endif</td>
								<td>
									<form class="my-0" style="display: inline-block;" action="/salaries/createmonth" method="POST">@csrf
										<input type="hidden" name="year" value="{{ $currentDate->format('Y') }}">
										<input type="hidden" name="month" value="{{ $currentDate->format('m') }}">
									<button class="btn btn btn-outline-info tooltipbtn" data-toggle="tooltip" data-placement="top" title="إعادة حساب"><i class="fas fa-calculator"></i></button>
									</form>
									<a href="/salaries/{{ $currentDate->format('Y/m') }}" class="btn btn btn-outline-info tooltipbtn" data-toggle="tooltip" data-placement="top" title="عرض"><i class="fas fa-eye"></i></a>
								</td>
							</tr>
						@endforeach
				@endif
			</table>
		</div>

	</div>
</div>



@endsection

@section ("custom-js")
	$('.tooltipbtn').tooltip({delay: { "show": 500 }});
	$('#currentmonth').html(moment(Date.now()).format(" (MMMM) M-Y"));
	$('#daystonextmonth').html(moment().endOf('month').fromNow());
@endsection
	