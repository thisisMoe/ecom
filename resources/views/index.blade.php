@extends('layouts.custom')
@section('content')
    @php
    $ar = app()->getLocale() === 'ar';
    @endphp
    <!-- Hero -->
    <section class="section-header overflow-hidden pt-7 pt-lg-8 pb-9 pb-lg-12 bg-primary text-white">
        <div class="container">
            @if (Session::has('success'))
                <div class="modal fade show" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-modal="true"
                    style="display: block;">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-primary text-white">
                            <div class="modal-header border-0"><button type="button" class="btn-close bg-gray-500" id="closeButton" data-bs-dismiss="modal"
                                    aria-label="Close"></button></div>
                            <div class="modal-body">
                                <div class="py-3 text-center"><span class="modal-icon display-1-lg"><span class="far fa-envelope-open"></span></span>
                                    <h2 class="h4 modal-title my-3">{{ __('Merci de nous avoir contactés!') }}</h2>
                                    <p class="px-lg-5">{{ __('Message reçu avec succès, nous vous répondrons dans les plus brefs délais.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 text-center">
                    <div class="bootstrap-big-icon d-none d-lg-block">
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
                <div class="col-12 col-md-10 text-center">
                    {{-- <video height="420" controls muted autoplay>
                        <source src="{{ asset('assets/videos/promo-video.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video> --}}
                    <img src="{{ asset('assets/img/home.webp') }}" alt="DZ-AliExpress">
                </div>
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
                    <p class="mb-4 lead fw-bold">{{ __('Sélectionnez votre produit préféré sur le site Web ou l’application Alixpress et copiez son lien.') }}
                    </p>
                    <a href="{{ route('searchProduct', ['q' => '']) }}" class="btn btn-primary mt-2 animate-up-2">
                        <span class="fas fa-search me-2"></span> {{ __('Commencer') }}
                    </a>
                </div>
                <div class="col-12 col-lg-6 order-lg-1 text-center">

                    <video loop autoplay playsinline muted
                        style="border-radius: 16px;box-shadow: 0 0 60px 10px rgba(70, 70, 70, 0.03), -10px 10px 50px rgba(0, 0, 0, 0.1), -50px 50px 70px rgba(0, 0, 0, 0.05), -100px 100px 100px rgba(0, 0, 0, 0.03), -150px 150px 150px rgba(0, 0, 0, 0.02); max-width: 65%">
                        <source src="{{ asset('assets/img/step1.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="row justify-content-between align-items-center mb-5 mb-lg-7">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="h1 d-flex align-items-center text-capitalize">{{ __('étape 2') }}</h2>
                    <p class="mb-4 lead fw-bold">{{ __('Placez le lien d’Aliexpress dans la barre de recherche ci-dessus') }}</p>
                    <p class="mb-4">
                        {{ __('Notre application va chercher le produit que vous avez choisi et l’afficher pour vous en dinar algérien, et pour plus de commodité, vous pouvez également choisir vos options de pack préférés comme la couleur, la taille...') }}
                    </p><a href="{{ route('searchProduct', ['q' => '']) }}" class="btn btn-primary mt-2 animate-up-2"><span class="fas fa-search me-2"></span>
                        {{ __('Commencer') }}</a>
                </div>
                <div class="col-lg-6 text-center">
                    <video loop playsinline autoplay muted
                        style="border-radius: 16px;box-shadow: 0 0 60px 10px rgba(70, 70, 70, 0.03), -10px 10px 50px rgba(0, 0, 0, 0.1), -50px 50px 70px rgba(0, 0, 0, 0.05), -100px 100px 100px rgba(0, 0, 0, 0.03), -150px 150px 150px rgba(0, 0, 0, 0.02); max-width: 65%">
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
                    <p class="mb-4">
                        {{ __('Les commandes ne peuvent pas être livrées sans adresse, n’est-ce pas ? prenez un moment et inscrivez-vous pour un compte personnel à DZ-AliExpress, Afin que nous puissions fournir les bonnes informations sur vous pour AliExpress (tels que votre nom, adresse...) lors de la commande de votre produit.') }}
                    </p>
                    <a href="{{ route('searchProduct', ['q' => '']) }}" class="btn btn-primary mt-2 animate-up-2">
                        <span class="fas fa-search me-2"></span> {{ __('Commencer') }}
                    </a>
                </div>
                <div class="col-12 col-lg-6 order-lg-1 text-center">
                    <video loop playsinline autoplay muted
                        style="border-radius: 16px;box-shadow: 0 0 60px 10px rgba(70, 70, 70, 0.03), -10px 10px 50px rgba(0, 0, 0, 0.1), -50px 50px 70px rgba(0, 0, 0, 0.05), -100px 100px 100px rgba(0, 0, 0, 0.03), -150px 150px 150px rgba(0, 0, 0, 0.02); max-width: 65%">
                        <source src="{{ asset('assets/img/step3.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="row justify-content-between align-items-center mb-5 mb-lg-7">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="h1 d-flex align-items-center text-capitalize">{{ __('étape 4') }}</h2>
                    <p class="mb-4 lead fw-bold">{{ __('Ajouter votre produit au panier (vous pouvez ajouter plusieurs produits dans votre panier)') }}</p>
                    <p class="mb-4">
                        {{ __('Tout ce que vous avez à faire maintenant, c’est de faire votre demande. Nous allons nous occuper de tout. Nous vous aiderons à confirmer votre commande après vous être assuré que votre fournisseur est fiable. Tout le reste, vous pouvez suivre sur notre site DZ-AliExpress.') }}
                    </p><a href="{{ route('searchProduct', ['q' => '']) }}" class="btn btn-primary mt-2 animate-up-2"><span class="fas fa-search me-2"></span>
                        {{ __('Commencer') }}</a>
                </div>
                <div class="col-lg-6 text-center">
                    <video loop playsinline autoplay muted
                        style="border-radius: 16px;max-width: 65%; box-shadow: 0 0 60px 10px rgba(70, 70, 70, 0.03), -10px 10px 50px rgba(0, 0, 0, 0.1), -50px 50px 70px rgba(0, 0, 0, 0.05), -100px 100px 100px rgba(0, 0, 0, 0.03), -150px 150px 150px rgba(0, 0, 0, 0.02);">
                        <source src="{{ asset('assets/img/step4.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section>
    @if (Session::has('success'))
        <div id="modal-backdrop" class="modal-backdrop fade show"></div>
    @endif
@endsection

@section('scripts')
    <script>
        $('#closeButton').click(function() {
            $('#modal-notification').hide();
            $('#modal-backdrop').hide();
        })
    </script>
@endsection
