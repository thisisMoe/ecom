@extends('layouts.custom')
@section('content')
    @php
    $ar = app()->getLocale() === 'ar';
    @endphp
    <!-- Hero -->
    <section class="section-header overflow-hidden pt-7 pt-lg-8 pb-9 pb-lg-12 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="bootstrap-big-icon d-none d-lg-block">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="700" height="622" class="d-block my-1" viewBox="0 0 118 94" role="img">
                                <title>Bootstrap</title>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"
                                    fill="currentColor"></path>
                            </svg> --}}
                        <img src="{{ asset('assets/img/brand/logo-hero.png') }}" alt="Pixel Free Mockup">
                    </div>
                    <h1 class="fw-bolder display-2">DZ AliExpress</h1>
                    <h2 class="lead fw-normal text-muted mb-4 px-lg-10">
                        {{ __('Maintenant, vous pouvez acheter n’importe quoi d’AliExpress en seulement 30 secondes et payer en dinar algérien') }}</h2>
                    <!-- Button Modal -->
                    <div class="d-flex justify-content-center align-items-center mb-5">
                        <form action="{{ route('searchProduct') }}" class="w-100" method="GET">
                            <div class="input-group" @if ($ar)
                                style=" flex-direction: row-reverse;" @endif>
                                <input type="text" name="q" class="form-control" id="searchProduct" placeholder="{{ __('Coller un lien AliExpress ici...') }}"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <button type="submit" class="input-group-text px-4" id="basic-addon2">
                                    <span class="fas fa-search text-primary"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <figure class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n2"><svg class="fill-white" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 3000 185.4">
                <path d="M3000,0v185.4H0V0c496.4,115.6,996.4,173.4,1500,173.4S2503.6,115.6,3000,0z"></path>
            </svg></figure>
    </section>
    <div class="section py-0">
        <div class="container mt-n10 mt-lg-n12 z-2">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10"><img src="{{ asset('assets/img/homepage.png') }}" alt="DZ-AliExpress"></div>
            </div>
        </div>
    </div>

    <section class="section section-lg">
        <div class="container">
            <div class="row justify-content-center mb-5 mb-lg-6">
                <div class="col-6 col-md-3 text-center mb-4">
                    <div class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle mb-4">
                        <span class="fas fa-user text-tertiary"></span>
                    </div>
                    <h3 class="fw-bolder">80</h3>
                    <p class="text-gray">{{ __('Clients Satisfaits') }}</p>
                </div>
                <div class="col-6 col-md-3 text-center mb-4">
                    <div class="icon icon-shape icon-lg bg-white shadow-lg border-light rounded-circle mb-4">
                        <span class="fas fa-box-open text-tertiary"></span>
                    </div>
                    <h3 class="fw-bolder">97</h3>
                    <p class="text-gray">{{ __('Commandes Livrées') }}</p>
                </div>
            </div>
            <div id="howTo" class="row justify-content-between align-items-center mb-5 mb-lg-7">
                <div class="col-12 col-lg-5 mb-5 mb-lg-0 order-lg-2">
                    <h2 class="h1 text-capitalize">{{ __('étape 1') }}</h2>
                    <p class="mb-4 lead fw-bold">{{ __('Sélectionnez votre produit préféré sur le site Web ou l’application Alixpress et copiez son lien.') }}</p>
                    <a href="{{ route('searchProduct', ['q' => '']) }}" class="btn btn-primary mt-2 animate-up-2">
                        <span class="fas fa-search me-2"></span> {{ __('Commencer') }}
                    </a>
                </div>
                <div class="col-12 col-lg-6 order-lg-1 text-center">
                    
                <video loop autoplay muted style="border-radius: 12px;box-shadow: 0 0px 74px -32px; max-width: 65%">
                    <source src="{{ asset('assets/img/step1.mp4') }}" type="video/mp4">
                </video>      
                </div>
            </div>
            <div class="row justify-content-between align-items-center mb-5 mb-lg-7">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="h1 d-flex align-items-center text-capitalize">{{ __('étape 2') }}</h2>
                    <p class="mb-4 lead fw-bold">{{ __('Placez le lien d’Aliexpress dans la barre de recherche ci-dessus') }}</p>
                    <p class="mb-4">{{ __('Notre application va chercher le produit que vous avez choisi et l’afficher pour vous en dinar algérien, et pour plus de commodité, vous pouvez également choisir vos options de pack préférés comme la couleur, la taille...') }}</p><a
                        href="{{ route('searchProduct', ['q'=> '']) }}"
                        class="btn btn-primary mt-2 animate-up-2"><span class="fas fa-search me-2"></span> {{ __('Commencer') }}</a>
                </div>
                <div class="col-lg-6 text-center">
                    <video loop autoplay muted style="border-radius: 12px;box-shadow: 0 0px 74px -32px; max-width: 65%">
                        <source src="{{ asset('assets/img/step2.mp4') }}" type="video/mp4">
                    </video>    
                </div>
            </div>
            <div class="row justify-content-between align-items-center mb-5 mb-lg-7">
                <div class="col-12 col-lg-5 mb-5 mb-lg-0 order-lg-2">
                    <h2 class="h1 text-capitalize">{{ __('étape 3') }}</h2>
                    <p class="mb-4 lead fw-bold">
                        {{ __('Veuillez saisir vos données (nom, téléphone, adresse...)') }}
                    </p>
                    <p class="mb-4">{{ __("Les commandes ne peuvent pas être livrées sans adresse, n’est-ce pas ? prenez un moment et inscrivez-vous pour un compte personnel à DZ-AliExpress, Afin que nous puissions fournir les bonnes informations sur vous pour AliExpress (tels que votre nom, adresse...) lors de la commande de votre produit.") }}
                    </p>
                    <a href="{{ route('searchProduct', ['q' => ""]) }}" class="btn btn-primary mt-2 animate-up-2">
                        <span class="fas fa-search me-2"></span> {{ __('Commencer') }}
                    </a>
                </div>
                <div class="col-12 col-lg-6 order-lg-1">
                    <video loop autoplay muted style="border-radius: 12px;box-shadow: 0 0px 74px -32px; max-width: 65%">
                        <source src="{{ asset('assets/img/step3.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="row justify-content-between align-items-center mb-5 mb-lg-7">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="h1 d-flex align-items-center text-capitalize">{{ __('étape 4') }}</h2>
                    <p class="mb-4 lead fw-bold">{{ __("Ajouter votre produit au panier (vous pouvez ajouter plusieurs produits dans votre panier)") }}</p>
                    <p class="mb-4">{{ __('كل ما عليك فعله الآن هو تمرير طلبك لنا وسوف نعتني بكل شيء. سنساعدك في تأكيد طلبك ، بعد التأكد من أن بائعك موثوق. كل شيء آخر يمكنك تتبعه على موقعنا DZ-AliExpress.') }}</p><a
                        href="{{ route('searchProduct', ['q' => ""]) }}"
                        class="btn btn-primary mt-2 animate-up-2"><span class="fas fa-search me-2"></span> {{ __('Commencer') }}</a>
                </div>
                <div class="col-lg-6"><img src="./assets/img/sections-mockup.jpg" alt="MapBox Leaflet.js Custom Integration Mockup"></div>
            </div>
        </div>
    </section>
@endsection
