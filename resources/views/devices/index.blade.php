<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{\Illuminate\Support\Str::ucfirst('dashboard')}}</h1>
                </div>
                <x-breadcrumb/>
            </div>
        </div>
    </x-slot>
    <x-management.table>
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">{{__('Devices table')}}</h3>
            </div>
        </x-slot>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('IpV4')}}</th>
                <th>{{__('User')}}</th>
                <th>{{__('Platform')}}</th>
                <th>{{__('Browser')}}</th>
                <th>{{__('Device')}}</th>
                <th>{{__('Route')}}</th>
                <th>{{__('Count')}}</th>
            </tr>
            </thead>
            <tbody>
            @php($j = 1)
            @foreach($devices as $ip_address => $device)
                <tr>
                    <td>{{$j}}</td>
                    <td>{{$ip_address}}</td>
                    <td>
                        <div class="btn-group-xs">
                            @foreach($device['user'] as $user)
                                <button class="btn btn-xs btn-default">
                                    {{$user}}
                                </button>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            @foreach($device['platform'] as $platform)
                                <button class="btn btn-xs btn-default">
                                    {{$platform}}
                                </button>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            @foreach($device['browser'] as $browser)
                                <button class="btn btn-xs btn-default">
                                    {{$browser}}
                                </button>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            @foreach($device['device_type'] as $device_type)
                                <button class="btn btn-xs btn-default">
                                    {{$device_type}}
                                </button>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        @foreach($device['request'] as $request)
                            <div class="btn-group">
                                <button
                                    class="btn btn-xs
                                        @if($request['action'] === 'GET')
                                            {{'btn-primary'}}
                                        @elseif($request['action'] === 'PUT')
                                            {{'btn-warning'}}
                                        @elseif($request['action'] === 'POST')
                                            {{'btn-success'}}
                                        @elseif($request['action'] === 'DELETE')
                                            {{'btn-danger'}}
                                        @endif"
                                    >
                                    {{$request['action']}}
                                </button>
                                <button class="btn btn-xs btn-default">{{$request['route']}}</button>
                            </div>
                        @endforeach
                    </td>
                    <td>{{$device['count']}}</td>
                </tr>
                @php($j++)
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>{{__('IpV4')}}</th>
                <th>{{__('User')}}</th>
                <th>{{__('Platform')}}</th>
                <th>{{__('Browser')}}</th>
                <th>{{__('Device')}}</th>
                <th>{{__('Route')}}</th>
                <th>{{__('Count')}}</th>
            </tr>
            </tfoot>
        </table>
    </x-management.table>
</x-app-layout>
