<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TikTrak</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
	
<body>
	<div class="container">
	<form class="form-inline" method="POST">
		<div class="form-group">
		    <label>
		    Tickers:
		    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker1">
		    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker2">
		    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker3">
		    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
		    </label>
		</div>
		<div class="form-group">
			<label>
			Number of Dates:
			<input type="number" min="1" step="1" class="form-control" placeholder="0-infinity" name="entries">
			<input type="hidden" name="_token1" value="<?php echo e(csrf_token()); ?>">
			</label>
		</div>
		<button type="submit" class="btn">go</button>
	</form> 
	</div>
	<?php echo $__env->yieldContent('content'); ?>
</body>
</html>