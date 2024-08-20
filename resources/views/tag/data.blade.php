@extends('layouts.master')
@section('title')
    All Organizations
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Organizations </h3>

            <div class="box-tools pull-right mb-2">
                <a href="{{ url('organization/create') }}" class="btn btn-info btn-sm">
                    Create Organization
                </a>
            </div>
        </div>

        {{-- 
        Organization
        "id" => 1
        "user_id" => 1
        "parent_id" => 0
        "name" => "Woman Fellowship"
        "notes" => null
        
         --}}

        <div class="box-body">
            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Notes</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organizations as $key => $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->notes }}</td>
                            <td>
                                @if (!is_null($tag->user_id))
                                    <a href="{{ url('user/' . $tag->user_id . '/show') }}" target="blank_">
                                        @php
                                            $user = App\Models\User::findOrFail($tag->user_id);
                                        @endphp
                                        {{ $user->first_name . ' ' . $user->last_name }}
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ trans('general.choose') }} <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">

                                        <li>
                                            <a href="{{ url('organization/' . $tag->id . '/edit') }}">
                                                <i class="fa fa-edit"></i>
                                                {{ trans('general.edit') }}
                                            </a>
                                        </li>
                                        <li>

                                            <!-- Formulaire pour supprimer un Post : "posts.destroy" -->
                                            <form method="POST" action="{{ url('organization/' . $tag->id . '/destroy') }}">
                                                <!-- CSRF token -->
                                                @csrf
                                                <!-- <input type="hidden" name="_method" value="DELETE"> -->
                                                @method('DELETE')
                                                <button class="_delete text-danger" type="submit"
                                                    style="width:100%; border:0px ; background:none;"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                    {{ trans('general.delete') }}
                                                </button>

                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
