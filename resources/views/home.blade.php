@extends('layouts.main')
@section('body')
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <h4 class="card-title">System date & time</h4>
                    <div>Time & date : {{ $date }} {{ $time }} </div>
                    <span>Uptime : {{ $uptime }} </span>
                    <div>Time Zone : {{ $zone }} </div>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-info" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <h4 class="card-title">System Info</h4>
                    <div>Name : {{ $platform }} </div>
                    <div>Model : {{ $model }} </div>
                    <div>Router OS : {{ $version }} </div>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-info" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="widget-stat card">
                <div class="card-body p-3">
                    <div class="row">
                        <!-- Existing CPU Load Grid -->
                        <div class="col-sm-4 mb-sm-0 mb-4 text-center">
                            <h5 class="fs-18 text-black">CPU Load</h5>
                            <div class="progress" style="height: 50px;">
                                <div id="cpu-progress" class="progress-bar bg-success progress-animated" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>

                        
                        <!-- New Free HDD Grid -->
                        <div class="col-sm-4 mb-sm-0 mb-4 text-center">
                            <h5 class="fs-18 text-black">Free HDD</h5>
                            <div class="progress" style="height: 50px;">
                                <div id="hdd-progress" class="progress-bar bg-info progress-animated" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-sm-0 mb-4 text-center">
                            <h5 class="fs-18 text-black">Free Memory</h5>
                            <div class="progress" style="height: 50px;">
                                <div id="memory-progress" class="progress-bar bg-primary progress-animated" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        

        <div class="col-xl-4  col-lg-4 col-sm-4">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-info text-info">
                            <i class="fa fa-wifi"></i>
                        </span>
                        <div class="media-body">
                            <h4 class="mb-0">{{ $ppp_active }}</h4>
                            <span class="badge badge-info">PPPoE Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4  col-lg-4 col-sm-4">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-info text-info">
                            <i class="fa fa-group"></i>
                        </span>
                        <div class="media-body">
                            <h4 class="mb-0"> {{ $ppp_user }}</h4>
                            <span class="badge badge-info">Secret</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4  col-lg-4 col-sm-4">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-info text-info">
                            <i class="fa fa-wrench"></i>
                        </span>
                        <div class="media-body">
                            <h4 class="mb-0">{{ $isolir }}</h4>
                            <span class="badge badge-info">PPPoE Isolir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-header border-0 flex-wrap pb-0">
                    <div class="mb-3">
                        <h4 class="fs-20 text-black">Interface Monitoring</h4>
                    </div>
                    <div class="dropdown  style-1 btn-secondary default-select dropup show">
                        <select class="style-1 btn-info default-select" tabindex="-98" name="interface" id="interface"
                            onchange="requestData()">
                            @foreach ($ether1 as $item)
                                <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body pb-2 px-3" style="position: relative;">
                    <div id="graph"></div>
                </div>
                <input type="hidden" id="nilaiRX" value="{{ \App\Routers\Bytes::bytes($rx, 2) }}">
                <input type="hidden" id="nilaiTX" value="{{ \App\Routers\Bytes::bytes($tx, 2) }}">
            </div>
        </div>

        <div class="col-xl-4 col-xxl-4">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="fs-20 text-black">Monitoring Log</h4>
                </div>
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">PPPoE</h4>
                    </div>
                    <div class="card-body">
                        <div class="widget-timeline dz-scroll style-1 height370 ps ps--active-y">
                            @foreach ($logppp as $data)
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-badge primary"></div>
                                        <a class="timeline-panel text-muted">
                                            <span>{{ $data['time'] }}</span>
                                            <h6 class="mb-0">{{ $data['message'] }} <strong
                                                    class="text-primary">{{ $data['userpppp'] }}</strong></h6>
                                        </a>
                                    </li>

                                </ul>
                            @endforeach

                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 370px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
