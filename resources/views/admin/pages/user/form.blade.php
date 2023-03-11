@extends('layouts.admin.admin')

@section('content-title', 'Admin')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$user ? route('admin.users.update', $user) : route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method(@$user ? 'PUT' : 'POST')
                <div class="card-header">
                    <h4>Form Admin</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', @$user ? $user->name : '') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', @$user ? $user->email : '') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" disabled class="form-control" name="role" value="Admin">
                    </div>
                    <div class="form-group">
                        <label>Ditempatkan Di</label>
                        <select name="placed_in" id="" class="form-control @error('placed_in') is-invalid @enderror">
                            <x-nothing-selected></x-nothing-selected>
                            @foreach([\App\Models\User::PLACED_IN_BALI, \App\Models\User::PLACED_IN_AMBON] as $placedIn)
                                <option @if (old('placed_in', @$user ? $user->placed_in : '') == $placedIn) selected @endif value="{{ $placedIn }}">{{ ucwords($placedIn) }}</option>
                            @endforeach
                        </select>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
