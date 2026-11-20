<?php
    use Carbon\Carbon;
?>

<?php $__env->startSection('title'); ?>
    USMCEE - My Profile
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('contents'); ?>

    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'USMCEE 4.0 ','breadcrumbs' => [['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Reservation']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'USMCEE 4.0 ','breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Reservation']])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    <!--start grid-->
    <div class="reservation-page grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <!--start col-->
        <div class="xl:col-span-12">
            <!--start card-->
            

            <div class="flex flex-col col-span-1 gap-3 card 2xl:col-span-12">
                <div class="card-body">
                    <div
                        class="reservation-records overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                        
                        <div class="px-6 py-5 border-b border-slate-200 dark:border-zink-600">
                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-custom-500">
                                        Reservation Records
                                    </p>
                                    <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                        Your USMCEE Reservations
                                    </h6>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                        View your reservation history, schedule, venue, and available actions.
                                    </p>
                                </div>

                                <div class="shrink-0">
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300">
                                        <?php echo e($cee_reservation_records->count()); ?>

                                        <?php echo e($cee_reservation_records->count() > 1 ? 'Reservations' : 'Reservation'); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        
                        <div class="p-4 md:p-5">
                            <div class="overflow-hidden border rounded-2xl border-slate-200 dark:border-zink-600">
                                <div class="overflow-x-auto">
                                    <table class="w-full min-w-[980px]">
                                        <thead class="bg-slate-50 dark:bg-zink-700/50">
                                            <tr>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Action
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Status
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    App #
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Schedule
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Venue
                                                </th>
                                                <th
                                                    class="px-4 py-3 text-xs font-semibold tracking-wide text-left uppercase text-slate-500 dark:text-zink-300">
                                                    Date Created
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-slate-200 dark:divide-zink-600">
                                            <?php if($cee_reservation_records->isNotEmpty()): ?>
                                                <?php $__currentLoopData = $cee_reservation_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $isActiveSession = $data->session_status === 'active';
                                                    ?>

                                                    <tr
                                                        class="transition-colors duration-200 bg-white hover:bg-slate-50/70 dark:bg-zink-800 dark:hover:bg-zink-700/30">
                                                        
                                                        <td class="px-4 py-4">
                                                            <?php if($data->status === 'cancelled'): ?>
                                                                <span
                                                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold cursor-not-allowed rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-500/20 dark:text-slate-400">
                                                                    <i data-lucide="ban" class="size-3.5"></i>
                                                                    Not Available
                                                                </span>
                                                            <?php elseif($data->status === 'pending'): ?>
                                                                <a href="<?php echo e(route('student.cee.exam-slip', ['app_no' => encrypt($data->app_no)])); ?>"
                                                                    target="_blank"
                                                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                    <i data-lucide="file-text" class="size-3.5"></i>
                                                                    CEE Slip
                                                                </a>
                                                            <?php else: ?>
                                                                <?php if($isActiveSession): ?>
                                                                    <a href="<?php echo e(route('student.cee.result')); ?>"
                                                                        target="_blank"
                                                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                                        <i data-lucide="eye" class="size-3.5"></i>
                                                                        Result
                                                                    </a>
                                                                <?php else: ?>
                                                                    <span
                                                                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold cursor-not-allowed rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-500/20 dark:text-slate-400">
                                                                        <i data-lucide="lock" class="size-3.5"></i>
                                                                        Result Unavailable
                                                                    </span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>

                                                        
                                                        <td class="px-4 py-4">
                                                            <?php if($data->status === 'pending'): ?>
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-500/20 dark:text-yellow-500">
                                                                    <i data-lucide="circle-dashed" class="size-3"></i>
                                                                    Reserved
                                                                </span>
                                                            <?php elseif($data->status === 'cancelled'): ?>
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-500/20 dark:text-red-500">
                                                                    <i data-lucide="x-circle" class="size-3"></i>
                                                                    Cancelled
                                                                </span>
                                                            <?php elseif($data->status === 'confirmed'): ?>
                                                                <span
                                                                    class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                    <i data-lucide="check-circle-2" class="size-3"></i>
                                                                    Confirmed
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>

                                                        
                                                        <td class="px-4 py-4">
                                                            <div class="flex flex-col">
                                                                <span class="font-semibold text-slate-800 dark:text-white">
                                                                    <?php echo e($data->app_no); ?>

                                                                </span>
                                                                <span class="text-xs text-slate-400 dark:text-zink-400">
                                                                    Application Reference
                                                                </span>
                                                            </div>
                                                        </td>

                                                        
                                                        <td class="px-4 py-4">
                                                            <div class="space-y-2">
                                                                <span
                                                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-500/20 dark:text-green-500">
                                                                    <?php echo e($data->session_name); ?>

                                                                </span>

                                                                <div class="text-sm text-slate-700 dark:text-zink-100">
                                                                    <div class="font-medium"><?php echo e($data->exam_session); ?></div>
                                                                    <div class="text-slate-500 dark:text-zink-300">
                                                                        <?php echo e(\Carbon\Carbon::parse($data->schedule)->format('F j, Y')); ?>

                                                                        <span
                                                                            class="font-medium text-slate-700 dark:text-zink-100">
                                                                            [<?php echo e($data->time); ?>]
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        
                                                        <td class="px-4 py-4">
                                                            <div class="space-y-2">
                                                                <span
                                                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300">
                                                                    <?php echo e($data->campus); ?>

                                                                </span>

                                                                <div class="text-sm text-slate-700 dark:text-zink-100">
                                                                    <?php echo e($data->college_name . ' - ' . $data->room_name); ?>

                                                                </div>
                                                            </div>
                                                        </td>

                                                        
                                                        <td class="px-4 py-4">
                                                            <div class="text-sm text-slate-700 dark:text-zink-100">
                                                                <?php echo e(\Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Manila')->format('F j, Y h:i A')); ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="px-4 py-10 text-center">
                                                        <div class="flex flex-col items-center justify-center gap-3">
                                                            <div
                                                                class="flex items-center justify-center rounded-2xl size-12 bg-slate-100 text-slate-500 dark:bg-zink-700 dark:text-zink-300">
                                                                <i data-lucide="calendar-x-2" class="size-5"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="font-semibold text-slate-800 dark:text-white">
                                                                    No reservations available
                                                                </h6>
                                                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                                                    You do not have any USMCEE reservation records yet.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            
                            <p class="mt-3 text-xs text-slate-400 dark:text-zink-400">
                                Reservation actions depend on your reservation status and whether the related CEE session is
                                currently active.
                            </p>
                        </div>
                    </div>
                </div>
            </div><!--end card-->

            <?php if($reservationCount == 0): ?>

                
                
                
                

                <?php if($endofreservation && Carbon::parse($endofreservation, 'Asia/Manila')->isFuture()): ?>
                    
                    <div
                        class="mb-5 overflow-hidden border border-green-200 shadow-sm rounded-2xl bg-green-50 dark:border-green-500/20 dark:bg-green-500/10">
                        <div class="flex gap-3 p-5">
                            <div
                                class="flex items-center justify-center text-green-600 bg-white rounded-xl size-11 shrink-0 dark:bg-zink-800 dark:text-green-300">
                                <i data-lucide="badge-info" class="size-5"></i>
                            </div>

                            <div class="min-w-0">
                                <h6 class="mb-1 text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                    Kindly read this note before proceeding to CEE Slot Reservation
                                </h6>
                                <p class="text-sm leading-6 text-slate-600 dark:text-zink-300">
                                    <span class="font-semibold text-slate-800 dark:text-white">Note:</span>
                                    Please ensure that you provide accurate and correct information. Double-check all
                                    details before
                                    submitting, as you will not be able to edit them once saved.
                                </p>
                            </div>
                        </div>
                    </div>

                    
                    <div
                        class="overflow-hidden bg-white border shadow-sm card rounded-2xl border-slate-200 dark:border-zink-600 dark:bg-zink-800">
                        <div class="p-0 card-body">

                            
                            <div class="px-6 py-5 border-b border-slate-200 dark:border-zink-600">
                                <p class="mb-1 text-[11px] font-semibold tracking-[0.18em] uppercase text-custom-500">
                                    Reservation Form
                                </p>
                                <h6 class="text-lg font-bold tracking-tight text-slate-800 dark:text-white">
                                    Reservation Details
                                </h6>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zink-300">
                                    Complete the details below to reserve your USMCEE slot.
                                </p>
                            </div>

                            <div class="p-6">
                                <form action="<?php echo e(route('student.reserve.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" name="ceesession" value="<?php echo e($ceeSession->id); ?>" readonly>

                                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                                        
                                        <div class="xl:col-span-6">
                                            <label for="is_repeat_exam"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                CEE Retaker?
                                                <span class="text-xs font-medium text-green-500">read only</span>
                                            </label>
                                            <input type="text" id="is_repeat_exam" name="is_repeat_exam"
                                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 focus:border-green-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100"
                                                value="<?php echo e($isRetaker ? 'Yes' : 'No'); ?>" readonly>
                                        </div>

                                        
                                        <div class="pt-2 xl:col-span-12">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex items-center justify-center rounded-xl size-10 bg-sky-100 text-sky-600 dark:bg-sky-500/20 dark:text-sky-300">
                                                    <i data-lucide="graduation-cap" class="size-5"></i>
                                                </div>
                                                <div>
                                                    <h6
                                                        class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Priority Programs
                                                    </h6>
                                                    <p class="text-sm text-slate-500 dark:text-zink-300">
                                                        Choose your first, second, and third priority programs.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="xl:col-span-4">
                                            <label for="campus-select"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select" name="campus" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Campus</option>
                                                <?php $__currentLoopData = $campusNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campusName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($campusName->real_campus_id); ?>"
                                                        data-termid="<?php echo e($campusName->termid); ?>">
                                                        <?php echo e($campusName->campus_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                First Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select" name="firstprioprog" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="firstprioprog_desc" id="firstprioprog_desc">
                                            <input type="hidden" name="firstprogram_policy_id"
                                                id="firstprogram_policy_id">
                                        </div>

                                        
                                        <div class="xl:col-span-4">
                                            <label for="campus-select2"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select2" name="campus2" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Campus</option>
                                                <?php $__currentLoopData = $campusNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campusName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($campusName->real_campus_id); ?>"
                                                        data-termid="<?php echo e($campusName->termid); ?>">
                                                        <?php echo e($campusName->campus_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select2"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Second Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select2" name="secondprioprog" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="secondprioprog_desc" id="secondprioprog_desc">
                                            <input type="hidden" name="secondprogram_policy_id"
                                                id="secondprogram_policy_id">
                                        </div>

                                        
                                        <div class="xl:col-span-4">
                                            <label for="campus-select3"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Campus <span class="text-red-500">*</span>
                                            </label>
                                            <select id="campus-select3" name="campus3" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Campus</option>
                                                <?php $__currentLoopData = $campusNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campusName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($campusName->real_campus_id); ?>"
                                                        data-termid="<?php echo e($campusName->termid); ?>">
                                                        <?php echo e($campusName->campus_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="xl:col-span-8">
                                            <label for="program-select3"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Third Priority Program <span class="text-red-500">*</span>
                                            </label>
                                            <select id="program-select3" name="thirdprioprog" data-reservation-search
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option selected disabled>Choose Program</option>
                                            </select>
                                            <input type="hidden" name="thirdprioprog_desc" id="thirdprioprog_desc">
                                            <input type="hidden" name="thirdprogram_policy_id"
                                                id="thirdprogram_policy_id">
                                        </div>

                                        
                                        <div class="pt-2 xl:col-span-12">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex items-center justify-center text-green-600 bg-green-100 rounded-xl size-10 dark:bg-green-500/20 dark:text-green-300">
                                                    <i data-lucide="map-pinned" class="size-5"></i>
                                                </div>
                                                <div>
                                                    <h6
                                                        class="text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                                        Examination Venue
                                                    </h6>
                                                    <p class="text-sm text-slate-500 dark:text-zink-300">
                                                        Select your preferred examination venue.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="xl:col-span-12">
                                            <label for="examcampus"
                                                class="inline-block mb-2 text-sm font-semibold text-slate-700 dark:text-zink-100">
                                                Select Examination Venue <span class="text-red-500">*</span>
                                            </label>

                                            <select id="examcampus" name="venue_campus"
                                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-custom-500 focus:outline-none dark:border-zink-600 dark:bg-zink-700 dark:text-zink-100">
                                                <option value="" selected>- Select -</option>
                                                <option value="Main Campus">Main Campus</option>
                                                <option value="USM KCC">USM KCC</option>
                                                <option value="USM PALMA">USM PALMA</option>
                                            </select>

                                            <div id="activeSlotsLabel"
                                                class="hidden px-4 py-3 mt-3 text-sm border rounded-xl border-sky-200 bg-sky-50 text-sky-700 dark:border-sky-500/20 dark:bg-sky-500/10 dark:text-sky-500">
                                                Active Slots for <span id="selectedCampus" class="font-semibold"></span>:
                                                <span id="activeSlots" class="font-bold">0</span>
                                            </div>

                                            <div
                                                class="px-4 py-3 mt-3 text-sm text-green-700 border border-green-200 rounded-xl bg-green-50 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-500">
                                                <span class="font-semibold">Note:</span>
                                                The system will automatically select and assign a room for your reservation.
                                            </div>
                                        </div>

                                        
                                        <div class="flex justify-end gap-3 pt-2 xl:col-span-12">
                                            <button type="button"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-red-600 transition-all duration-200 bg-white border border-red-200 rounded-xl hover:bg-red-50 dark:bg-zink-700 dark:border-red-500/20 dark:text-red-300 dark:hover:bg-red-500/10">
                                                <i data-lucide="x" class="size-4"></i>
                                                Cancel
                                            </button>

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-green-500 shadow-sm rounded-xl hover:bg-green-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-200">
                                                <i data-lucide="check" class="size-4"></i>
                                                Submit Reservation
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    <div id="loading-modal"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-transparent" role="status" aria-live="polite">
                        <div
                            class="flex flex-col items-center p-6 bg-white border shadow-xl rounded-2xl border-slate-200 dark:bg-zink-800 dark:border-zink-600">
                            <svg class="w-10 h-10 mb-4 animate-spin text-custom-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0a12 12 0 100 24v-4a8 8 0 01-8-8z"></path>
                            </svg>
                            <p class="font-medium text-slate-700 dark:text-zink-100">
                                Loading programs, please wait...
                            </p>
                        </div>
                    </div>
                <?php else: ?>
                    
                    <div
                        class="overflow-hidden border border-red-200 shadow-sm rounded-2xl bg-red-50 dark:border-red-500/20 dark:bg-red-500/10">
                        <div class="flex gap-3 p-5">
                            <div
                                class="flex items-center justify-center text-red-600 bg-white rounded-xl size-11 shrink-0 dark:bg-zink-800 dark:text-red-300">
                                <i data-lucide="alert-circle" class="size-5"></i>
                            </div>

                            <div class="min-w-0">
                                <h6 class="mb-1 text-base font-bold tracking-tight text-slate-800 dark:text-white">
                                    Hi there, <?php echo e(Auth::user()->firstname); ?>!
                                </h6>
                                <p class="text-sm text-slate-600 dark:text-zink-500">
                                    Please be informed that the <span class="font-semibold">USMCEE Slot Reservation</span>
                                    is officially closed.
                                </p>
                                <p class="mt-2 text-sm font-medium text-slate-700 dark:text-zink-100">
                                    Thank you!
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div><!--end col-->
    </div><!--end grid-->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(session('message')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "<?php echo e(session('status') === 'error' ? 'error' : 'success'); ?>",
                    title: "<?php echo e(session('status') === 'error' ? 'Error' : 'Success'); ?>",
                    text: "<?php echo e(session('message')); ?>",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: '<?php echo implode('<br>', $errors->all()); ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Call the duplicate check endpoint
            fetch("<?php echo e(route('student.check.duplicate.records')); ?>")
                .then(response => response.json())
                .then(data => {
                    if (data.hasDuplicates) {
                        Swal.fire({
                            title: 'Warning',
                            html: "It appears that you may have multiple accounts registered in the system. Please refer to our <a href='https://www.facebook.com/theUSMofficial/posts/pfbid023dhP2MebE75xskEstWatNpjLBQH6CWh3XG6HWDYEMBk7QPHv4DAYpk2KvDBi4cFgl?rdid=BrbqOM3Yujlp2Z1p#' target='_blank'>Facebook announcement</a> for reference.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '',
                            showConfirmButton: false,
                            showCancelButton: false,
                            cancelButtonText: 'Close',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Action after confirmation if needed
                            }
                        });

                    }
                })
                .catch(error => console.error('Error:', error));
        });
        // Get the select elements and the modal
        const selects = ['campus-select', 'campus-select2', 'campus-select3'].map(id => document.getElementById(id));
        const loadingModal = document.getElementById('loading-modal');

        // Function to show the loading modal
        function showLoadingModal(selectElement) {
            loadingModal.classList.remove('hidden'); // Show the modal
            selectElement.disabled = true; // Disable the specific select element

            // Hide the modal and enable the select element after 10 seconds
            setTimeout(() => {
                loadingModal.classList.add('hidden');
                selectElement.disabled = false;
            }, 3000);
        }

        // Add event listeners for each select element
        selects.forEach(select => {
            select.addEventListener('change', function() {
                showLoadingModal(select);
            });
        });
    </script>

    <script>
        let selectedCampus = '';

        // Function to fetch and update active slots
        function fetchActiveSlots() {
            if (selectedCampus) {
                fetch("<?php echo e(route('student.count-active-slots')); ?>?campus=" + encodeURIComponent(selectedCampus))
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('activeSlots').innerText = data.activeSlots;
                    })
                    .catch(error => console.error('Error fetching slots:', error));
            }
        }

        document.getElementById('examcampus').addEventListener('change', function() {
            selectedCampus = this.value;
            let activeSlotsLabel = document.getElementById('activeSlotsLabel');
            let selectedCampusSpan = document.getElementById('selectedCampus');

            if (selectedCampus) {
                selectedCampusSpan.innerText = selectedCampus;
                activeSlotsLabel.classList.remove('hidden'); // Show label
                fetchActiveSlots(); // Fetch immediately when user selects a campus
            } else {
                activeSlotsLabel.classList.add('hidden'); // Hide label if no campus selected
            }
        });

        // Automatically fetch active slots every 10 seconds
        setInterval(fetchActiveSlots, 10000);
    </script>


    <script>
        // if (navigator.geolocation) {
        //     navigator.geolocation.getCurrentPosition(
        //         (position) => {
        //             console.log("Latitude:", position.coords.latitude);
        //             console.log("Longitude:", position.coords.longitude);
        //         },
        //         (error) => {
        //             if (error.code === error.PERMISSION_DENIED) {
        //                 alert("Please enable location access for a better experience.");
        //                 // Optionally, provide instructions or a link to help users enable location.
        //             }
        //         }
        //     );
        // } else {
        //     alert("Geolocation is not supported by this browser.");
        // }

        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent default submission

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "I confirm that all data are correct and reviewed. I understand that once saved, I will no longer be able to edit the information.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        this.submit();
                    }
                });
            });
        });

        // Initialize Choices on the room select element
        document.addEventListener('DOMContentLoaded', function() {
            const campusSelect1 = document.getElementById('campus-select');
            const programSelect1 = document.getElementById('program-select');
            const firstPriorityDescInput = document.getElementById('firstprioprog_desc');
            const firstprogram_policy_id_Input = document.getElementById('firstprogram_policy_id');

            const campusSelect2 = document.getElementById('campus-select2');
            const programSelect2 = document.getElementById('program-select2');
            const secondPriorityDescInput = document.getElementById('secondprioprog_desc');
            const secondprogram_policy_id_Input = document.getElementById('secondprogram_policy_id');

            const campusSelect3 = document.getElementById('campus-select3');
            const programSelect3 = document.getElementById('program-select3');
            const thirdPriorityDescInput = document.getElementById('thirdprioprog_desc');
            const thirdprogram_policy_id_Input = document.getElementById('thirdprogram_policy_id');


            const searchableSelects = new Map();
            const campusTerms = new Map();
            const programDetails = new Map();
            [campusSelect1, campusSelect2, campusSelect3].filter(Boolean).forEach(select => {
                campusTerms.set(select, new Map(Array.from(select.options, option => [option.value, option.dataset.termid])));
            });
            document.querySelectorAll('[data-reservation-search], #examcampus').forEach(select => {
                searchableSelects.set(select, new Choices(select, {
                    searchEnabled: true,
                    searchPlaceholderValue: 'Type to search...',
                    shouldSort: false,
                    itemSelectText: '',
                    allowHTML: false,
                }));
            });

            function replacePrograms(select, options) {
                const choices = searchableSelects.get(select);
                choices.removeActiveItems();
                choices.clearChoices();
                choices.setChoices(options, 'value', 'label', true);
            }

            function loadPrograms(campusSelect, programSelect) {
                const realCampusId = campusSelect.value;
                const termId = campusTerms.get(campusSelect)?.get(realCampusId);

                if (!realCampusId || !termId) return; // Exit if missing values

                programDetails.set(programSelect, new Map());
                replacePrograms(programSelect, [{ value: '', label: 'Please wait...', selected: true, disabled: true }]);

                fetch(`/student/cee/get-programs-by-campus?termId=${termId}&realCampusId=${realCampusId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (campusSelect.value !== realCampusId) return;
                        programDetails.set(programSelect, new Map(data.map(program => [String(program.programId), program])));
                        replacePrograms(programSelect, [
                            { value: '', label: 'Choose Program', selected: true, disabled: true },
                            ...data.map(program => ({
                                value: String(program.programId),
                                label: program.majorDiscDesc ? `${program.programName} - ${program.majorDiscDesc}` : program.programName,
                            }))
                        ]);
                    })
                    .catch(error => {
                        console.error('Error loading programs:', error);
                        if (campusSelect.value !== realCampusId) return;
                        replacePrograms(programSelect, [{ value: '', label: 'Error loading programs', selected: true, disabled: true }]);
                    });
            }

            campusSelect1.addEventListener('change', () => loadPrograms(campusSelect1, programSelect1));
            campusSelect2.addEventListener('change', () => loadPrograms(campusSelect2, programSelect2));
            campusSelect3.addEventListener('change', () => loadPrograms(campusSelect3, programSelect3));

            // Update priority description inputs when a program is selected
            programSelect1.addEventListener('change', () => {
                const program = programDetails.get(programSelect1)?.get(programSelect1.value);
                firstPriorityDescInput.value = program?.programName ?? '';
                firstprogram_policy_id_Input.value = program?.id ?? '';
            });

            programSelect2.addEventListener('change', () => {
                const program = programDetails.get(programSelect2)?.get(programSelect2.value);
                secondPriorityDescInput.value = program?.programName ?? '';
                secondprogram_policy_id_Input.value = program?.id ?? '';
            });

            programSelect3.addEventListener('change', () => {
                const program = programDetails.get(programSelect3)?.get(programSelect3.value);
                thirdPriorityDescInput.value = program?.programName ?? '';
                thirdprogram_policy_id_Input.value = program?.id ?? '';
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('student.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>