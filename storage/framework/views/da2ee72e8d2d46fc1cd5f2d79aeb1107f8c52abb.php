<?php echo $__env->make('includes.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<h1 class="display-1"><p style="font-size:150px">TikTrak</p></h1>
<div class = "container" style="text-align: center">
	<h1>Try typing up to 3 tickers.</h1><h4> It won't bite.</h4>
	<br>
</div>
<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>