@extends('layouts.custom')
@php
$ar = app()->getLocale() === 'ar';
@endphp
@section('content')
    <div class="container pt-7 d-lg-flex flex-column gap-4">
        <h1 class="">{{ __('Faites le suivi de vos colis Aliexpress') }}</h1>
        <div class="card p-4 mb-5" style="min-height: 500px">
            <div class="mb-3">
                <label for="exampleInputIconLeft">Mettez votre numéro de suivi ici:</label>
                <form action="{{ route('tracking') }}" method="GET" class="w-100">
                    <div class="input-group" @if ($ar)
                        style=" flex-direction: row-reverse;" @endif>
                        @csrf
                        <input type="text" name="trackingNumber" class="form-control" id="trackingNumber" placeholder="RB105603059SG" aria-label="trackingNumber"
                            aria-describedby="basic-addon2" value="{{ old('trackingNumber') }}">
                        <button type="submit" id="trackButton" class="input-group-text px-4">
                            <span class="fas fa-search text-primary"></span>
                        </button>
                    </div>
                </form>
            </div>

            @if ($response != '')
                <h6 class="text-center">Déstination: {{ $response['data']['items'][0]['destination_country'] }}</h6>

                <div>
                    {{-- {{ dd($response['data']['items'][0]['origin_info']['trackinfo']) }}
                {{ dd($response['data']['items'][0]['lastEvent']) }} --}}
                    @foreach ($response['data']['items'][0]['origin_info']['trackinfo'] as $event)
                        <div class="mb-3 p-2" style="background: #f5f9fc; border-radius: 10px">
                            <div class="mb-1 d-md-flex justify-content-between flex-wrap align-items-center">
                                <div class="fw-bold">
                                    @if ($event['substatus'] == 'delivered001')
                                        <div class="fs-5 d-inline-block text-success me-2">
                                            <i class="fas fa-flag-checkered"></i>
                                        </div>
                                    @endif
                                    {{ $event['StatusDescription'] }}
                                </div>
                                <div class="text-muted font-small">
                                    {{ $event['Date'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection
