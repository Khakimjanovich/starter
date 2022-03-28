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
                <h3 class="card-title">{{__('Permissions table')}}</h3>
                <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm float-right">
                    <span class="fas fa-plus-circle"></span>
                    {{__('Create a permission')}}
                </a>
            </div>
        </x-slot>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @php($j = 1)
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$j}}</td>
                    <td>{{$permission->name}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('permissions.edit',$permission->id)}}"
                               class="btn btn-sm btn-warning">{{__('Update')}}</a>
                            <form action="{{ route('permissions.destroy',$permission->id) }}" method="post">
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
                <th>#</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
            </tfoot>
        </table>
    </x-management.table>
</x-app-layout>
