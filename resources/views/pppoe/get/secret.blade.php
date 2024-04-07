@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-sm-flex d-block">
                    <div class="mr-auto mb-sm-0 mb-3">
                        <h4 class="card-title mb-2">List Secret</h4>
                    </div>
                    <a href="/pppoe/add/secret" class="btn btn-info">+ Add Secret</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 795px;  overflow-y: auto;  white-space: nowrap; overflow-y: auto;">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Remote Address </th>
                                    <th>Profile </th>
                                    <th>service </th>
                                    {{-- <th>status</th> --}}
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{-- @dd($secret)    --}}
                            <tbody>
                                @if (count($secret) > 0)
                                    @foreach ($secret as $no => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td><strong>{{ $no + 1 }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center"> <span
                                                        class="w-space-no">{{ $data['name'] }}</span></div>
                                            </td>
                                            <td>{{ $data['password'] ?? '' }}</td>
                                            <td>{{ $data['remote-address'] ?? 'none' }}</td>
                                            <td>{{ $data['profile'] }}</td>
                                            <td>{{ $data['service'] }}</td>

                                            <td>{{ $data['comment'] }}</td>
                                            <td>
                                                <div class="d-flex ">
                                                    <a href="{{ route('secret.update', $id) }}"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('dellsecret', ['id' => $data['.id']]) }}"
                                                        class="btn btn-danger shadow btn-xs sharp mr-1"><i
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
