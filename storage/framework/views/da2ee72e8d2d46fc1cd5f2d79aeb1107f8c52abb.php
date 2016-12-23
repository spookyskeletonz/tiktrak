<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md1 col-md-offset-5">
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
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>