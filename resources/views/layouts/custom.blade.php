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

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Pixel - Free Bootstrap 5 UI Kit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Pixel - Free Bootstrap 5 UI Kit">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Open source and free Bootstrap 5 UI Kit featuring 80 UI components, 5 example pages, and a Gulp and Sass workflow.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link type="text/css" href="{{ asset('css/pixel.mini.css') }}" rel="stylesheet">


</head>

<body>

    <header class="header-global">
        <nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-main navbar-expand-lg navbar-theme-primary headroom navbar-dark">
            <div class="container position-relative">
                <a class="navbar-brand me-lg-5" href="./index.html">
                    <img class="navbar-brand-dark" src="{{ asset('assets/img/brand/light.svg') }}" alt="Logo light">
                    <img class="navbar-brand-light" src="{{ asset('assets/img/brand/dark.svg') }}" alt="Logo dark">
                </a>
                <div class="navbar-collapse collapse me-auto" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="./index.html">
                                    <img src="{{ asset('assets/img/brand/dark.svg') }}" alt="Themesberg logo">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <a href="#navbar_global" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#navbar_global"
                                    aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="supportDropdown" aria-expanded="false">
                                Support
                                <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="supportDropdown">
                                <div class="col-auto px-0">
                                    <div class="list-group list-group-flush">
                                        <a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/" target="_blank"
                                            class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                            <span class="icon icon-sm"><span class="fas fa-file-alt"></span></span>
                                            <div class="ms-4">
                                                <span class="d-block font-small fw-bold mb-0">Documentation<span
                                                        class="badge badge-sm badge-secondary ms-2">v3.1</span></span>
                                                <span class="small">Examples and guides</span>
                                            </div>
                                        </a>
                                        <a href="https://github.com/themesberg/pixel-bootstrap-ui-kit/issues" target="_blank"
                                            class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                            <span class="icon icon-sm"><span class="fas fa-microphone-alt"></span></span>
                                            <div class="ms-4">
                                                <span class="d-block font-small fw-bold mb-0">Support</span>
                                                <span class="small">Need help? Ask us!</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2">
                        @auth

                            <div class="dropstart">
                                <a class="btn btn-white dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i style="font-size: 1.2rem" class="fas fa-user mx-1"></i>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>

                            {{-- <div>
                                <button type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-white position-relative dropdown-toggle dropdown-toggle-split">
                                    <i style="font-size: 1.2rem" class="fas fa-user mx-1"></i>
                                </button>
                                <div class="dropdown-menu py-0" style="">
                                    <a class="dropdown-item rounded-top" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item rounded-bottom" href="#">Separated link</a>
                                </div>
                            </div> --}}
                        @endauth
                    @if (!Route::is("searchProduct"))
                        <a href="" target="" class="btn btn-tertiary position-relative">
                            <div style="">
                                <i style="font-size: 1.2rem" class="fas fa-shopping-cart me-2"></i>
                                <span class="cart-number">
                                    @auth
                                        {{ Auth::user()->cartCount() }}
                                    @else
                                        0
                                    @endauth
                                </span>
                            </div>
                        </a>
                    @endif
                    <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    <main>
        {{-- <div class="preloader bg-dark flex-column justify-content-center align-items-center">
            <svg id="loader-logo" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 64 78.4">
                <path fill="#fff" d="M10,0h1.2V11.2H0V10A10,10,0,0,1,10,0Z" />
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="40" y="17.6" width="0" height="25.6" />
                <rect fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="11.2" x="23" y="35.2" width="0" height="25.6" />
                <path fill="#fff" d="M52.8,35.2H64V53.8a7,7,0,0,1-7,7H52.8V35.2Z" />
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="6" y="52.8" width="0" height="25.6" />
                <path fill="#fff" d="M52.8,0H57a7,7,0,0,1,7,7h0v4.2H52.8V0Z" />
                <rect fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="11.2" x="57.8" y="17.6" width="0" height="11.2" />
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="6" y="35.2" width="0" height="11.2" />
                <rect fill="none" stroke="#fff" stroke-width="11.2" x="40.2" y="49.6" width="0" height="11.2" />
                <path fill="#fff" d="M17.6,67.2H28.8v1.2a10,10,0,0,1-10,10H17.6V67.2Z" />
                <rect fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="28.8" x="31.6" width="0" height="11.2" />
                <rect fill="none" stroke="#fff" x="14" stroke-width="28.8" y="17.6" width="0" height="11.2" />
            </svg>
        </div> --}}

        @yield('content')

    </main>
    <footer class="footer pt-6 pb-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="navbar-brand-dark mb-4" height="35" src="{{ asset('assets/img/brand/light.svg') }}" alt="Logo light">
                    <p>Pixel is a free and open source Bootstrap 5 UI Kit that will help you prototype and build beautiful website pages and applications.</p>
                    <ul class="social-buttons mb-5 mb-lg-0">
                        <li>
                            <a href="https://twitter.com/themesberg" aria-label="twitter social link" class="icon-white me-2">
                                <span class="fab fa-twitter"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/themesberg/" class="icon-white me-2" aria-label="facebook social link">
                                <span class="fab fa-facebook"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/themesberg" aria-label="github social link" class="icon-white me-2">
                                <span class="fab fa-github"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://dribbble.com/themesberg" class="icon-white" aria-label="dribbble social link">
                                <span class="fab fa-dribbble"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-5 mb-lg-0">
                    <span class="h5">Themesberg</span>
                    <ul class="footer-links mt-2">
                        <li><a target="_blank" href="https://themesberg.com/blog">Blog</a></li>
                        <li><a target="_blank" href="https://themesberg.com/themes">Themes</a></li>
                        <li><a target="_blank" href="https://themesberg.com/about">About Us</a></li>
                        <li><a target="_blank" href="https://themesberg.com/contact">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-5 mb-lg-0">
                    <span class="h5">Other</span>
                    <ul class="footer-links mt-2">
                        <li><a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/" target="_blank">Docs</a></li>
                        <li><a href="https://themesberg.com/docs/pixel-bootstrap/getting-started/changelog" target="_blank">Changelog</a></li>
                        <li><a target="_blank" href="https://themesberg.com/licensing">License</a>
                        </li>
                        <li><a target="_blank" href="https://github.com/themesberg/pixel-bootstrap-ui-kit/issues">Support</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 mb-5 mb-lg-0">
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
                </div>
            </div>
            <hr class="bg-secondary my-3 my-lg-5">
            <div class="row">
                <div class="col mb-md-0">
                    <a href="https://themesberg.com" target="_blank" class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('assets/img/themesberg.svg') }}" height="30" class="me-2" alt="Themesberg Logo">
                        <p class="text-white fw-bold footer-logo-text m-0">Themesberg</p>
                    </a>
                    <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
                        <p class="fw-normal font-small mb-0">Copyright © Themesberg 2019-<span class="current-year">2021</span>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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

</body>

</html>
