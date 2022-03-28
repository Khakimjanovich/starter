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
    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Edit')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('permissions.update',$permission->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name',$permission->name) }}"
                                       required>
                                @if($errors->has('name') || 1)
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <input type="hidden" name="id" value="{{$permission->id }}" required>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('Update')}}</button>
                                <a href="{{ route('permissions.index') }}" class="btn btn-default float-left">{{__('Back')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
