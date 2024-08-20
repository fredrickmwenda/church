@extends('layouts.master')
@section('title')
    {{ __('Create cell') }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ __('Create cell') }}
            </h3>
            {{-- <div class="box-tools pull-right">
            </div> --}}
        </div>

        <div class="mb-3 text-black-500 p-3">
            <form method="POST" action="{{ route('cell.store') }}">
                @csrf

                <label class="font-weight-bold" for="nom">
                    {{ __('Cell name') }}
                    <span class="text-red">*</span>
                </label>
                <div class="mt-2">
                    <input id="nom" class="form-control" ype="text" name="name" value="{{ old('name') }}"
                        placeholder="The cell name" required />

                    @error('name')
                        <span class="inputerror  text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class=" col-12 mt-4">
                    {{-- "branch_id" => 1
        "user_id" => 1
        "first_name" => "Esi Nkrumah"
        "middle_name" => null
        "last_name" => "Diana"
        "gender" => "male"
        "status" => "attender"
        "marital_status" => "married"
        "dob" => null
        "deceased" => null
        "home_phone" => "0245168178"
        "mobile_phone" => null
        "work_phone" => null
        "email" => "esi@msoftghana.com"
        "address" => "Tema Community 5"
        "notes" => null
        "photo" => "Diana.jpg"
        "files" => "a:0:{}"
        "created_at" => "2020-03-14 05:30:04"
        "updated_at" => "2021-10-20 19:44:39"
        "cell_id" => null --}}

                    <label> {{ __('Cell ledear') }} <span class="text-red">*</span> </label>
                    <select name="leader" class="form-control" required>
                        <option value="">Who is cell leader </option>
                        @foreach ($members as $key => $member)
                            <option value="{{ $member->id }}">
                                {{ $member->first_name . ' ' . $member->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <br />
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"
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
