@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-sm-flex d-block">
                    <div class="mr-auto mb-sm-0 mb-3">
                        <h4 class="card-title mb-2">
                            @foreach ($data as $profile)
                                <p>
                                    <span class="badge light badge-info">Profile: {{ $profile['detail']['name'] }}</span>
                                    <span class="badge light badge-primary">Limit Profile:
                                        {{ $profile['detail']['rate-limit'] }}</span>
                                </p>
                            @endforeach
                        </h4>
                    </div>
                    {{-- @dd($data) --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>password</th>
                                    <th>Local address</th>
                                    <th>Remote address</th>
                                    <th>service</th>
                                    <th>last-logged-out</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($data) && !empty($data))
                                    @foreach ($data as $item)
                                        @foreach ($item['secrets'] as $secret)
                                            <tr>
                                                <td><strong>{{ $loop->iteration }}</strong></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="w-space-no">{{ $secret['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $secret['password'] ?? '' }}</td>
                                                <td>{{ $secret['local-address'] ?? 'none' }}</td>
                                                <td>{{ $secret['remote-address'] ?? 'none' }}</td>
                                                <td>{{ $secret['service'] ?? 'none' }}</td>
                                                <td>{{ $secret['last-logged-out'] }}</td>
                                                <td>{{ $secret['comment'] }}</td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <p>Data tidak ditemukan</p>
                                @endif


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
