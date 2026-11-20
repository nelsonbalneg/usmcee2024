<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Page Title',
    'subtitle' => null,
    'module' => null,
    'moduleIcon' => 'layout-dashboard',
    'section' => null,
    'sectionIcon' => 'file-text',
    'breadcrumbs' => [],
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Page Title',
    'subtitle' => null,
    'module' => null,
    'moduleIcon' => 'layout-dashboard',
    'section' => null,
    'sectionIcon' => 'file-text',
    'breadcrumbs' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mt-4 mb-4 print:hidden">
    <div
        class="page-header-panel flex flex-col gap-3 rounded-[20px] border border-slate-200/80 bg-slate-50/60 px-4 py-4 md:flex-row md:items-center md:justify-between">
        <div class="min-w-0 grow">
            <?php if($module || $section): ?>
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <?php if($module): ?>
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-indigo-600">
                            <i data-lucide="<?php echo e($moduleIcon); ?>" class="size-3.5"></i>
                            <?php echo e($module); ?>

                        </span>
                    <?php endif; ?>

                    <?php if($section): ?>
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-500">
                            <i data-lucide="<?php echo e($sectionIcon); ?>" class="size-3.5"></i>
                            <?php echo e($section); ?>

                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <h5 class="page-header-title text-[15px] font-semibold uppercase tracking-tight text-slate-500">
                <?php echo e($title); ?>

            </h5>

            <?php if($subtitle): ?>
                <p class="page-header-subtitle mt-1 text-sm text-slate-500">
                    <?php echo e($subtitle); ?>

                </p>
            <?php endif; ?>
        </div>

        <?php if(!empty($breadcrumbs)): ?>
            <ul class="flex flex-wrap items-center gap-2 text-sm shrink-0">
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <?php if(!empty($crumb['url'])): ?>
                            <a href="<?php echo e($crumb['url']); ?>"
                                class="page-header-crumb inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-500 transition hover:border-indigo-200 hover:text-indigo-600">
                                <?php echo e($crumb['label']); ?>

                            </a>
                        <?php else: ?>
                            <span
                                class="page-header-crumb inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600">
                                <?php echo e($crumb['label']); ?>

                            </span>
                        <?php endif; ?>
                    </li>

                    <?php if(!$loop->last): ?>
                        <li class="text-slate-300">
                            <i data-lucide="chevron-right" class="size-4"></i>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
