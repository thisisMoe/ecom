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
    <section class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark" data-background="../../assets/img/pages/form-image.jpg"
        style="background: url(&quot;../../assets/img/pages/form-image.jpg&quot;);">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">{{ __("S'inscrire à notre plateforme") }}</h1>
                        </div>
                        <form method="POST" action="{{ route('register') }}" class="mt-4">
                            @csrf
                            <div class="form-group mb-4"><label for="fullName">{{ __('Nom Complet') }}</label>
                                <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif><span class="input-group-text" id="basic-addon1"><i class="far fa-id-card"></i></span>
                                    <input type="text" value="{{ old('fullName') }}" name="fullName" class="form-control @error('fullName') is-invalid @enderror"
                                        placeholder="{{ __('Votre nom Complet') }}" id="fullName" required autocomplete="fullName">
                                    @error('fullName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4"><label for="email">{{ __('Adresse') }}</label>
                                <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif><span class="input-group-text" id="basic-addon1"><span class="fas fa-map-marker-alt"></span></span>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                                        placeholder="Rue 197 N51 Sidi..." id="address" name="address" required autocomplete="address">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone">{{ __('Téléphone') }}</label>
                                <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif><span class="input-group-text" id="basic-addon1"><span class="fas fa-mobile-alt"></span>
                                    </span>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
                                        placeholder="06XXXXXXXX" id="phone" required autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">{{ __('Mot de passe') }}</label>
                                <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif>
                                    <span class="input-group-text" id="basic-addon2">
                                        <span class="fas fa-unlock-alt"></span>
                                    </span>
                                    <input type="password" name="password" placeholder="Mot de passe" class="form-control" id="password" required
                                        autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" style="display: inline-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-4"><label for="password-confirm">{{ __('Retapez Mot de passe') }}</label>
                                <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif><span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="password" name="password_confirmation" placeholder="Confirmation du Mot de passe" class="form-control"
                                        id="password-confirm" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="d-grid"><button type="submit" class="btn btn-primary">{{ __("S'inscrire") }}</button></div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">{{ __('Déja inscrit?') }}
                                <a href="{{ route('signin') }}" class="fw-bold text-underline">{{ __('Se connecter') }}
                                </a>
                            </span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">{{ __('Mot de passe oublié?') }}
                                <a href="#/" class="mb-3 text-underline fw-bold" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title=""
                                    data-bs-content="Pour demander un nouveau mot de passe, veuillez nous envoyer un message à ce numéro (0558494325) avec ce texte (mdp)"
                                    data-bs-original-title="{{ __('Nouveau Mot de Passe') }}"
                                    aria-describedby="popover415920">{{ __('Demander un nouveau Mot de passe') }}</a>
                            </span>
                        </div>
                        <div class="popover fade show bs-popover-top" role="tooltip" id="popover415920"
                            style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(57px, 12031px);" data-popper-placement="top">
                            <div class="popover-arrow" style="position: absolute; left: 0px; transform: translate(129px, 0px);">
                            </div>
                            <h3 class="popover-header">{{ __('Nouveau Mot de Passe') }}</h3>
                            <div class="popover-body">{{ __('Pour demander un nouveau mot de passe, veuillez nous envoyer un message à ce numéro') }}
                                <strong>0558494325</strong> {{ __('avec ce texte') }} <strong>mdp</strong>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
