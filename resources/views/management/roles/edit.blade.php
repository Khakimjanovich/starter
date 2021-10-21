@extends('layouts.app')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Edit')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update',$role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name',$role->name) }}"
                                       required>
                                @if($errors->has('name') || 1)
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select multiple="multiple" name="permissions[]" size="30" class="duallistbox" aria-multiselectable="true">
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->name }}" {{ ($role->hasPermissionTo($permission->name)) ? "selected":'' }}>{{ $permission->name   }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="id" value="{{$role->id }}" required>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('Update')}}</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-default float-left">{{__('Cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('third_party_scripts')
    <script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <script>
        $(function () {
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()
        })
    </script>
@endsection
