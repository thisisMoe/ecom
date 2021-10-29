@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard
        </h1>
        <a href="{{ route('admin.users') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Retour</a>
    </div>

    <!-- Content Row -->
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-between align-items-center" style="padding-right: 1rem;" role="alert">
            <div>{!! Session::get('success') !!}</div>
            <button type="button" class="btn btn-default" data-dismiss="alert" aria-label="Close">X
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <form role="form" action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label>Nom Complet:</label>
                    <input name="fullName" class="form-control @error('fullName') is-invalid @enderror" value="{{ $user->fullName }}">
                    @error('fullName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Mobile</label>
                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Adresse</label>
                    <input name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr>

                <h4>Changer le MDP</h4>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input name="password" placeholder="******" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirmation</label>
                    <input name="password_comfirmation" placeholder="******" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection
