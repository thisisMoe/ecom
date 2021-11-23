<!--

=========================================================
* Pixel Free Bootstrap 5 UI Kit
=========================================================

* Product Page: https://themesberg.com/product/ui-kit/pixel-free-bootstrap-5-ui-kit
* Copyright 2021 Themesberg (https://www.themesberg.com)

* Coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Contact us if you want to remove it.

-->
@php
$ar = app()->getLocale() === 'ar';
@endphp

<!DOCTYPE html>
<html @if ($ar)
dir="rtl"
lang="ar"
@else
lang="fr"
@endif
>

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MP5BKTB');
    </script>
    <!-- End Google Tag Manager -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>DZ-AliExpress | {{ __('Service de commandes de produits AliExpress pour l’Algérie') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="DZ-AliExpress">
    <meta name="author" content="bounoua.smm@gmail.com">
    <meta name="description"
        content="Commandez vos produits chez AliExpress en 30 secondes et payer en Dinar Algérien. Copiez le lien de n’importe quel produit que vous aimez d’AliExpress, Mettez le lien dans notre barre de recherche et nous nous occupons du reste jusqu’à la livraison en Algérie">

    <meta property="og:description"
        content="Commandez vos produits chez AliExpress en 30 secondes et payer en Dinar Algérien. Copiez le lien de n’importe quel produit que vous aimez d’AliExpress, Mettez le lien dans notre barre de recherche et nous nous occupons du reste jusqu’à la livraison en Algérie" />
    <meta property="og:image" content="{{ asset('assets/img/meta-image.png') }}" />


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">

    <meta name="propeller" content="caf5815fc94b8040fd6f80f7c8b3013d">

    @if (Auth::check())
        <meta name="user_id" content="{{ Auth::user()->id }}" />
    @endif

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- Pixel CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous"> --}}

    {{-- @if ($ar)
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @endif --}}

    <link type="text/css" href="{{ asset('css/pixel.mini.css') }}" rel="stylesheet">

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .hor-scroll-bar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hor-scroll-bar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

    </style>

    @yield('head')

    @include('partials.analytics')

</head>

<body class="active">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MP5BKTB" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper">
        @yield('sidebar')

        <div id="content">
            <header class="header-global">
                <nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-main navbar-expand-lg navbar-theme-primary headroom navbar-dark">
                    <div class="container position-relative">
                        <a class="navbar-brand me-lg-5" style="padding: 0;" href="{{ route('home') }}">
                            <img class="navbar-brand-dark" src="{{ asset('assets/img/brand/logo-white-trans.png') }}" alt="Logo light">
                            <img class="navbar-brand-light" src="{{ asset('assets/img/brand/logo-white-trans.png') }}" alt="Logo dark">
                        </a>
                        <div class="navbar-collapse collapse me-auto" id="navbar_global">
                            <div class="navbar-collapse-header">
                                <div class="row">
                                    <div class="col-6 collapse-brand">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('assets/img/brand/logo-white-trans.png') }}" alt="Themesberg logo">
                                        </a>
                                    </div>
                                    <div class="col-6 collapse-close">
                                        <a href="#navbar_global" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#navbar_global"
                                            aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                                    </div>
                                </div>
                            </div>
                            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                                <li class="nav-item">
                                    <a href="/products" class="nav-link" aria-expanded="false">
                                        {{ __('Recherche') }} <i class="fas fa-search"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/searchProduct" class="nav-link" aria-expanded="false">
                                        {{ __('Recherche AliExpress') }} <img src="{{ asset('assets/img/aliexpess-icon.png') }}" style="opacity:1" alt="">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('tracking') }}" class="nav-link" aria-expanded="false">
                                        {{ __('Tracking') }} <i class="fas fa-shipping-fast"></i>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="supportDropdown" aria-expanded="false">
                                        {{ __('Support') }}
                                        <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="supportDropdown">
                                        <div class="col-auto px-0">
                                            <div class="list-group list-group-flush">
                                                <a href="/#howTo"
                                                    class="list-group-item list-group-item-action gap-3 d-flex align-items-center p-0 py-3 px-lg-4">
                                                    <span class="icon icon-sm">
                                                        <span class="fas fa-cart-arrow-down"></span>
                                                    </span>
                                                    <div class="ms-4">
                                                        <span class="d-block font-small fw-bold mb-0">
                                                            {{ __('Comment ça marche?') }}
                                                        </span>
                                                        <span class="small">{{ __('Guides et examples') }}</span>
                                                    </div>
                                                </a>
                                                <a href="{{ route('faq') }}" target=""
                                                    class="list-group-item list-group-item-action gap-3 d-flex align-items-center p-0 py-3 px-lg-4">
                                                    <span class="icon icon-sm">
                                                        <span class="fas fa-microphone-alt"></span>
                                                    </span>
                                                    <div class="ms-4">
                                                        <span class="d-block font-small fw-bold mb-0">
                                                            {{ __('Questions Fréquentes') }}
                                                        </span>
                                                        <span class="small">{{ __('Besoin d’aide? Demandez-nous!') }}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('about_us') }}" class="nav-link" aria-expanded="false">
                                        {{ __('A Propos de Nous') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" class="nav-link" aria-expanded="false">
                                        {{ __('Contact') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="ml-3 d-flex align-items-center gap-3">
                            @auth
                                <div class="dropdown">
                                    <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{-- <i style="font-size: 1.2rem; padding-left: 2px; padding-right: 2px;" class="far fa-user"></i> --}}
                                        <img width="32px" src="{{ asset('assets/img/user-profile.png') }}" alt="">
                                    </a>

                                    <ul class="dropdown-menu" style="left:-20px" aria-labelledby="dropdownMenuLink">
                                        @if (Auth::user()->role == 'admin')
                                            <li><a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a>
                                            </li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ route('panier') }}">{{ __('Mon Panier') }} <span
                                                    class="badge bg-info">{{ Auth::user()->cartCount() }}</span></a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('account') }}">{{ __('Mes Commandes') }} <span
                                                    class="badge bg-info">{{ Auth::user()->ordersCount() }}</span></a>
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="dropdown-item" type="submit">{{ __('Se Déconnecter') }}</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="">
                                    <img src="{{ asset('assets/img/lock.png') }}" width="32px" alt="Login">
                                </a>
                            @endauth
                            <div class="">
                                @include('partials/language_switcher')
                            </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="preloader bg-dark flex-column justify-content-center align-items-center">
                    <svg id="loader-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        style="margin: auto;background: none;display: block;shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100"
                        preserveAspectRatio="xMidYMid">
                        <path fill="none" stroke="#ffffff" stroke-width="8" stroke-dasharray="42.76482137044271 42.76482137044271"
                            d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z"
                            stroke-linecap="round" style="transform: scale(0.7100000000000001);transform-origin: 50px 50px;">
                            <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1.075268817204301s" keyTimes="0;1"
                                values="0;256.58892822265625">
                            </animate>
                        </path>
                    </svg>
                </div>

                @yield('content')

            </main>
            <footer class="footer pt-6 pb-5 bg-primary text-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <img class="navbar-brand-dark logo-size" height="35" src="{{ asset('assets/img/brand/logo-white-trans.png') }}"
                                    alt="Logo light">
                                <span class="fs-5">DZ AliExpress</span>
                            </div>
                            <p class="mt-4">
                                {{ __("Notre rôle est d'offrir la possibilité d'achat et de suivi de produits AliExpress conforme à la règlementation algérienne des produits importés à tous les citoyens algériens sur tout le territoire national") }}
                            </p>
                            <ul class="social-buttons mb-5 mb-lg-0">
                                <li>
                                    <a href="https://www.facebook.com/DZ.ALIEXPRESS.service" class="icon-white me-2" aria-label="facebook social link">
                                        <span class="fab fa-facebook"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/dz_ali.express/" class="icon-white me-2" aria-label="dribbble social link">
                                        <span class="fab fa-instagram"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" aria-label="twitter social link" class="icon-white me-2">
                                        <span class="fab fa-twitter"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="col-6 col-md-2 mb-5 mb-lg-0">
                    <span class="h5">Themesberg</span>
                    <ul class="footer-links mt-2">
                        <li><a target="_blank" href="https://themesberg.com/blog">Blog</a></li>
                        <li><a target="_blank" href="https://themesberg.com/themes">Themes</a></li>
                        <li><a target="_blank" href="https://themesberg.com/about">About Us</a></li>
                        <li><a target="_blank" href="https://themesberg.com/contact">Contact Us</a></li>
                    </ul>
                </div> --}}
                        <div class="col-6 col-md-2 mb-5 mb-lg-0">
                            <span class="h5">{{ __('Liens') }}</span>
                            <ul class="footer-links mt-2">
                                <li><a target="_blank" href="#">{{ __('Qui Sommes-Nous?') }}</a></li>
                                <li><a target="_blank" href="#">{{ __('Support') }}</a></li>
                                <li><a target="_blank" href="#">{{ __('Politique de Confidentialité') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 mb-5 mb-lg-0">
                            <span class="h5">{{ __('Contact') }}</span>
                            <p class="text-muted font-small mt-2">
                                {{ __('Nous travaillons de 9 h à 23 h tous les jours, vous pouvez nous appeler à tout moment') }}
                            </p>
                            <div class="form-row mb-2">
                                <div class="col-12 mb-3">
                                    <a href="tel:+213776451985" class="mb-2 d-block"><span class="fas fa-phone-square-alt"></span> +213776451985</a>
                                    <a href="tel:+213558494325" class="mb-2 d-block"><span class="fas fa-phone-square-alt"></span> +213558494325</a>
                                    <a href="tel:+213555959606" class="mb-2 d-block"><span class="fas fa-phone-square-alt"></span> +213555959606</a>

                                </div>
                                <div class="col-12 d-grid">
                                    <a href="{{ route('contact') }}" class="btn btn-tertiary" data-loading-text="Sending">
                                        <span>{{ __('Nous Contacter') }}</span>
                                    </a>
                                </div>
                            </div>

                            <p class="text-muted font-small m-0">
                                {{ __('Nous ne partagerons jamais vos données. Voir notre') }}
                                <a class="text-white" href="#">
                                    {{ __('Politique de Confidentialité') }}
                                </a>
                            </p>
                        </div>
                        {{-- <div class="col-12 col-md-4 mb-5 mb-lg-0">
                    <span class="h5">Subscribe</span>
                    <p class="text-muted font-small mt-2">Join our mailing list. We write rarely, but only the best content.
                    </p>
                    <form action="#">
                        <div class="form-row mb-2">
                            <div class="col-12">
                                <label class="h6 fw-normal text-muted d-none" for="exampleInputEmail3">Email address</label>
                                <input type="email" class="form-control mb-2" placeholder="example@company.com" name="email" aria-label="Subscribe form"
                                    id="exampleInputEmail3" required>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-tertiary" data-loading-text="Sending">
                                    <span>Subscribe</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="text-muted font-small m-0">We’ll never share your details. See our <a class="text-white" href="#">Privacy Policy</a></p>
                </div> --}}
                    </div>
                    <hr class="bg-secondary my-3 my-lg-5">
                    <div class="row">
                        <div class="col mb-md-0">
                            <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
                                <p class="fw-normal font-small mb-0">{{ __('Copyright') }} © DZ-ALIEXPRESS 2021. {{ __('All rights reserved.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="overlay"></div>

    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/headroom.js@0.12.0/dist/headroom.min.js"></script>

    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
    <script src="{{ asset('vendor/jarallax/dist/jarallax.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vivus@0.4.6/dist/vivus.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker.min.js"></script>


    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Pixel JS -->
    <script src="{{ asset('js/pixel.js') }}"></script>

    @yield('scripts')

</body>

</html>
