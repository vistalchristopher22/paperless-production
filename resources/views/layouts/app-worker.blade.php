<!doctype html>
<html lang="en">

<!-- Head -->

<head>
    <!-- Page Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Font-->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"> --}}

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/css/libs.bundle.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/theme.bundle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">



    @routes


    <!-- Page Title -->
    <title>{{ config('app.name') }} | @yield('page-title')</title>
    {{-- <style>
        body {
            font-family: Inter, sans-serif !important;
        }
    </style> --}}

    <!-- Scripts -->
    @stack('page-css')

    {{-- @vite(['resources/js/app.js']) --}}


    <style>
        <style>.kanban-board {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .kanban-column {
            /* background-color: #f2f3f6; */
            padding: 10px;
            padding-right: 32px;
            border-radius: 5px;
            margin-bottom: 20px;
            flex-basis: calc(33.33% -20px);
            /* max-width: calc(33.33% - 20px); */
        }

        .kanban-column h2 {
            margin-top: 0;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .kanban-card {
            /* background-color: #ffffff; */
            background-color: #07073d;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            cursor: move;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .kanban-card h3 {
            margin-top: 0;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .kanban-card p {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .kanban-card-placeholder {
            border: 2px dashed #07073d;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            height: 100px;
            margin-bottom: 10px;
            letter-spacing: 1.1px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.1rem;
            font-weight: bold;
            color: #999;
        }

        ol {
            list-stype: decimal;
        }
    </style>

</head>

<body class="">

    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom py-0 fixed-top bg-white">
        <div class="container-fluid">
            <a class="navbar-brand d-flex justify-content-start align-items-center border-end" href="/index.html">
                <div class="d-flex align-items-center">
                    <svg class="f-w-5 me-2 text-primary d-flex align-self-center lh-1"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 203.58 182">
                        <path
                            d="M101.66,41.34C94.54,58.53,88.89,72.13,84,83.78A21.2,21.2,0,0,1,69.76,96.41,94.86,94.86,0,0,0,26.61,122.3L81.12,0h41.6l55.07,123.15c-12-12.59-26.38-21.88-44.25-26.81a21.22,21.22,0,0,1-14.35-12.69c-4.71-11.35-10.3-24.86-17.53-42.31Z"
                            fill="currentColor" fill-rule="evenodd" fill-opacity="0.5" />
                        <path
                            d="M0,182H29.76a21.3,21.3,0,0,0,18.56-10.33,63.27,63.27,0,0,1,106.94,0A21.3,21.3,0,0,0,173.82,182h29.76c-22.66-50.84-49.5-80.34-101.79-80.34S22.66,131.16,0,182Z"
                            fill="currentColor" fill-rule="evenodd" />
                    </svg>
                    <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">Apollo</span>
                </div>
            </a>
            <div class="d-flex justify-content-between align-items-center flex-grow-1 navbar-actions">

                <!-- Search Bar and Menu Toggle-->
                <div class="d-flex align-items-center">

                    <!-- Menu Toggle-->
                    <div
                        class="menu-toggle cursor-pointer me-4 text-primary-hover transition-color disable-child-pointer">
                        <i class="ri-skip-back-mini-line ri-lg fold align-middle" data-bs-toggle="tooltip"
                            data-bs-placement="right" title="Close menu"></i>
                        <i class="ri-skip-forward-mini-line ri-lg unfold align-middle" data-bs-toggle="tooltip"
                            data-bs-placement="right" title="Open Menu"></i>
                    </div>
                    <!-- / Menu Toggle-->

                </div>
                <!-- / Search Bar and Menu Toggle-->

                <!-- Right Side Widgets-->
                <div class="d-flex align-items-center">
                    <div class="d-none d-sm-flex dropdown mx-1">
                        <button class="btn-action text-muted" type="button" id="notificationsDropdown"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            <span class="f-w-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-100">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                            </span>
                            @if ($notifications->count() !== 0)
                                <span
                                    class="position-absolute top-0 start-50 p-1 bg-success border border-3 border-white rounded-circle mt-n1">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg "
                            aria-labelledby="notificationsDropdown" data-bs-popper="none">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <p class="fw-bolder m-0 text-body">Notifications</p>
                                <span id="notification-count"
                                    class="badge bg-success-faded text-success rounded-pill">
                                    <span id="notification-number">{{ $notifications->count() }}</span>
                                    New</span>
                            </div>
                            <div class="simplebar-wrapper">
                                <div data-pixr-simplebar="" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper"
                                                    style="height: 100%; overflow: hidden scroll;">
                                                    <div class="simplebar-content" id="notification-content"
                                                        style="padding: 0px;">
                                                        <ul class="list-unstyled m-0 pb-4">
                                                            @foreach ($notifications as $notification)
                                                                <li
                                                                    class="d-flex py-1 align-items-start cursor-pointer">
                                                                    <button
                                                                        class="btn-icon bg-primary-faded text-primary fw-bolder me-3 p-3">{{ $notification?->sender_information?->first_name[0] }}</button>
                                                                    <div
                                                                        class="d-flex align-items-start justify-content-between flex-grow-1">
                                                                        <div>
                                                                            <p class="lh-1 mb-2 fw-semibold text-body">
                                                                                {{ $notification->sender_information->first_name }}
                                                                                {{ $notification->sender_information->last_name }}
                                                                            </p>
                                                                            <p class="text-muted lh-1 mb-2 small">
                                                                                {{ $notification->description }} </p>
                                                                        </div>
                                                                        <small
                                                                            class="text-muted fw-bold fs-xs">{{ $notification->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: auto; height: 352px;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar simplebar-visible"
                                            style="width: 0px; display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                        <div class="simplebar-scrollbar simplebar-visible"
                                            style="height: 82px; display: block; transform: translate3d(0px, 0px, 0px);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div><a class="dropdown-item text-primary fw-bolder text-center border-top pt-3"
                                    href="#">See more →</a></div>
                        </div>
                    </div>

                    <!-- Messages-->
                    <button class="btn-action mx-3" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasSubmittedAgenda" aria-controls="offcanvasSubmittedAgenda">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>

                        <span class="f-w-4 text-muted">
                            <span class="badge bg-dark">
                                {{ $onReviewData->count() }}
                            </span>
                        </span>
                    </button> <!-- / Messages-->

                    <!-- Apps-->
                    <!-- Profile Menu-->
                    <div class="dropdown ms-1">
                        <button class="btn btn-link p-0 position-relative" type="button" id="profileDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <picture>
                                <img class="f-w-10 rounded-circle"
                                    src="{{ asset('/storage/user-images/' . auth()->user()->profile_picture) }}"
                                    alt="Profile Picture">
                            </picture>
                            <span
                                class="position-absolute bottom-0 start-75 p-1 bg-success border border-3 border-white rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-md dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li class="d-flex py-2 align-items-start">
                                <button
                                    class="btn-icon bg-primary-faded text-primary fw-bolder me-3">{{ Str::substr(auth()->user()->first_name, 0, 1) }}</button>
                                <div class="d-flex align-items-start justify-content-between flex-grow-1">
                                    <div>
                                        <p class="lh-1 mb-2 fw-semibold text-body text-capitalize">
                                            {{ auth()->user()->last_name }},
                                            {{ auth()->user()->first_name }}</p>
                                        <p class="text-muted lh-1 mb-2 small">{{ auth()->user()->account_type }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('information.edit') }}">Account Settings</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center"
                                        href="#">Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div> <!-- / Profile Menu-->

                </div>
                <!-- / Notifications & Profile-->
            </div>
        </div>
    </nav> <!-- / Navbar-->

    <!-- Page Content -->
    <main id="main">

        <!-- Breadcrumbs-->
        <div class="bg-white border-bottom py-3 mb-5">
            <div
                class="container-fluid d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
                <nav class="mb-0" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield(
                            'page-title',
                            'Default Page
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            title'
                        )</li>
                    </ol>
                </nav>

            </div>
        </div> <!-- / Breadcrumbs-->

        <!-- Content-->
        <section class="container-fluid">

            <!-- Page Title-->
            {{-- <h2 class="fs-4 mb-2">@yield('page-title', 'Default Page title')</h2>
    <p class="text-muted mb-4">@yield('page-description', 'Default Page description')</p> --}}
            <!-- / Page Title-->

            @yield('content')

            <!-- Footer -->
            <footer class="  footer">
                <p class="small text-muted m-0">All rights reserved | © {{ config('app.name') }} -
                    {{ date('Y') }}
                </p>
                <p class="small text-muted m-0">Template created by <a
                        href="https://www.pixelrocket.store/">PixelRocket</a></p>
            </footer>


            <!-- Sidebar Menu Overlay-->
            <div class="menu-overlay-bg"></div>
            <!-- / Sidebar Menu Overlay-->

            <!-- Modal Imports-->
            <!-- Place your modal imports here-->

            <!-- Default Example Modal Import-->
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Here goes modal body content
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Offcanvas Imports-->
            <!-- Place your offcanvas imports here-->

            <!-- Default Example Offcanvas Import-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                        images, lists, etc.
                    </div>
                    <div class="dropdown mt-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Message Offcanvas Import-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSubmittedAgenda"
                aria-labelledby="offcanvasSubmittedAgendaLabel" data-bs-backdrop="false" data-bs-scroll="true">
                <div class="offcanvas-header position-relative">
                    <div class="d-flex flex-row w-100 justify-content-between align-items-center">
                        <h6 class="offcanvas-title text-uppercase text-dark fw-bold"
                            id="offcanvasSubmittedAgendaLabel">
                            Submitted Agenda</h6>
                        <a class="cursor-pointer text-danger" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="fas fa-times fa-2x"></i>
                        </a>
                    </div>

                </div>
                <div class="offcanvas-body h-100 d-flex justify-content-between flex-column pb-0 shadow">
                    <div class="overflow-auto py-4">
                        <div class="overflow-hidden">
                            <ol class="kanban-cards" id="offcanvas-cards" style="padding-left : 0px;">
                                @foreach ($onReviewData as $committee)
                                    <span class="text-dark submitted-by" style="pointer-events:none;"
                                        id="parent-index-{{ $loop->index }}">
                                        {{ $committee->submitted->last_name }},
                                        {{ $committee->submitted->first_name }}
                                    </span>
                                    <span class="count-index"> </span>
                                    <li class="kanban-card text-white" data-id="{{ $committee->id }}"
                                        data-index="{{ $loop->index }}">
                                        {{ $committee->lead_committee_information->title }}
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div> <!-- / Footer-->

        </section>
        <!-- / Content-->

    </main>
    <!-- /Page Content -->

    <!-- Page Aside-->
    <aside class="aside bg-white">

        <div class="simplebar-wrapper">
            <div data-pixr-simplebar>
                <div class="pb-6">
                    <!-- Mobile Logo-->
                    <div
                        class="d-flex d-xl-none justify-content-between align-items-center border-bottom aside-header">
                        <a class="navbar-brand lh-1 border-0 m-0 d-flex align-items-center" href="/index.html">
                            <div class="d-flex align-items-center">
                                <svg class="f-w-5 me-2 text-primary d-flex align-self-center lh-1"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 203.58 182">
                                    <path
                                        d="M101.66,41.34C94.54,58.53,88.89,72.13,84,83.78A21.2,21.2,0,0,1,69.76,96.41,94.86,94.86,0,0,0,26.61,122.3L81.12,0h41.6l55.07,123.15c-12-12.59-26.38-21.88-44.25-26.81a21.22,21.22,0,0,1-14.35-12.69c-4.71-11.35-10.3-24.86-17.53-42.31Z"
                                        fill="currentColor" fill-rule="evenodd" fill-opacity="0.5" />
                                    <path
                                        d="M0,182H29.76a21.3,21.3,0,0,0,18.56-10.33,63.27,63.27,0,0,1,106.94,0A21.3,21.3,0,0,0,173.82,182h29.76c-22.66-50.84-49.5-80.34-101.79-80.34S22.66,131.16,0,182Z"
                                        fill="currentColor" fill-rule="evenodd" />
                                </svg>
                                <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">Apollo</span>
                            </div>
                        </a>
                        <i
                            class="ri-close-circle-line ri-lg close-menu text-muted transition-all text-primary-hover me-4 cursor-pointer"></i>
                    </div>
                    <!-- / Mobile Logo-->

                    <ul class="list-unstyled mb-6">

                        <!-- Dashboard Menu Section-->
                        <li class="menu-section mt-2">Menu</li>
                        <li class="menu-item"><a class="d-flex align-items-center" href="{{ route('home') }}">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3"
                                            width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="14" y="3" width="7"
                                            height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14"
                                            width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7"
                                            height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link">
                                    Dashboard
                                </span></a></li>
                        <!-- / Dashboard Menu Section-->


                        @feature('administrator')
                            <li class="menu-item">
                                <a class="d-flex align-items-center collapsed"
                                    href="{{ route('sanggunian-members.index') }}">
                                    <span class="menu-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                            y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path fill="currentColor" opacity=".5"
                                                d="M155.327,57.142c-51.531,0-93.454,44.45-93.454,99.086c0,54.636,41.923,99.086,93.454,99.086s93.455-44.45,93.455-99.086
                                           C248.782,101.592,206.859,57.142,155.327,57.142z" />

                                            <path fill="currentColor"
                                                d="M367.798,71.321c-0.211,0-0.425,0.001-0.636,0.002c-21.626,0.179-41.826,9.31-56.878,25.713
                                           c-14.788,16.113-22.829,37.37-22.644,59.854c0.186,22.484,8.577,43.605,23.628,59.473c15.17,15.991,35.265,24.773,56.651,24.773
                                           c0.215,0,0.43-0.001,0.646-0.002c21.626-0.179,41.826-9.311,56.878-25.713c14.788-16.113,22.829-37.37,22.644-59.855
                                           C447.702,108.972,411.747,71.321,367.798,71.321z" />

                                            <path fill="currentColor"
                                                d="M371.74,257.358h-7.76c-36.14,0-69.12,13.74-94.02,36.26c6.23,4.78,12.16,9.99,17.78,15.61
                                           c16.58,16.58,29.6,35.9,38.7,57.42c8.2,19.38,12.88,39.8,13.97,60.83H512v-29.87C512,320.278,449.08,257.358,371.74,257.358z" />

                                            <path fill="currentColor" opacity=".5"
                                                d="M310.35,427.478c-2.83-45.59-25.94-85.69-60.43-111.39c-25.09-18.7-56.21-29.77-89.92-29.77h-9.34
                                           C67.45,286.319,0,353.768,0,436.978v17.88h310.65v-17.88C310.65,433.788,310.55,430.618,310.35,427.478z" />

                                        </svg>
                                    </span>
                                    <span class="menu-link">SP Members</span></a>
                            </li>
                            <li class="menu-item">
                                <a class="d-flex align-items-center collapsed" href="{{ route('settings.index') }}">
                                    <span class="menu-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                        </svg>
                                    </span>
                                    <span class="menu-link">Settings</span></a>
                            </li>
                        @endfeature


                        <!-- Dashboard Menu Section-->
                        <li class="menu-section mt-4">Data</li>
                        <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                data-bs-toggle="collapse" data-bs-target="#collapseMaintenance" aria-expanded="false"
                                aria-controls="collapseMaintenance">
                                <span class="menu-icon">
                                    <svg enable-background="new 0 0 520 520" viewBox="0 0 520 520"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path fill="currentColor"
                                                d="m481.734 100.063h-158.331l-43.111-70.397c-2.727-4.452-7.571-7.166-12.792-7.166h-119.235c-21.099 0-38.265 17.166-38.265 38.266v65.51 229.184c0 21.1 17.166 38.266 38.265 38.266h261.735 71.734c21.1 0 38.266-17.166 38.266-38.266v-217.13c0-21.101-17.166-38.267-38.266-38.267z" />
                                            <path fill="currentColor" opacity=".5"
                                                d="m80 355.459v-229.184h-41.734c-21.1 0-38.266 17.166-38.266 38.266v294.693c0 21.1 17.166 38.266 38.266 38.266h333.469c21.1 0 38.266-17.166 38.266-38.266v-35.51h-261.736c-37.641.001-68.265-30.623-68.265-68.265z" />
                                        </g>
                                    </svg>
                                </span>
                                <span class="menu-link">Maintenance</span></a>
                            <div class="collapse" id="collapseMaintenance">
                                <ul class="submenu">
                                    @feature('user')
                                        <li><a href="{{ route('user.committee.index') }}">Committees</a></li>
                                    @endfeature
                                    @feature('administrator')
                                        <li><a href="{{ route('schedules.index') }}">Schedules</a></li>
                                        <li><a href="{{ route('committee.index') }}">Committees</a></li>
                                        <li><a href="{{ route('board-sessions.index') }}">Sessions</a></li>
                                        <li><a href="{{ route('agendas.index') }}">Agendas</a></li>
                                        <li><a href="{{ route('division.index') }}">Divisions</a></li>
                                    @endfeature
                                </ul>
                            </div>
                        </li>


                        <!-- Pages Menu Section-->
                        @feature('administrator')
                            <li class="menu-section mt-4">User Management</li>
                            <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                    data-bs-toggle="collapse" data-bs-target="#collapseMenuItemUsers"
                                    aria-expanded="false" aria-controls="collapseMenuItemUsers">
                                    <span class="menu-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                            y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path fill="currentColor" opacity=".5"
                                                d="M155.327,57.142c-51.531,0-93.454,44.45-93.454,99.086c0,54.636,41.923,99.086,93.454,99.086s93.455-44.45,93.455-99.086
                                           C248.782,101.592,206.859,57.142,155.327,57.142z" />

                                            <path fill="currentColor"
                                                d="M367.798,71.321c-0.211,0-0.425,0.001-0.636,0.002c-21.626,0.179-41.826,9.31-56.878,25.713
                                           c-14.788,16.113-22.829,37.37-22.644,59.854c0.186,22.484,8.577,43.605,23.628,59.473c15.17,15.991,35.265,24.773,56.651,24.773
                                           c0.215,0,0.43-0.001,0.646-0.002c21.626-0.179,41.826-9.311,56.878-25.713c14.788-16.113,22.829-37.37,22.644-59.855
                                           C447.702,108.972,411.747,71.321,367.798,71.321z" />

                                            <path fill="currentColor"
                                                d="M371.74,257.358h-7.76c-36.14,0-69.12,13.74-94.02,36.26c6.23,4.78,12.16,9.99,17.78,15.61
                                           c16.58,16.58,29.6,35.9,38.7,57.42c8.2,19.38,12.88,39.8,13.97,60.83H512v-29.87C512,320.278,449.08,257.358,371.74,257.358z" />

                                            <path fill="currentColor" opacity=".5"
                                                d="M310.35,427.478c-2.83-45.59-25.94-85.69-60.43-111.39c-25.09-18.7-56.21-29.77-89.92-29.77h-9.34
                                           C67.45,286.319,0,353.768,0,436.978v17.88h310.65v-17.88C310.65,433.788,310.55,430.618,310.35,427.478z" />

                                        </svg>
                                    </span>
                                    <span class="menu-link">Users</span></a>
                                <div class="collapse" id="collapseMenuItemUsers">
                                    <ul class="submenu">
                                        <li><a href="{{ route('account.index') }}">Listing</a></li>
                                        <li><a href="{{ route('account-access-control.index') }}">Access Control</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-section mt-4">Archieves</li>
                            <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                    data-bs-toggle="collapse" data-bs-target="#collapseMenuArchieves"
                                    aria-expanded="false" aria-controls="collapseMenuArchieves">
                                    <span class="menu-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                            y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path fill="currentColor" opacity=".5"
                                                d="M155.327,57.142c-51.531,0-93.454,44.45-93.454,99.086c0,54.636,41.923,99.086,93.454,99.086s93.455-44.45,93.455-99.086
                                           C248.782,101.592,206.859,57.142,155.327,57.142z" />

                                            <path fill="currentColor"
                                                d="M367.798,71.321c-0.211,0-0.425,0.001-0.636,0.002c-21.626,0.179-41.826,9.31-56.878,25.713
                                           c-14.788,16.113-22.829,37.37-22.644,59.854c0.186,22.484,8.577,43.605,23.628,59.473c15.17,15.991,35.265,24.773,56.651,24.773
                                           c0.215,0,0.43-0.001,0.646-0.002c21.626-0.179,41.826-9.311,56.878-25.713c14.788-16.113,22.829-37.37,22.644-59.855
                                           C447.702,108.972,411.747,71.321,367.798,71.321z" />

                                            <path fill="currentColor"
                                                d="M371.74,257.358h-7.76c-36.14,0-69.12,13.74-94.02,36.26c6.23,4.78,12.16,9.99,17.78,15.61
                                           c16.58,16.58,29.6,35.9,38.7,57.42c8.2,19.38,12.88,39.8,13.97,60.83H512v-29.87C512,320.278,449.08,257.358,371.74,257.358z" />

                                            <path fill="currentColor" opacity=".5"
                                                d="M310.35,427.478c-2.83-45.59-25.94-85.69-60.43-111.39c-25.09-18.7-56.21-29.77-89.92-29.77h-9.34
                                           C67.45,286.319,0,353.768,0,436.978v17.88h310.65v-17.88C310.65,433.788,310.55,430.618,310.35,427.478z" />

                                        </svg>
                                    </span>
                                    <span class="menu-link">Source</span></a>
                                <div class="collapse" id="collapseMenuArchieves">
                                    <ul class="submenu">
                                        <li><a href="{{ route('files.index') }}">File Manager</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endfeature

                        {{-- SB MEMBER ACCESS --}}
                        @feature('sb-member')
                            <li class="menu-section mt-4">Archieves</li>
                            <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                    data-bs-toggle="collapse" data-bs-target="#collapseMenuArchieves"
                                    aria-expanded="false" aria-controls="collapseMenuArchieves">
                                    <span class="menu-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                            y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path fill="currentColor" opacity=".5"
                                                d="M155.327,57.142c-51.531,0-93.454,44.45-93.454,99.086c0,54.636,41.923,99.086,93.454,99.086s93.455-44.45,93.455-99.086
                                           C248.782,101.592,206.859,57.142,155.327,57.142z" />

                                            <path fill="currentColor"
                                                d="M367.798,71.321c-0.211,0-0.425,0.001-0.636,0.002c-21.626,0.179-41.826,9.31-56.878,25.713
                                           c-14.788,16.113-22.829,37.37-22.644,59.854c0.186,22.484,8.577,43.605,23.628,59.473c15.17,15.991,35.265,24.773,56.651,24.773
                                           c0.215,0,0.43-0.001,0.646-0.002c21.626-0.179,41.826-9.311,56.878-25.713c14.788-16.113,22.829-37.37,22.644-59.855
                                           C447.702,108.972,411.747,71.321,367.798,71.321z" />

                                            <path fill="currentColor"
                                                d="M371.74,257.358h-7.76c-36.14,0-69.12,13.74-94.02,36.26c6.23,4.78,12.16,9.99,17.78,15.61
                                           c16.58,16.58,29.6,35.9,38.7,57.42c8.2,19.38,12.88,39.8,13.97,60.83H512v-29.87C512,320.278,449.08,257.358,371.74,257.358z" />

                                            <path fill="currentColor" opacity=".5"
                                                d="M310.35,427.478c-2.83-45.59-25.94-85.69-60.43-111.39c-25.09-18.7-56.21-29.77-89.92-29.77h-9.34
                                           C67.45,286.319,0,353.768,0,436.978v17.88h310.65v-17.88C310.65,433.788,310.55,430.618,310.35,427.478z" />

                                        </svg>
                                    </span>
                                    <span class="menu-link">Source</span></a>
                                <div class="collapse" id="collapseMenuArchieves">
                                    <ul class="submenu">
                                        <li><a href="#">File Manager</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endfeature

                        {{-- NORMAL USERS ACCESS --}}
                        @feature('user')
                            <li class="menu-section mt-4">Archieves</li>
                            <li class="menu-item"><a class="d-flex align-items-center collapsed" href="#"
                                    data-bs-toggle="collapse" data-bs-target="#collapseMenuArchieves"
                                    aria-expanded="false" aria-controls="collapseMenuArchieves">
                                    <span class="menu-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                                            y="0px" viewBox="0 0 512 512"
                                            style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path fill="currentColor" opacity=".5"
                                                d="M155.327,57.142c-51.531,0-93.454,44.45-93.454,99.086c0,54.636,41.923,99.086,93.454,99.086s93.455-44.45,93.455-99.086
                                           C248.782,101.592,206.859,57.142,155.327,57.142z" />

                                            <path fill="currentColor"
                                                d="M367.798,71.321c-0.211,0-0.425,0.001-0.636,0.002c-21.626,0.179-41.826,9.31-56.878,25.713
                                           c-14.788,16.113-22.829,37.37-22.644,59.854c0.186,22.484,8.577,43.605,23.628,59.473c15.17,15.991,35.265,24.773,56.651,24.773
                                           c0.215,0,0.43-0.001,0.646-0.002c21.626-0.179,41.826-9.311,56.878-25.713c14.788-16.113,22.829-37.37,22.644-59.855
                                           C447.702,108.972,411.747,71.321,367.798,71.321z" />

                                            <path fill="currentColor"
                                                d="M371.74,257.358h-7.76c-36.14,0-69.12,13.74-94.02,36.26c6.23,4.78,12.16,9.99,17.78,15.61
                                           c16.58,16.58,29.6,35.9,38.7,57.42c8.2,19.38,12.88,39.8,13.97,60.83H512v-29.87C512,320.278,449.08,257.358,371.74,257.358z" />

                                            <path fill="currentColor" opacity=".5"
                                                d="M310.35,427.478c-2.83-45.59-25.94-85.69-60.43-111.39c-25.09-18.7-56.21-29.77-89.92-29.77h-9.34
                                           C67.45,286.319,0,353.768,0,436.978v17.88h310.65v-17.88C310.65,433.788,310.55,430.618,310.35,427.478z" />

                                        </svg>
                                    </span>
                                    <span class="menu-link">Source</span></a>
                                <div class="collapse" id="collapseMenuArchieves">
                                    <ul class="submenu">
                                        <li><a href="#">File Manager</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endfeature
                        <!-- / Pages Menu Section-->

                    </ul>
                </div>
            </div>
        </div>

    </aside> <!-- / Page Aside-->
    <script>
        var sharedWorker = new SharedWorker('https://tsp_legislatesys.test/socket-worker.js');
        sharedWorker.port.onmessage = function(event) {
            console.log('Received message from shared worker:', event.data);
            // Perform some action with the message...
        };
        sharedWorker.port.postMessage('Hello from the main thread!');
        // if ('serviceWorker' in navigator) {
        //     window.addEventListener('load', function() {
        //         navigator.serviceWorker.register('https://tsp_legislatesys.test/socket-worker.js')
        //             .then(function(registration) {
        //                 console.log('Service worker registered:', registration);
        //             })
        //             .catch(function(error) {
        //                 console.log('Service worker registration failed:', error);
        //             });
        //     });
        // } else {
        //     console.log('no service worker in navigator');
        // }
    </script>



</body>

</html>
