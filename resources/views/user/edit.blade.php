@php
$ar = app()->getLocale() === 'ar';
@endphp
@extends('layouts.custom')

@section('content')
    <div class="container pt-7">
        <div class="d-flex gap-2 align-items-center justify-content-between">
            <h2>{{ __('Modifier Votre Profil:') }}</h2>
            <a href="{{ route('account') }}" class="btn btn-outline-primary px-4">{{ __('Retour') }}</a>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {!! Session::get('success') !!}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif
        <div class="d-lg-flex justify-content-center">
            <form method="POST" action="{{ route('user.update', $user) }}" class="my-5">
                @csrf
                @method('patch')
                <div class="row mb-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleInputIconLeft1">{{ __('Nom Complet') }}</label>
                            <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif>
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-address-card"></span>
                                </span>
                                <input type="text" name="fullName" value="{{ $user->fullName }}" class="form-control @error('fullName') is-invalid @enderror"
                                    id="exampleInputIconLeft1" placeholder="{{ __('Nom Complet') }}" aria-label="Nom Complet" aria-describedby="basic-addon1">
                                    @error('fullName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputIconLeft2">{{ __('Adresse de livraison') }}</label>
                            <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif>
                                <span class="input-group-text" id="basic-addon2">
                                    <span class="fas fa-map-marked-alt"></span>
                                </span>
                                <input type="text" value="{{ $user->address }}" name="address" class="form-control @error('address') is-invalid @enderror"
                                    id="exampleInputIconLeft2" placeholder="{{ __('Adresse de livraison') }}" aria-label="Adresse de livraison" aria-describedby="basic-addon2">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleInputIconLeft3">{{ __('Téléphone') }}</label>
                            <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif>
                                <span class="input-group-text" id="basic-addon3">
                                    <span class="fas fa-phone-alt"></span>
                                </span>
                                <input type="text" value="{{ $user->phone }}" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    id="exampleInputIconLeft3" placeholder="{{ __('Nom Complet') }}" aria-label="Nom Complet" aria-describedby="basic-addon3">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-5">
                        <h4>{{ __('Modifier Votre Mot de Passe ici') }}</h4>
                        <div class="mb-3"><label for="exampleInputIconLeft4">{{ __('Nouveau Mot de Passe') }}</label>
                            <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                    type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputIconLeft4"
                                    placeholder="{{ __('Mot de passe') }}" aria-label="Mot de passe" aria-describedby="basic-addon4">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputIconLeft5">{{ __('Confirmer votre Nouveau Mot de Passe') }}</label>
                            <div class="input-group" @if ($ar)
                                        style="flex-direction: row-reverse;"
                                        @endif>
                                <span class="input-group-text" id="basic-addon4">
                                    <span class="fas fa-unlock-alt"></span>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror"
                                    id="exampleInputIconLeft5" placeholder="{{ __('Confirmer votre mot de passe') }}" aria-label="Mot de passe confirmation"
                                    aria-describedby="basic-addon4">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2" type="submit">{{ __('Enregistrer') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
