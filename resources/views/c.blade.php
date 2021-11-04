@php
$ar = app()->getLocale() === 'ar';
@endphp

@extends('layouts.custom')

@section('head')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endsection

@section('content')
    <div class="container px-2 pt-lg-3" style="margin-top: 92px">
        <form action="{{ route('searchProduct') }}" class="w-100" method="GET">
            <div class="input-group" @if ($ar)
                style=" flex-direction: row-reverse;" @endif>
                <button type="button" class="input-group-text px-2" id="clearButton">
                    {{ __('Effacer') }} <i class="fas fa-eraser mx-1"></i>
                </button>
                <input type="text" name="q" class="form-control" id="searchProduct" placeholder="{{ __('Coller un lien AliExpress ici...') }}"
                    aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" value="">
                <button type="submit" class="input-group-text px-4" id="basic-addon2">
                    <span class="fas fa-search text-primary"></span>
                </button>
            </div>
        </form>
    </div>
    <div id="app">
        <product-details uri="{{ $uri }}"></product-details>
    </div>

    @auth
        <div class="section mb-5">
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-8">
                    <div class="accordion" id="accordionExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button accordion-button-rtl collapsed" style="" type="button" data-bs-toggle="collapse" data-bs-target="#faq1"
                                    aria-expanded="false" aria-controls="faq1"><strong>{{ __('Quelles sont nos garanties ?') }}</strong></button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body">
                                    {{ __('en plus de nos excellents services d’assistance, nous fournissons à nos chers clients toutes les garanties qu’AliExpress fournit aux clients Algériens. Nous passons également par tous les avis des vendeurs pour s’assurer que vous n’achetez pas d’un vendeur avec une mauvaise réputation (Nous faisons de notre mieux pour assurer aucun produit cassé, ou mauvais emballage pour les produits de nos clients)') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2" aria-expanded="false"
                                    aria-controls="faq2"><strong>{{ __('Quelles sont nos méthodes de paiement acceptées?') }}</strong></button></h2>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body">
                                    {{ __('Nous acceptons: ') }} <strong>CCP, BaridiMob</strong>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq8" aria-expanded="false"
                                    aria-controls="faq8"><strong>{{ __('Comment puis-je confirmer ma commande?') }}</strong></button></h2>
                            <div id="faq8" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Après avoir effectué votre paiement, vous devrez nous envoyer soit le reçu de paiement en cliquant sur ') }}
                                    <strong>{{ __('"Confirmer le paiement" ') }}</strong>
                                    <a class="text-underline" href="{{ route('account') }}">{{ __('ici') }} <i class="far fa-user"></i></a>
                                    {{ __(', ou nous envoyer un email contenant la confirmation de BaridiMob') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq9" aria-expanded="false"
                                    aria-controls="faq9"><strong>{{ __('Dois-je payer avant ou après avoir reçu le produit?') }}</strong></button></h2>
                            <div id="faq9" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Le paiement de l’argent doit être fait avant de passer votre commande à AliExpress.') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3" aria-expanded="false"
                                    aria-controls="faq3"><strong>{{ __('Que puis-je faire si ma commande n’arrive pas dans les délais de livraison garantis par le vendeur ?') }}</strong></button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body">
                                    {{ __('Dans le cadre des garanties AliExpress, Nous pouvons soumettre des demandes de remboursement jusqu’à 15 jours après la fin de votre commande. nous pouvons le faire en ouvrant un litige auprès d’AliExpress.') }}
                                    <strong>
                                        {{ __('Veuillez noter que nous ne pouvons ouvrir qu’un seul litige par commande.') }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4" aria-expanded="false"
                                    aria-controls="faq4"><strong><strong>{{ __('Les articles que j’ai reçus n’étaient pas tels que décrit par le vendeur. Que puis-je faire?') }}</strong></strong></button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Tout produit livré qui ne correspond pas à la description du vendeur est admissible à un remboursement. Nous pouvons également trouver une solution qui convient à la fois à vous et au vendeur.') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5" aria-expanded="false"
                                    aria-controls="faq5"><strong>{{ __('Comment puis-je m’assurer que les produits que j’achète sont authentiques?') }}</strong></button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Sur AliExpress.com, vous pouvez trouver de nombreux vendeurs qui offrent des produits authentiques garantis.') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq6" aria-expanded="false"
                                    aria-controls="faq6"><strong>{{ __('Quelles autres protections puis-je obtenir pour des produits qui ne sont pas authentiques?') }}</strong></button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Tous les produits (Guaranteed Genuine) ont été vérifiés par AliExpress. Si vous recevez toujours un produit contrefait, vous obtiendrez un remboursement complet (frais d’expédition inclus).') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq7" aria-expanded="false" aria-controls="faq7"><strong>{{ __('Quels sont nos frais?') }}</strong></button>
                            </h2>
                            <div id="faq7" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Nos frais varient en fonction du prix du produit, mais en règle générale, nous l’avons fixé à un minimum de 350DA et à un maximum de 2500DA, ce petit montant nous aide à fournir les meilleurs services d’achat en ligne tout en le rendant aussi facile que possible pour vous.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="fmxw-850 mx-auto mb-5 px-4 mt-4" id="main-form">
            {{-- <div class="mb-4"><label for="exampleInputEmail6">Email address</label> <input type="email" class="form-control" id="exampleInputEmail6">
                        <small id="emailHelp" class="form-text text-gray">We'll never share your email with anyone else.</small>
                    </div> --}}
            <ul class="nav nav-pills nav-fill gap-2 flex-md-row align-items-center" id="tabs-text" role="tablist">
                <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-bs-toggle="tab" href="#tabs-text-1" role="tab"
                        aria-controls="tabs-text-1" aria-selected="true">{{ __('Inscription') }}</a></li>
                <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-bs-toggle="tab" href="#tabs-text-2" role="tab"
                        aria-controls="tabs-text-2" aria-selected="true">{{ __('Connexion') }}</a></li>
            </ul>
            <hr>
            <div class="tab-content" id="tabcontent1">

                <div class="tab-pane fade show active" id="tabs-text-1">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3"><label for="exampleInputIconLeft1">{{ __('Nom Complet') }}</label>
                                    <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon1"><span class="fas fa-address-card"></span></span> <input type="text"
                                            name="fullName" class="form-control @error('fullName') is-invalid @enderror" id="exampleInputIconLeft1"
                                            placeholder="{{ __('Nom Complet') }}" aria-label="Nom Complet" aria-describedby="basic-addon1" autocomplete>
                                        @error('fullName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3"><label for="exampleInputIconLeft2">{{ __('Adresse de livraison') }}</label>
                                    <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon2"><span class="fas fa-map-marked-alt"></span></span>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputIconLeft2"
                                            placeholder="{{ __('Adresse de livraison') }}" aria-label="Adresse de livraison" aria-describedby="basic-addon2">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3"><label for="phone">{{ __('Téléphone') }}</label>
                                    <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon3"><span class="fas fa-phone-alt"></span></span> <input type="number"
                                            name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="06XXXXXXXX"
                                            aria-label="Phone" aria-describedby="basic-addon3" autocomplete="username" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3"><label for="password">{{ __('Mot de passe') }}</label>
                                    <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input type="password"
                                            name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="{{ __('Mot de passe') }}" aria-label="Mot de passe" aria-describedby="basic-addon4"
                                            autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3"><label for="exampleInputIconLeft5">{{ __('Confirmer le mot de passe') }}</label>
                                    <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input type="password"
                                            name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="exampleInputIconLeft5" placeholder="{{ __('Confirmer votre mot de passe') }}" aria-label="Mot de passe confirmation"
                                            aria-describedby="basic-addon4" autocomplete="new-password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2" type="submit">{{ __("S'inscrire") }}</button>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">{{ __('Mot de passe oublié?') }}
                                    <a href="#/" class="mb-3 text-underline fw-bold" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title=""
                                        data-bs-content="Pour demander un nouveau mot de passe, veuillez nous envoyer un message à ce numéro (0558494325) avec ce texte (mdp)"
                                        data-bs-original-title="{{ __('Nouveau Mot de Passe') }}"
                                        aria-describedby="popover415920">{{ __('Demander un nouveau Mot de passe') }}</a>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-text-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        <div class="mb-3">
                            <label for="phone-login">{{ __('Téléphone') }}</label>
                            <div class="input-group" @if ($ar)
                                style="flex-direction: row-reverse;"
                                @endif>
                                <span class="input-group-text" id="basic-addon3">
                                    <span class="fas fa-phone-alt"></span>
                                </span>
                                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone-login" placeholder="06XXXXXXXX"
                                    value="{{ old('phone') }}" aria-label="Téléphone" aria-describedby="basic-addon3" autocomplete="username">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3"><label for="password-login">{{ __('Mot de passe') }}</label>
                            <div class="input-group" @if ($ar)
                                style="flex-direction: row-reverse;"
                                @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input type="password"
                                    name="password" class="form-control @error('password') is-invalid @enderror" id="password-login"
                                    placeholder="{{ __('Mot de passe') }}" aria-label="Mot de passe" aria-describedby="basic-addon4" autocomplete="current-password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 my-1">
                                <div class="form-check"><input class="form-check-input" checked type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}> <label class="form-check-label"
                                        for="remember">{{ __('Réster Connecter?') }}</label></div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2" type="submit">{{ __('Se connecter') }}</button>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">{{ __('Mot de passe oublié?') }}
                                    <a href="#/" class="mb-3 text-underline fw-bold" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title=""
                                        data-bs-content="Pour demander un nouveau mot de passe, veuillez nous envoyer un message à ce numéro (0558494325) avec ce texte (mdp)"
                                        data-bs-original-title="{{ __('Nouveau Mot de Passe') }}"
                                        aria-describedby="popover415920">{{ __('Demander un nouveau Mot de passe') }}</a>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('scripts')
    <script>
        $('#clearButton').click(function() {
            $('#searchProduct').val('');
        })
    </script>
@endsection
