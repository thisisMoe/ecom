@php
$ar = app()->getLocale() === 'ar';
@endphp

@extends('layouts.custom')

@section('content')
    <div class="container px-2 pt-lg-3" style="margin-top: 92px">
        <form action="{{ route('searchProduct') }}" class="w-100" method="GET">
            <div class="input-group" @if ($ar)
                style="flex-direction: row-reverse;"
                @endif>
                <input type="text" name="q" class="form-control" id="searchProduct" placeholder="{{ __('Coller un lien ici') }}" aria-label="Search"
                    aria-describedby="basic-addon2">
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
        <div class="container mb-5">
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-8">
                    <div class="accordion" id="accordionExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button accordion-button-rtl collapsed" style="" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">What is the purpose of a FAQ?</button></h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body"><strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin
                                    adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing
                                    and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth
                                    noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">What is a FAQ document?</button></h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body"><strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse
                                    plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also
                                    worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">What are the top 10 interview
                                    questions?</button></h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body"><strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin
                                    adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing
                                    and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth
                                    noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.</div>
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
                                        @error('fullNam')
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
            @endif><span class="input-group-text" id="basic-addon3"><span class="fas fa-phone-alt"></span></span> <input
                                            type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="0660010203"
                                            aria-label="Phone" aria-describedby="basic-addon3" autocomplete="username">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3"><label for="password">{{ __('Mot de passe') }}</label>
                                    <div class="input-group" @if ($ar)
                style="flex-direction: row-reverse;"
            @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                            type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
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
            @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                            type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
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
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone-login" placeholder="0660010203"
                                    value="{{ old('phone') }}" aria-label="Nom Complet" aria-describedby="basic-addon3" autocomplete="username">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3"><label for="password-login">{{ __('Mot de passe') }}</label>
                            <div class="input-group" @if ($ar)
                style="flex-direction: row-reverse;"
            @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                    type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password-login"
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

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                            @endif

                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2" type="submit">{{ __('Se connecter') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
@endsection
