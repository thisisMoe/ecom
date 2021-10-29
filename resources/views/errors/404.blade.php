@extends('layouts.custom')

@section('content')

    <section class="min-vh-100 pt-7 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-dark d-flex align-items-center justify-content-center">
                    <div><a href="./../index.html"><img class="img-fluid w-50" src="{{ asset('assets/img/sad-face.png') }}" alt="SAD!" width="320px"></a>
                        <h1 class="mt-4">404 <span class="fw-bolder text-primary">{{ __('Page introuvable') }}</span></h1>
                        <p class="lead my-4 px-lg-11">
                            {{ __('Oups! On dirait que vous avez suivi un mauvais lien. Si vous pensez que c’est un problème avec nous, s’il vous plaît dites-le nous.') }}
                        </p>
                        <a class="btn btn-primary animate-hover mb-3" href="/"><span
                                class="fas fa-chevron-left me-3 ps-2 animate-left-3"></span>{{ __("Retourner à la page d'accueil") }}</a>
                        <a class="btn btn-primary animate-hover" href="/contact"><span
                                class="fas fa-chevron-left me-3 ps-2 animate-left-3"></span>{{ __('Contactez-Nous') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
