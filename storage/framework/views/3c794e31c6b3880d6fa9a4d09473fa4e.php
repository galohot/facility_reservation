<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php echo e($title ? $title . ' | Layanan Sarpras Kemlu' : 'Layanan Sarpras Kemlu'); ?></title>
    <!-- CSS files -->
    <link rel="icon" href="<?php echo e(asset('../build/assets/static/kemlu-favicon.png')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('../build/assets/static/kemlu-favicon.png')); ?>" type="image/x-icon">
    <link href="<?php echo e(asset('../build/assets/css/tabler.css?1692870487')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('../build/assets/css/tabler-flags.min.css?1692870487')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('../build/assets/css/tabler-payments.min.css?1692870487')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('../build/assets/css/tabler-vendors.min.css?1692870487')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('../build/assets/css/demo.min.css?1692870487')); ?>" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .uker-info {
            white-space: pre-wrap;
            /* Allow line breaks */
            word-wrap: break-word;
            /* Break long words */
        }
    </style>
    <link href="<?php echo e(asset('css/fullcalendar.min.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('../build/assets/js/demo-theme.min.js?1692870487')); ?>"></script>
    <?php echo e($header ?? ''); ?>

</head>

<body>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="">
                        <img src="<?php echo e(asset('../build/assets/static/kemlu-color-left-2.png')); ?>" height="50px"
                            alt="Kemlu-Logo">
                    </a>
                </h1>
                <div class="flex-row navbar-nav order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="p-0 nav-link d-flex lh-1 text-reset" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <?php echo $__env->make('layouts.navigation.profilemenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </header>

        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('landing')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Home
                                    </span>
                                </a>
                            </li>
                            <?php if(Auth::user()->roleMaster->role_str == 'user'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('reservation.myreservation')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        My Reservation
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('landing.calendar')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Calendar
                                    </span>
                                </a>
                            </li>
                            <?php if(Auth::user()->roleMaster->role_str != 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('landing.dashboard')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Satker Activity
                                    </span>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('landing.dashboard')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Kemlu Activity
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                            <path d="M12 12l8 -4.5" />
                                            <path d="M12 12l0 9" />
                                            <path d="M12 12l-8 -4.5" />
                                            <path d="M16 5.25l-8 4.5" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Kemlu Facilities
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('available.facilities.show', $navItem->id)); ?>">
                                                    <?php echo e($navItem->category_str); ?>

                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php if(Auth::user()->roleMaster->role_str == 'admin' || Auth::user()->roleMaster->role_str == 'manager' || Auth::user()->roleMaster->role_str == 'verificator'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Dashboard
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(Auth::user()->roleMaster->role_str != 'user'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('reservations.index')); ?>">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Manage Reservation
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if(app()->environment('local')): ?>
                    <marquee width="100%" direction="left" height="20px" scrollamount="10" loop="infinite" class="text-white bg-primary font-weight-bold d-flex align-items-center">
                    THIS WEBSITE IS RUNNING ON LOCAL/DEVELOPMENT ENVIRONMENT ||| CURRENTLY BEING DEVELOPED BY DEV TEAM, CENTER FOR COMMUNICATION AND INFORMATION TECHNOLOGY ||| MINISTRY OF FOREIGN AFFAIRS OF THE REPUBLIC OF INDONESIA
                    </marquee>
                    <?php endif; ?>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="page">
                        <div class="content">
                            <div class="container-xxl">
                                <?php echo e($slot ?? 'content cannot be rendered'); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('layouts.navigation.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo e($script ?? ''); ?>

    <!-- Libs JS -->
    <script src="<?php echo e(asset('../build/assets/libs/apexcharts/dist/apexcharts.min.js?1692870487')); ?>" defer></script>
    <script src="<?php echo e(asset('../build/assets/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487')); ?>" defer></script>
    <script src="<?php echo e(asset('../build/assets/libs/jsvectormap/dist/maps/world.js?1692870487')); ?>" defer></script>
    <script src="<?php echo e(asset('../build/assets/libs/jsvectormap/dist/maps/world-merc.js?1692870487')); ?>" defer></script>
    <!-- Tabler Core -->
    <script src="<?php echo e(asset('../build/assets/js/tabler.min.js?1692870487')); ?>" defer></script>
    <script src="<?php echo e(asset('../build/assets/js/demo.min.js?1692870487')); ?>" defer></script>

</body>

</html>
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views/components/landing-layout.blade.php ENDPATH**/ ?>