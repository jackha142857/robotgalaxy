@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center" style="margin-top: 15rem; margin-bottom: 15rem;">
	<div class="container" id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px;"></div>
</div>
@endsection

@section('footer')
<script src="{{ asset('canvasjs/jquery.canvasjs.min.js') }}"></script>
<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var array = {!! json_encode($data) !!};
console.log(array);
var options = {
	title: {
		text: "Total of robots/AIs was created by the year"
	},
	animationEnabled: true,
	exportEnabled: true,
	data: [
	{
		type: "spline", //change it to line, area, column, pie, etc
		dataPoints: array
	}
	]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
@endsection