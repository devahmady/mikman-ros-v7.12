@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-sm-flex d-block">
                    <div class="mr-auto mb-sm-0 mb-3">
                        <h4 class="card-title mb-2">List Profile</h4>
                    </div>
                    <a href="/pppoe/add/profile" class="btn btn-info">+ Add Profile</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Local Address</th>
                                    <th>Remote Address </th>
                                    <th>parent queue</th>
                                    <th>Rite Limit (rx/tx)</th>
                                    <th>Isolirmode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{-- @dd($profile) --}}
                            <tbody>
                                @if (count($profile) > 0)
                                    @foreach ($profile as $no => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td><strong>{{ $no + 1 }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center"> <span
                                                        class="w-space-no">{{ $data['name'] }}</span></div>
                                            </td>
                                            <td>{{ $data['local-address'] ?? 'none' }}</td>
                                            <td>{{ $data['remote-address'] ?? '' }}</td>
                                            <td>{{ $data['parent-queue'] ?? 'none' }}</td>
                                            <td>{{ $data['rate-limit'] ?? '' }}</td>
                                            <td>
                                                @if (isset($detail[$no]))
                                                    {{ $detail[$no]['isolirmode'] ?? '' }}
                                                @else
                                                    none
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex ">
                                                    <a href="{{ route('show.profile', $id) }}"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('dell.profile', ['id' => $data['.id']]) }}"
                                                        class="btn btn-danger shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-trash"></i></a>
                                                    <a href="{{ route('profile.detail', ['id' => $data['.id']]) }}"
                                                        class="btn btn-info shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-eye"></i></a>

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
