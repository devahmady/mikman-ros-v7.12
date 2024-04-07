@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-sm-flex d-block">
                    <div class="mr-auto mb-sm-0 mb-3">
                        <h4 class="card-title mb-2">List Server</h4>
                    </div>
                    <a href="/pppoe/add/server" class="btn btn-info">+ Add Server</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    
                                    <th><strong>Mode</strong></th>
                                    <th><strong>NO.</strong></th>
                                    <th><strong>Service Name</strong></th>
                                    <th><strong>Interface</strong></th>
                                    <th><strong>Default profile</strong></th>
                                    <th><strong>Status</strong></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($server) > 0)
                                    @foreach ($server as $no => $data)
                                        <tr>
                                            <th style="width:50px;">
                                                <div class="check-lg mr-3">
                                                    <button type="button" class="badge {{ $data['disabled'] == 'true' ? 'badge-danger' : 'badge-success' }} btn-toggle"
                                                            data-id="{{ $data['.id'] }}"
                                                            data-status="{{ $data['disabled'] == 'true' ? 'disable' : 'enable' }}">
                                                        {{ $data['disabled'] == 'true' ? 'Disable' : 'Enable' }}
                                                    </button>
                                                </div>
                                            </th>
                                            
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td><strong>{{ $no + 1 }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center"> <span
                                                        class="w-space-no">{{ $data['service-name'] }}</span></div>
                                            </td>
                                            <td>{{ $data['interface'] }}</td>
                                            <td>{{ $data['default-profile'] }}</td>
                                           
                                            <td id="status{{ $no }}">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-circle {{ $data['disabled'] == 'false' ? 'text-success' : 'text-danger' }} mr-1">
                                                        {{ $data['disabled'] == 'false' ? 'Enable' : 'Disable' }}
                                                    </i>
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('show.server', $id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <a href="{{ route('dellserver', ['id' => $data['.id']]) }}" class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
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
@endsection
