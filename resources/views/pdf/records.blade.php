<!DOCTYPE html>
<html>
<head>
	<title>Alumni Records</title>
	<style>
		@page {
			margin: 1cm;
			size: A4;
		}
		header {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			height: 3cm;
			background-color: #f2f2f2;
			display: flex;
			align-items: center;
			padding: 0 1cm;
			border-bottom: 1px solid #ccc;
		}
		header img {
			height: 2cm;
			margin-right: 1cm;
		}
		header div {
			text-align: center;
		}
		header h1 {
			font-size: 1.5rem;
			margin: 0;
		}
		header p {
			margin: 0;
			font-size: 1rem;
			color: #666;
		}
	</style>
</head>
<body>
	<header>
        <div>
            <h1>Mindoro State University</h1>
            <p>Calapan City Campus</p>
			<p>College Department</p>
        </div>
    </header>
	<main>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div>
			@foreach ($users as $user )
			@if ($user->year_graduated == '2020-2021')
			<h4>Employability Status of Graduates A.Y. 2020-2021</h4>
				@if ($user->department == 'BSED')
				<h5>Course: BSIT</h5>
					<p>{{$user->name}}</p>
				@endif
				@endif
		@endforeach
	</div>	
	</main>
</body>
</html>
