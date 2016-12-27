<?php $__env->startSection('content'); ?>
    
            <h1>tikTrak</h1>
            <h2>Try Typing a Ticker eg. SYD for Sydney Airport</h2>
            <form method="POST">
                <label>
                <input type="text" class="form-control" placeholder="Track a ticker" name="ticker1">
                <input type="text" class="form-control" placeholder="Track a ticker" name="ticker2">
                <input type="text" class="form-control" placeholder="Track a ticker" name="ticker3">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <button type="submit" class="btn">go</button>
                </label>
            </form>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>