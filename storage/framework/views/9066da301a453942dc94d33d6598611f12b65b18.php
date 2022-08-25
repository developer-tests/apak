<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.headers.cards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><?php echo e(__('name')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td ><h2 style="color:white"><?php echo e(__('No Record Found')); ?>..</h2>
                                    </td></tr>
<!--                                <tr>
                                    
                                    <td>
                                        
                                    </td>
                                </tr>-->
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="text-uppercase text-muted ls-1 mb-1"><?php echo e(__('Clipboard')); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="whiteboard">
                            <textarea id="whiteboard" style="width: 90%;height: 75%;font-size: 18px;margin: 20px;border: 10px solid #7b61e4;" readonly="">nmmnkmlkml</textarea><button id="edit" data-focus="off" hidden="true">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('Course Modification Proposals')); ?></h3>
                            </div>
                            <div class="col text-right">
                                <?php echo e(__('There are')); ?>

                                <a href="#!" class="btn btn-sm btn-primary">0</a>
                                <?php echo e(__('requests to evaluate')); ?>

                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('Members')); ?></h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">359</a>
                                <?php echo e(__('members are registered .')); ?>

                            </div>
                        </div>
                    </div>

                </div><br>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('Payment status')); ?></h3>
                            </div>
                            <div class="col text-right">
                                <?php echo e(__('There are')); ?>

                                <a href="#!" class="btn btn-sm btn-primary">319</a>
                                <?php echo e(__('outstanding payments .')); ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('Events')); ?></h3>
                            </div>

                        </div>
                    </div>

                    <div class="row align-items-center">

                        <div class="col text-center">
                            <div class="col">
                                <a href="#!" class="btn btn-sm btn-primary">45</a>
                                <?php echo e(__('events are active .')); ?>

                            </div>


                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col text-center">
                            <a href="#!" class="btn btn-sm btn-primary">45</a>
                            <?php echo e(__('At the moment')); ?><br>
                            <a href="#!" class="btn btn-sm btn-primary">0</a>
                            <?php echo e(__('events are in progress out of a total of')); ?>

                            <a href="#!" class="btn btn-sm btn-primary">0</a>
                            <?php echo e(__('scheduled for today')); ?>

                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('Payments accepted today')); ?></h3>
                            </div>
                            <div class="col text-right">

                                <a href="#!" class="btn btn-sm btn-primary">0</a>
                                <?php echo e(__('payments have been accepted for a total of')); ?> 0.00 €.
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('Payments accepted yesterday')); ?></h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">359</a>
                                <?php echo e(__('payments have been accepted for a total of')); ?> 0.00 €.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"><?php echo e(__('CM status registered')); ?></h3>
                            </div>

                        </div>
                    </div>

                    <div class="row align-items-center">

                        <div class="col text-center">
                            <div class="col">
                                <?php echo e(__('There are')); ?>

                                <a href="#!" class="btn btn-sm btn-primary">94</a>
                                <?php echo e(__('expired CMs .')); ?>

                            </div>


                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">

                        <div class="col text-center">
                            <div class="col">
                                <a href="#!" class="btn btn-sm btn-primary">43</a>
                                <?php echo e(__('CM expiring in the month.')); ?>

                            </div>


                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col text-center">
                            <?php echo e(__('a total of')); ?>

                            <a href="#!" class="btn btn-sm btn-primary">207</a>
                            <?php echo e(__('subscribers do not have a CM.')); ?>

                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <br>

            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('argon')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(asset('argon')); ?>/vendor/chart.js/dist/Chart.extension.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apak\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>