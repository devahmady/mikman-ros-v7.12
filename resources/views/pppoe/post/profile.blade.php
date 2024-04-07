@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Profile</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="basic-form">
                            <form method="post" action="{{ route('add.profile') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Parent Queue</label>
                                        <div class="dropdown bootstrap-select form-control default-select">
                                            <select name="parentqq" id="parentqq" class="form-control default-select"
                                                tabindex="-98">
                                                <option>none</option>
                                                @foreach ($parent as $data)
                                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="localList">Local Address</label>
                                        <select class="form-control default-select" id="local" name="local">
                                            <option value="none">none</option>
                                            @foreach ($pool as $data)
                                                <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="remoteList" >Remote Address</label>
                                        <select class="form-control default-select" id="remote" name="remote">
                                            <option value="none">none</option>
                                            @foreach ($pool as $data)
                                                <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>Isolir Mode</label>
                                        <div class="dropdown bootstrap-select form-control default-select">
                                            <select name="isolirmode" id="isolirmode" class="form-control default-select"
                                                tabindex="-98">
                                                <option>none</option>
                                                <option value="isolir">Auto Isolir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Rite Limit (rx/tx)</label>
                                        <input type="text" class="form-control" id="ratelimit" name="ratelimit">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Expired</label>
                                        <input type="text" class="form-control" id="validity" name="validity">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Profile</button>
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
                        <h4 class="text-primary mb-4">Isolir Mode </h4>
                        <div class="row mb-2">
                            <div class="col-sm-3 col-5">
                                <h5 class="f-w-500">None <span class="pull-right">:</span>
                                </h5>
                            </div>
                            <div class="col-sm-9 col-7"><span>Tanpa Menggunakan Script Auto Isolir</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 col-5">
                                <h5 class="f-w-500">Auto Isolir <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-sm-9 col-7"><span>Mengaktifkan Script Auto Isolir </span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 col-5">
                                <h5 class="f-w-500">Expired <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-sm-9 col-7"><span>30d</span>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
