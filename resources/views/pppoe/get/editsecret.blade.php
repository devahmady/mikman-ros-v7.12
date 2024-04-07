@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Secret</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="basic-form">
                            <form method="post" action="{{ route('update.secret') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="hidden" value="{{ $user['.id'] }}" name="id">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $user['name'] ?? '' }}" id="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Password</label>
                                        <input type="text" name="pass" class="form-control"
                                            value="{{ $user['password'] ?? '' }}" id="pass" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="servicee">Service</label>
                                        <select name="servicee" id="servicee" class="form-control default-select" required>
                                            <option selected>{{ $user['service'] }}</option>
                                            <option value="any">any</option>
                                            <option value="pppoe">pppoe</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="profilee">Profile</label>
                                        <select name="profilee" id="profilee" class="form-control default-select">
                                            <option selected>{{ $user['profile'] }}</option>
                                            @foreach ($profile as $data)
                                                <option>{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="remote">Remote Address</label>
                                        <input type="text" name="remote" class="form-control" value="{{ $user['remote-address'] ?? '' }}" id="remote">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="comment">Comment</label>
                                        <select name="comment" id="comment" class="form-control default-select">
                                            <option selected>{{ $user['comment'] }}</option>
                                            <option value="lunas">Lunas</option>
                                            <option value="isolir">Isolir</option>
                                        </select>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Update secret</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Information</h4>
                </div>
                <div class="card-body">
                    <div class="profile-personal-info">
                        <h4 class="text-primary mb-4">Comment </h4>
                        <div class="row mb-2">
                            <div class="col-sm-3 col-5">
                                <h5 class="f-w-500">Lunas <span class="pull-right">:</span>
                                </h5>
                            </div>
                            <div class="col-sm-9 col-7"><span>Mengaktifkan User secret </span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 col-5">
                                <h5 class="f-w-500">Isolir <span class="pull-right">:</span>
                                </h5>
                            </div>
                            <div class="col-sm-9 col-7"><span>Isolir User Secret </span>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
