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
                <h3 class="card-title">{{__('Roles table')}}</h3>
                <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm float-right">
                    <span class="fas fa-plus-circle"></span>
                    {{__('Create a role')}}
                </a>
            </div>
        </x-slot>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{__('No')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Guard')}}</th>
                    <th>{{__('Permissions')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @php($j = 1)
                @foreach($roles as $role)
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->guard_name}}</td>
                        <td>@foreach($role->permissions as $permission)
                                <button class="btn btn-secondary btn-xs">{{$permission->name}}</button>
                            @endforeach</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('roles.edit',$role->id)}}"
                                   class="btn btn-sm btn-warning">{{__('Update')}}</a>
                                <form action="{{ route('roles.destroy',$role->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="if (confirm('Are you sure to delete?')) {this.form.submit()}"> {{__('Delete')}}</button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @php($j++)
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>{{__('No')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Guard')}}</th>
                    <th>{{__('Permissions')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </x-management.table>
</x-app-layout>
