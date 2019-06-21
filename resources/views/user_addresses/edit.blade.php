@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ingresa tu direccion') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user-address.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="line_1" class="col-md-4 col-form-label text-md-right">
                                {{ __('Linea 1') }}
                            </label>

                            <div class="col-md-6">
                                <input id="line_1" type="text" class="form-control" name="line_1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="line_2" class="col-md-4 col-form-label text-md-right">
                                {{ __('Linea 2') }}
                            </label>

                            <div class="col-md-6">
                                <input id="line_2" type="text" class="form-control" name="line_2">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">
                                {{ __('Ciudad') }}
                            </label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">
                                {{ __('Sitio web') }}
                            </label>

                            <div class="col-md-6">
                                @include('partials.select_mexico_state')
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">
                                {{ __('Codigo postal') }}
                            </label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control" name="zip_code">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
