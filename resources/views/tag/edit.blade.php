@extends('layouts.master')
@section('title')
    {{ __('Edit organization') }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ __('Edit organization') }}
            </h3>
            {{-- <div class="box-tools pull-right">
            </div> --}}
        </div>

        <div class="mb-3 text-black-500 p-3">
            <form method="POST" action="{{ url('organization/' . $tag->id . '/update') }}">
                @csrf

                <label class="font-weight-bold" for="name">
                    {{ __('organization name') }}
                    <span class="text-red">*</span>
                </label>
                <div class="mt-2">
                    <input id="name" class="form-control" type="text" name="name"
                        value="{{ old('name') ?? $tag->name }}" placeholder="The organization name" required />

                    @error('name')
                        <span class="inputerror  text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class=" col-12 mt-4">

                    <label> {{ __('User') }} <span class="text-red">*</span> </label>
                    <select name="user_id" class="form-control" required>
                        <option value="">User </option>
                        @foreach ($users as $key => $user)
                            <option value="{{ $user->id }}" @if ($tag->user_id = $user->id) selected @endif>
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <br />

                <div class="col-12 mt-4">

                    <p class="bg-navy disabled color-palette">
                        {{ trans_choice('general.optional', 1) }}
                        {{ trans_choice('general.field', 2) }}
                    </p>
                    <div class="form-group">
                        {!! Form::label('notes', trans_choice('general.note', 2), ['class' => '']) !!}
                        {!! Form::textarea('notes', $tag->notes, ['class' => 'form-control']) !!}
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right mb-2"
                        id="add_cell">{{ trans_choice('general.save', 1) }}
                    </button>
                </div>

            </form>
        </div>

    </div>
    <!-- /.box-body -->

    <!-- /.box -->
@endsection
@section('footer-scripts')
@endsection
