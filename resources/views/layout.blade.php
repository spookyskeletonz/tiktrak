<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TikTrak</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
	
<body>
	<div class="container" style="text-align: center">
		<form class="form-inline" method="POST" action="{{url('/')}}">
			<div class="form-group">
			    <label>
			    Tickers:
			    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker1">
			    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker2">
			    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker3">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			    </label>
			</div>
			<div class="form-group">
				<label>
				Number of Dates:
				<input type="number" min="1" step="1" class="form-control" placeholder="0-infinity" name="entries" required="true">
				<input type="hidden" name="_token1" value="{{ csrf_token() }}">
				</label>
			</div>
			<div class="radio-horizontal">
				<label>
				<input type="radio" name="chartoptions" value="percentagechange" checked>
				Percentage Changes
				</label>
			</div>
			<div class="radio-horizontal">
				<label>
				<input type="radio" name="chartoptions" value="closingprice">
				Closing Prices
				</label>
			</div>
			<button type="submit" class="btn">go</button>
		</form>
	</div>
	@yield('content')
</body>
</html>