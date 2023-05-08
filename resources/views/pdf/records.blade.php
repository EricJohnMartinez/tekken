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
        <img src="{{ public_path('minsu.jpg') }}" alt="Mindoro State University logo">
        <div>
            <h1>Mindoro State University</h1>
            <p>Calapan City Campus</p>
        </div>
    </header>
	<main>
		<!-- Your content here -->
	</main>
</body>
</html>
