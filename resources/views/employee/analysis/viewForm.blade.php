@extends('layouts.employee')
@section('title','Show Form')
@section('content')
<style>
       .form-control:read-only {
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgb(255, 255, 255) 1px)}
    </style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Show Form</h4>
                <br>
                @include('alert.success')
                @include('alert.errors')
                <br>
                <div class="card-body">
                    @isset($analysis)
                    <form method="get" action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='{{$analysis->analysis_name}}' class="bmd-label-floating">Analysis
                                        Name</label>
                                    <input type='text' readonly class="form-control"  name='analysis_name'
                                        value="{{$analysis->analysis_name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for='' class="bmd-label-floating">Group Name</label>
                                <input type='text' readonly class="form-control"  name='analysis_group'
                                        value='{{$analysis->group->group_name}}'>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price" class="bmd-label-floating">Aanlysis Price</label>
                                    <input name='price'readonly class="form-control" type="text" value="{{$analysis->price}}">

                                </div>
                            </div>
                        </div>
                        @isset($normal_range)
                        @foreach($normal_range as $key => $tests)
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='{{$tests->input->input_name}}' class="bmd-label-floating">Input
                                                Name</label>
                                            <input type='text' readonly class="form-control" name='input_name[]'
                                                value="{{$tests->input->input_name}}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='' class="bmd-label-floating">Male-Range</label>
                                            <input type='text' readonly class="form-control" name='max_normal[]'
                                                value='{{$tests->high_range}}'>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='' class="bmd-label-floating">Female-Range</label>
                                            <input type='text' readonly class="form-control" name='min_normal[]'
                                                value='{{$tests->low_range}}'>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for='' class="bmd-label-floating">Unit</label>
                                            <input type='text' readonly class="form-control" name='unit[]'
                                                value='{{$tests->unit}}'>

                                        </div>
                                    </div>
                        </div>
                        @endforeach
                        @endisset
                        @isset($data)
                        <?php $increaseID = 0;?>
                        @foreach($data as $key => $op)
                        @foreach($op as $key1 => $op1)
                        <?php $increaseID++;?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='{{$key1}}' class="bmd-label-floating">Input Name</label>
                                            <input type='text' readonly class="form-control" name='optioInput[]'
                                                value="{{$key1}}">

                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                            @foreach($op1 as $key2 => $op3)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for='{{$op3}}'
                                                                class="bmd-label-floating">option</label>
                                                            <input type='text' readonly class="form-control"
                                                                name='optionoption{{$increaseID}}[]' value='{{$op3}}'>

                                                        </div>
                                                    </div>

                                                </div>

                                            @endforeach

                                     </div>
                                </div>
                        @endforeach
                        @endforeach
                        @endisset

                    </form>

                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
