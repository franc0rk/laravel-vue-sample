@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Completar perfil') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user-profile.edit') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">
                                {{ __('Descripcion') }}
                            </label>

                            <div class="col-md-6">
                                <textarea name="bio" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">
                                {{ __('Sitio web') }}
                            </label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">
                                {{ __('Telefono') }}
                            </label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">
                                {{ __('Fecha de nacimiento') }}
                            </label>

                            <div class="col-md-6">
                                <input id="birthday" name="birthday" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Genero') }}</label>

                            <div class="col-md-6">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
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
