<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Boring Town - Home</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
	rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Fira+Mono|Fira+Sans" rel="stylesheet">

<!-- Styles -->
<style>
html, body {
	background-color: #fff;
	color: #636b6f;
	font-family: 'Raleway', sans-serif;
	font-weight: 100;
	height: 100vh;
	margin: 0;
}

.flex-center {
	align-items: center;
	display: flex;
	justify-content: center;
}

.position-ref {
	position: relative;
}

.top-right {
	position: absolute;
	right: 10px;
	top: 18px;
}

.content {
	text-align: center;
}

.title {
	font-size: 84px;
}

.links>a {
	color: #636b6f;
	padding: 0 25px;
	font-size: 12px;
	font-weight: 600;
	letter-spacing: .1rem;
	text-decoration: none;
	text-transform: uppercase;
}
.listing {
	font-family: 'Fira Sans', sans-serif;
	font-size: 12px;
}
.monospace {
	font-family: 'Fira Mono', monospace;
}
.event-venue {
	font-family: 'Arial', sans-serif;
	color: #333333;
	font-weight: 100;

}
.m-b-md {
	margin-bottom: 30px;
}

.left {
	align-items: left;
	justify-content: left;
	text-align: left;
}

</style>
</head>
<body>
<


	<div class="flex-center position-ref">
		<div class="content">
			<div class="title m-b-md">MyBoringTown -0.0a</div>
			<div class="links">
				<a href="logout">Logout</a>
			</div>
			<div class="listing left">
				@foreach ($data as $event)
	    			<div class="event left">
	    			<span class="monospace">{{ date('D.M.d.y',strtotime($event['start']))}} </span><span class="event-venue">[VENUE NAME HERE]</span>:

					@foreach ($event['participant'] as $participent)
		    			{{ $participent['name'] }},
					@endforeach

	    			</div>
				@endforeach
			</div>
		</div>
	</div>
</body>
</html>
