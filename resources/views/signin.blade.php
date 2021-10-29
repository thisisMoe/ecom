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
            <div class="row justify-content-center">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">{{ __('Connectez-vous à notre plateforme') }}</h1>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="mt-4">
                            @csrf
                            <div class="form-group mb-4"><label for="email">{{ __('Téléphone') }}</label>
                                <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif>
                                    <span class="input-group-text" id="basic-addon1">
                                        <span class="fas fa-envelope"></span>
                                    </span>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="06XXXXXXXX" id="phone"
                                        required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group mb-4"><label for="password">{{ __('Mot de passe') }}</label>
                                    <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                        <input type="password" name="password" placeholder="Mot de Passe"
                                            class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check mb-0"><input class="form-check-input" type="checkbox" checked id="remember"
                                            {{ old('remember') ? 'checked' : '' }} name="remember"> <label class="form-check-label mb-0"
                                            for="remember">{{ __('Réster Connecter?') }}</label></div>
                                </div>
                            </div>
                            <div class="d-grid"><button type="submit" class="btn btn-primary">{{ __('Se Connecter') }}</button></div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4"><span class="fw-normal">{{ __('Pas encore inscrit?') }} <a
                                    href="{{ route('register') }}" class="fw-bold text-underline">{{ __('Créer mon compte') }}</a></span>
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
                </div>
            </div>
        </div>
    </section>
@endsection
