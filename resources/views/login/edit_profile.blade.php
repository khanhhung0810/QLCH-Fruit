@extends('admin.masterAdmin')
@section('main')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('profilePage.update', $user->id) }}" enctype="multipart/form-data"
        class="mt-3">
        @csrf
        @php
            $profileImages = $user->avatar;
        @endphp
        @method('PUT')
        <h1 class="mb-3 text-center">My Profile</h1>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone"
                value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address"
                value="{{ old('address', $user->address) }}">
        </div>

        <div class="form-group">
            <label for="avatar">Avatar</label>
            <img src="{{ url('images/' . $profileImages) }}" alt="">
            <input type="file" class="form-control-file" id="avatar" name="avatar">

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
