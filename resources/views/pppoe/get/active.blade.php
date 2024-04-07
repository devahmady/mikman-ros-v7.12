@extends('layouts.main')
@section('body')
    <div class="card">
        <div class="card-header d-sm-flex d-block">
            <div class="mr-auto mb-sm-0 mb-3">
                <h4 class="card-title mb-2">User Active</h4>
            </div>
            <a href="/pppoe/add/secret" class="btn btn-info">+ Add Secret</a>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 795px;  overflow-y: auto;  white-space: nowrap; overflow-y: auto;">
                <div id="ListDatatableView_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table style-1 dataTable no-footer" id="ListDatatableView" role="grid"
                        aria-describedby="ListDatatableView_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending"
                                    style="width: 36.5938px;">#</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="CUSTOMER: activate to sort column ascending"
                                    style="width: 226px;">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="COUNTRY: activate to sort column ascending"
                                    style="width: 101.219px;">service</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="DATE: activate to sort column ascending"
                                    style="width: 107.578px;">Remote Address</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="COMPANY NAME: activate to sort column ascending"
                                    style="width: 163.828px;">Uptime</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="COMPANY NAME: activate to sort column ascending"
                                    style="width: 163.828px;">Down</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="COMPANY NAME: activate to sort column ascending"
                                    style="width: 163.828px;">Up</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="STATUS: activate to sort column ascending"
                                    style="width: 104.469px;">Caller id</th>
                                <th class="sorting" tabindex="0" aria-controls="ListDatatableView" rowspan="1"
                                    colspan="1" aria-label="ACTION: activate to sort column ascending"
                                    style="width: 119.312px;">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($active) > 0)
                                @foreach ($active as $no => $data)
                                    <tr role="row" class="odd">
                                        <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                        <td class="sorting_1">
                                            <h6>{{ $no + 1 }}</h6>
                                        </td>
                                        <td>
                                            <div class="media style-1">
                                                <div class="media-body">
                                                    <h6>{{ $data['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6>{{ $data['service'] }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="text-primary">{{ $data['address'] ?? 'none' }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $data['uptime'] }}
                                        </td>
                                        <td>
                                            {{ \App\Routers\Bytes::bytes($data['limit-bytes-in'], 2) }}
                                        </td>
                                        <td>
                                            {{ \App\Routers\Bytes::bytes($data['limit-bytes-out'], 2) }}
                                        </td>
                                        <td><span class="badge badge-warning">{{ $data['caller-id'] }}</span></td>
                                        <td>
                                            <div class="d-flex action-button">
                                                <a href="{{ route('dellactive', ['id' => $data['.id']]) }}"
                                                    class="btn btn-danger shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">User Online not found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
