@php
$ar = app()->getLocale() === 'ar';
@endphp

@extends('layouts.custom')

@section('content')
    <section class="section section-header pb-11 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-8 text-center">
                    <h1 class="display-2 mb-3">{{ __("N'hésitez-pas, nous voulons toujours améliorer votre expérience.") }}</h1>
                    <p class="lead">{{ __("Pour plus d'informations ou des demandes générales, contactez-nous aujourd'hui.") }}</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg pt-6">
        <div class="container">
            <div class="row justify-content-center mb-5 mb-lg-6">
                <div class="col-12 col-lg-8">
                    <div class="card border-0 p-2 p-md-3 p-lg-5">
                        <div class="card-header bg-white border-0 text-center">
                            <h2>{{ __('Envie de travailler avec nous ?') }}</h2>
                            <p>{{ __('Cool! Parlons de votre projet') }}</p>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="mb-4"><label for="name">{{ __('Votre Nom Complet') }}</label>
                                    <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif><span class="input-group-text" id="basic-addon3"><span class="fas fa-user-circle"></span></span>
                                        <input type="text" name="fullName" class="form-control @error('fullName') is-invalid @enderror"
                                            placeholder="e.g. Riyad Mahrez" id="fullName" required
                                            @if (Auth::check())
                                              value="{{ Auth::user()->fullName }}"
                                            @endif>
                                        @error('fullName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4"><label for="email">{{ __('Votre Email') }}</label>
                                    <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif>
                                        <span class="input-group-text" id="basic-addon4">
                                            <span class="fas fa-envelope"></span>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@company.com" name="email" id="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4"><label for="phone">{{ __('Votre Téléphone') }}</label>
                                    <div class="input-group" @if ($ar)
                                    style="flex-direction: row-reverse;"
                                    @endif><span class="input-group-text" id="basic-addon4"><span class="fas fa-mobile-alt"></span></span>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="06XXXXXXXX" id="phone"
                                            name="phone" required
                                            @if (Auth::check())
                                              value="{{ Auth::user()->phone }}"
                                            @endif>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4"><label for="message">{{ __('Votre Message') }}</label>
                                    <textarea placeholder="{{ __('Votre message') }}" class="form-control @error('message') is-invalid @enderror" id="message"
                                        name="message" rows="4" maxlength="250" required></textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-grid"><button type="submit" class="btn rounded btn-secondary">{{ __('Envoyer Message') }}</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2>Our support team</h2>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="card border-0 text-center">
                        <div class="card-header border-0 bg-white"><img src="../../assets/img/team/profile-picture-2.jpg"
                                class="card-img-top rounded shadow border-0" alt="Christopher Avatar"></div>
                        <div class="card-body"><span class="card-subtitle text-gray fw-normal">Sales</span>
                            <h3 class="h4 card-title mt-2">Christopher Wood</h3>
                            <ul class="list-unstyled d-flex justify-content-center mt-3">
                                <li><a href="#" target="_blank" aria-label="facebook social link" class="icon icon-sm icon-facebook me-3"><span
                                            class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="twitter social link" class="icon icon-sm icon-twitter me-3"><span
                                            class="fab fa-twitter"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="slack social link" class="icon icon-sm icon-slack me-3"><span
                                            class="fab fa-slack-hash"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="dribbble social link" class="icon icon-sm icon-dribbble me-3"><span
                                            class="fab fa-dribbble"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="card border-0 text-center">
                        <div class="card-header border-0 bg-white"><img src="../../assets/img/team/profile-picture-3.jpg"
                                class="card-img-top rounded shadow border-0" alt="Bonnie Avatar"></div>
                        <div class="card-body"><span class="card-subtitle text-gray fw-normal">Marketing</span>
                            <h3 class="h4 card-title mt-2">Bonnie Green</h3>
                            <ul class="list-unstyled d-flex justify-content-center mt-3">
                                <li><a href="#" target="_blank" aria-label="facebook social link" class="icon icon-sm icon-facebook me-3"><span
                                            class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="twitter social link" class="icon icon-sm icon-twitter me-3"><span
                                            class="fab fa-twitter"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="slack social link" class="icon icon-sm icon-slack me-3"><span
                                            class="fab fa-slack-hash"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="dribbble social link" class="icon icon-sm icon-dribbble me-3"><span
                                            class="fab fa-dribbble"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 text-center">
                        <div class="card-header border-0 bg-white"><img src="../../assets/img/team/profile-picture-4.jpg"
                                class="card-img-top rounded shadow border-0" alt="Neil Avatar"></div>
                        <div class="card-body"><span class="card-subtitle text-gray fw-normal">Invoice</span>
                            <h3 class="h4 card-title mt-2">Neil Sims</h3>
                            <ul class="list-unstyled d-flex justify-content-center mt-3">
                                <li><a href="#" target="_blank" aria-label="facebook social link" class="icon icon-sm icon-facebook me-3"><span
                                            class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="twitter social link" class="icon icon-sm icon-twitter me-3"><span
                                            class="fab fa-twitter"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="slack social link" class="icon icon-sm icon-slack me-3"><span
                                            class="fab fa-slack-hash"></span></a></li>
                                <li><a href="#" target="_blank" aria-label="dribbble social link" class="icon icon-sm icon-dribbble me-3"><span
                                            class="fab fa-dribbble"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
