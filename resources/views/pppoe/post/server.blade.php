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
                        <form method="post" action="{{ route('add.server') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Service Name</label>
                                    <input type="text" class="form-control" id="service" name="service"
                                        placeholder="Name Server">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Interface</label>
                                    <div class="dropdown bootstrap-select form-control default-select">
                                        <select id="name" name="name" class="form-control default-select"
                                            tabindex="-98">
                                            <option selected="">Choose...</option>
                                            @foreach ($interface as $data)
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
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Interface</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="table-responsive" style="max-height: 200px;  overflow-y: auto;  white-space: nowrap; overflow-y: auto;" >
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>No.</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($interface) > 0)
                                        @foreach ($interface as $no => $data)
                                            <tr>
                                                <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                                <td><strong>{{ $no + 1 }}</strong></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="w-space-no">{{ $data['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($data['running'] === 'true')
                                                        <i class="fa fa-circle text-success mr-1"></i>
                                                        Running
                                                    @else
                                                        <i class="fa fa-circle text-danger mr-1"></i>
                                                        Not Running
                                                    @endif
                                                </td>


                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">server not found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
