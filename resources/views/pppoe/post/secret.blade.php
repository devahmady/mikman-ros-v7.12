@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Secret</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="basic-form">
                            <form method="post" action="{{ route('add.secret') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password</label>
                                        <input type="text" class="form-control" id="pass" name="pass">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Local Address</label>
                                        <input type="text" class="form-control" id="local" name="local">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Remote Address</label>
                                        <input type="text" class="form-control" id="remote" name="remote">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>Service</label>
                                        <select name="servicee" id="servicee" class="form-control default-select">
                                            <option value="any">any</option>
                                            <option value="pppoe">pppoe</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Profile</label>
                                        <select name="profilee" id="profilee" class="form-control default-select">
                                            <option>none</option>
                                            @foreach ($profile as $data)
                                                <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Comment</label>
                                        <select name="comment" id="comment"  class="form-control default-select">
                                            <option value="lunas">Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add secret</button>
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
                        {{-- <div class="row mb-2">
                            <div class="col-sm-3 col-5">
                                <h5 class="f-w-500">Isolir <span class="pull-right">:</span>
                                </h5>
                            </div>
                            <div class="col-sm-9 col-7"><span>Isolir User Secret </span>
                            </div>
                        </div> --}}




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
