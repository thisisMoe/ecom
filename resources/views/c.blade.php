@extends('layouts.custom')

@section('content')
    <div id="app">
        <product-details uri="{{ $uri }}"></product-details>
    </div>

    @auth
        <div class="form-group col-md-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    @else
        <div class="container mb-5">
            {{-- <div class="mb-4"><label for="exampleInputEmail6">Email address</label> <input type="email" class="form-control" id="exampleInputEmail6">
                        <small id="emailHelp" class="form-text text-gray">We'll never share your email with anyone else.</small>
                    </div> --}}
            <ul class="nav nav-pills nav-fill gap-2 flex-md-row" id="tabs-text" role="tablist">
                <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-bs-toggle="tab" href="#tabs-text-1" role="tab"
                        aria-controls="tabs-text-1" aria-selected="true">Inscription</a></li>
                <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-bs-toggle="tab" href="#tabs-text-2" role="tab"
                        aria-controls="tabs-text-2" aria-selected="true">Connexion</a></li>
            </ul>
            <hr>
            <div class="tab-content" id="tabcontent1">

                <div class="tab-pane fade show active" id="tabs-text-1">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3"><label for="exampleInputIconLeft1">Nom Complet</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon1"><span class="fas fa-address-card"></span></span> <input
                                            type="text" name="fullName" class="form-control @error('fullName') is-invalid @enderror" id="exampleInputIconLeft1"
                                            placeholder="Nom Complet" aria-label="Nom Complet" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="mb-3"><label for="exampleInputIconLeft2">Adresse de livraison</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon2"><span class="fas fa-map-marked-alt"></span></span>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputIconLeft2"
                                            placeholder="Adresse de livraison" aria-label="Adresse de livraison" aria-describedby="basic-addon2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3"><label for="exampleInputIconLeft3">Téléphone</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon3"><span class="fas fa-phone-alt"></span></span> <input
                                            type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="exampleInputIconLeft3"
                                            placeholder="Nom Complet" aria-label="Nom Complet" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="mb-3"><label for="exampleInputIconLeft4">Mot de passe</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                            type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputIconLeft4"
                                            placeholder="Mot de passe" aria-label="Mot de passe" aria-describedby="basic-addon4">
                                    </div>
                                </div>
                                <div class="mb-3"><label for="exampleInputIconLeft5">Confirmer le mot de passe</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                            type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror"
                                            id="exampleInputIconLeft5" placeholder="Confirmaer votre mot de passe" aria-label="Mot de passe confirmation"
                                            aria-describedby="basic-addon4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2" type="submit">S'inscrire</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-text-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        <div class="mb-3"><label for="exampleInputIconLeft3">Téléphone</label>
                            <div class="input-group"><span class="input-group-text" id="basic-addon3"><span class="fas fa-phone-alt"></span></span> <input
                                    type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="exampleInputIconLeft3"
                                    placeholder="Nom Complet" value="{{ old('phone') }}" aria-label="Nom Complet" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="mb-3"><label for="exampleInputIconLeft4">Mot de passe</label>
                            <div class="input-group"><span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span> <input
                                    type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputIconLeft4"
                                    placeholder="Mot de passe" aria-label="Mot de passe" aria-describedby="basic-addon4">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 my-1">
                                <div class="form-check"><input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}> <label class="form-check-label" for="remember">Remember me</label></div>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2" type="submit">Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        {{-- <div class="col-12 col-md-10 col-lg-8">
            <div class="nav-wrapper position-relative mb-2">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                    <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-bs-toggle="tab" href="#tabs-text-1" role="tab"
                            aria-controls="tabs-text-1" aria-selected="true">Home</a></li>
                    <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-bs-toggle="tab" href="#tabs-text-2" role="tab"
                            aria-controls="tabs-text-2" aria-selected="false">Profile</a></li>
                    <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-3-tab" data-bs-toggle="tab" href="#tabs-text-3" role="tab"
                            aria-controls="tabs-text-3" aria-selected="false">Messages</a></li>
                </ul>
            </div>
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="tab-content" id="tabcontent1">
                        <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-text-1-tab">
                            <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et
                                8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag.</p>
                            <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be
                                moonlight cordially curiosity.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-text-2-tab">
                            <p>Photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips
                                proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag.</p>
                            <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be
                                moonlight cordially curiosity.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-text-3" role="tabpanel" aria-labelledby="tabs-text-3-tab">
                            <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et
                                8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag.</p>
                            <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be
                                moonlight cordially curiosity.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endauth
@endsection
