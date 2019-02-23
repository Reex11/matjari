@extends('layouts.simple')

@section('title')
| test
@endsection

@section('content')

<?php echo $week=date("W",strtotime(date("w")==0?"+7 day":"+0 day")); ?>
<br>
<?php echo date("w Y-m-d"); ?>
<br>
<?php echo \App\Shift::latest()->first()->week + 1; ?>


@endsection