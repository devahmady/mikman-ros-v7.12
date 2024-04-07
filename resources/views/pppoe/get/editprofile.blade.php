@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Profile</h4>
                </div>
                {{-- @dd($profile) --}}
                <div class="card-body">
                    <div class="basic-form">
                        <div class="basic-form">
                            <form method="post" action="{{ route('update.profile') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="hidden" value="{{ $profile['.id'] }}" name="id">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $profile['name'] ??'' }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Parent Queue</label>
                                        <div class="dropdown bootstrap-select form-control default-select">
                                            <select name="parentqq" id="parentqq" class="form-control default-select" tabindex="-98">
                                                <option value="{{ $profile['parent-queue'] ??''}}">{{ $profile['parent-queue'] ??''}}</option>
                                                @foreach ($parent as $data)
                                                    <option value="{{ $data['name'] ??''}}">{{ $data['name'] ??''}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="localList">Local Address</label>
                                        <select class="form-control default-select" id="local" name="local">
                                            @foreach ($pool as $data)
                                            <option value="{{ $data['name'] }}" @if(isset($profile['local-address']) && $profile['local-address'] == $data['name']) selected @endif>{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="remoteList">Remote Address</label>
                                        <select class="form-control default-select" id="remote" name="remote">
                                            @foreach ($pool as $data)
                                            <option value="{{ $data['name'] }}" @if(isset($profile['remote-address']) && $profile['remote-address'] == $data['name']) selected @endif>{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Isolir Mode</label>
                                        <div class="dropdown bootstrap-select form-control default-select">
                                            <select name="isolirmode" id="isolirmode" class="form-control default-select" tabindex="-98">
                                                <option value="isolir">{{ $profile['on-up'] ? explode(',', explode('(', $profile['on-up'])[1])[1] : 'Auto Isolir' }}</option>
                                                <option value="none">none</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label>Rate Limit (rx/tx)</label>
                                        <input type="text" class="form-control" id="ratelimit" name="ratelimit" value="{{ $profile['rate-limit'] ??'' }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Expired</label>
                                        <input type="text" class="form-control" id="validity" name="validity" value="{{ $profile['on-up'] ? explode(',', explode('(', $profile['on-up'])[1])[2] : '' }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
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
