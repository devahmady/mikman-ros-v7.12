@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Server</h4>
                </div>

                <div class="card-body">
                    <div class="basic-form">
                        <form method="post" action="{{ route('server.update') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Service Name</label>
                                    <input type="hidden" value="{{ $interface['.id'] }}" name="id">
                                    <input type="text" class="form-control" value="{{ $interface['service-name'] }}"
                                        id="servicee" name="servicee" placeholder="Name Server"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Interface</label>
                                    <div class="dropdown bootstrap-select form-control default-select">
                                        <select id="name" name="name" class="form-control default-select" tabindex="-98">
                                            <option value="{{ $interface['interface'] }}" selected>{{ $interface['interface'] }}</option> 
                                            @foreach ($server as $data)
                                                <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Server</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
