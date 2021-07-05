@extends('layouts.admin')
@section('title','Show Results')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Show Results</h4>
                <br>
                @include('alert.errors')
                @include('alert.success')
                <br>
                <div class="card-body">
                    <form class="navbar-form col-lg-12 form" method="post" action="">
                        @csrf

                        <div class="row">
                            @isset($patient)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Name</label>
                                    <input type="text" disabled class="form-control" name="name"
                                        value="{{$patient->PATIENTNAME}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Gender</label>
                                    <input type="text" disabled class="form-control" name="gender"
                                        value="{{$patient->gender}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Age</label>
                                    <input type="text" disabled class="form-control" name="age"
                                        value="{{$age}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Birthday</label>
                                    <input type="text" disabled class="form-control" name="birthday"
                                        value="{{$patient->birthday}}">
                                </div>
                            </div>
                            @endisset
                        </div>

                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating" style="font-size: 12px;">Doctor name</label>
                                    <input type='text' class="form-control" disabled name='result'
                                        value='@isset($doctor_name) {{$doctor_name[0]->doctor_name}} @endisset'>

                                </div>
                            </div>
                            
                            @isset($normal_range)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating" style="font-size: 12px;">Analysis Name</label>
                                    <input type='text' disabled class="form-control" name='analysis_name'
                                        value="{{$normal_range[0]->analysis->analysis_name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating" style="font-size: 12px;">Analysis Group</label>
                                    <input type='text' class="form-control" name='group' disabled
                                        value="{{$normal_range[0]->analysis->group->group_name}}">
                                </div>
                            </div>

                            @endisset

                        </div>
                        <br>
                        <div style="display:inline-block;">
                            @isset($results)
                            @foreach($results as $key => $tests)
                            <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="font-size: 12px;">Input Name</label>
                                        <input type='text' class="form-control" disabled name='input_name[]'
                                            value="{{$tests->input->input_name}}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="font-size: 12px;">Data</label>
                                        <input type='text' class="form-control" disabled name='result[]'
                                            value='{{$tests->data}}'>

                                    </div>
                                </div>
                            </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        <div style='display: inline-block; float: right;'>
                            @isset($normal_range)
                            @foreach($normal_range as $key => $tests)
                      <div class="col-md-12">

                            <div class="row">
                            
                            @isset($patient)
                               @if($patient->gender=="male")
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="font-size: 12px;">Male-Range</label>
                                        <input type='text' class="form-control" disabled name='max_normal[]'
                                            value='{{$tests->high_range}}'>

                                    </div>
                                </div>
                                
                                @endif
                               @endisset
                               @isset($patient)
                               @if($patient->gender=="female")
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="font-size: 12px;">Female-Range</label>
                                        <input type='text' class="form-control" disabled name='min_normal[]'
                                            value='{{$tests->low_range}}'>

                                    </div>
                                </div>
                                @endif
                               @endisset
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" style="font-size: 12px;">Unit</label>
                                        <input type='text' class="form-control" disabled name='min_normal[]'
                                            value='{{$tests->unit}}'>

                                    </div>
                                </div>
                            </div>
                            </div>
                            @endforeach
                            @endisset

                        </div>
                        <br>
                        <br>
                        <div>

                            <button type="button" rel="tooltip" class="btn btn-rose" style="margin-right: 20px;">
                                Send Result To Patient
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-rose" style="margin-right: 20px;">
                                print
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
