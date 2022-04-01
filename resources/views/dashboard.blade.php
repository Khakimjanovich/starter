<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{\Illuminate\Support\Str::ucfirst('dashboard')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{\Illuminate\Support\Str::upper('dashboard')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('Members')}}</span>
                        <span class="info-box-number">{{$usersQuantity}}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <div class="info-box mb-3 text-decoration-none">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coffee"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Buy me a coffee</span>
                        <div class="row">
                            <div class="col-12">
                                <div class="btn-group">
                                    <select class="form-control select2" id="plan">
                                        @foreach($plans as $key => $plan)

                                            <option value="{{$plan}}"
                                                    @if($plan ==='subscribed'){{'disabled'}}@endif
                                                    @if ($loop->first) {{'selected'}} @endif
                                            >
                                                <span class="info-box-number">{{$key}}</span>
                                                @if($plan === 'subscribed')
                                                    <span class="oi oi-circle-check success"></span>
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-success"
                                            onclick="window.location.href = document.getElementById('plan').value">Buy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
