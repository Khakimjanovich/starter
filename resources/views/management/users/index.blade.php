@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('Users table')}}</h3>
                    @can('add-users')
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                            {{__('Create a user')}}
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{__('No')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Role')}}</th>
                            <th>{{__('Created at')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($j = 1)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$j}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->roles->first()?->name}}</td>
                                <td>{{$user->created_at->format('d M Y H:i')}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-warning">{{__('Update')}}</a>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="post">
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
                            <th>{{__('Email')}}</th>
                            <th>{{__('Role')}}</th>
                            <th>{{__('Created at')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
