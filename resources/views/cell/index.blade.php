@extends('layouts.master')
@section('title')
    All cell
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cells </h3>

            <div class="box-tools pull-right mb-2">
                <a href="{{ url('cell/create') }}" class="btn btn-info btn-sm">
                    Create cell
                </a>
            </div>
        </div>
        <div class="box-body">
            <table id="" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Leader</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cells as $key => $cell)
                        <tr>
                            <td>{{ $cell->id }}</td>
                            <td>{{ $cell->name }}</td>
                            <td>
                                <a href="{{ url('member/' . $cell->leader . '/show') }}" target="blank_">
                                    {{ $cell->leader()->last_name . ' ' . $cell->leader()->first_name }}
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ trans('general.choose') }} <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        {{-- <li>
                                            <a href="{{ url('cell.show', $cell->id) }}">
                                                <i class="fa fa-search"></i>
                                                {{ trans_choice('general.detail', 2) }}
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route('cell.edit', $cell->id) }}">
                                                <i class="fa fa-edit"></i>
                                                {{ trans('general.edit') }}
                                            </a>
                                        </li>
                                        <li>


                                            <!-- Formulaire pour supprimer un Post : "posts.destroy" -->
                                            <form method="POST" action="{{ route('cell.destroy', $cell->id) }}">
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
