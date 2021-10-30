@extends('layouts.manager')
@section('title','Enter Result')
@section('content')
<style>
       .form-control:read-only {
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgb(255, 255, 255) 1px)}
    </style>
<div class="row">
    <div class="col-md-12" style="margin: auto;">
        <div class="card" style="width: 90%;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">
                        hourglass_bottom
                    </i>
                </div>
                <h4 class="card-title">Enter Result</h4>

            </div>
            @include('alert.success')
            @include('alert.errors')
            <form style="padding:30px" method="post"
                action="{{route('manager.patient.saveResult',['analysis_required_id'=>$analysis_required_id,'analysis_id'=>$analysis_id])}}">
                @csrf
                <div class="row">
                    @isset($patient)
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Name</label>
                            <input type="text" readonly class="form-control" name="name"
                                value="{{$patient->PATIENTNAME}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Gender</label>
                            <input type="text" readonly class="form-control" name="gender"
                                value="{{$patient->gender}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Age</label>
                            <input type="text" readonly class="form-control" name="age" value="{{$age}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Birthday</label>
                            <input type="text" readonly class="form-control" name="birthday"
                                value="{{$patient->birthday}}">
                        </div>
                    </div>
                    @endisset
                </div>
                <br>
                @isset($analysis)
                @foreach($analysis as $d=>$test)
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Doctor Name</label>
                            <input type="text" class="form-control" readonly name="doctor_name"
                                value="{{$test->doctor[0]->f_name}} {{$test->doctor[0]->m_name}} {{$test->doctor[0]->l_name}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Analysis Name</label>
                            <input type="text" readonly class="form-control" name="analysis_name"
                                value="{{$test->analysis[0]->analysis_name}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="bmd-label-floating">Analysis Group</label>
                            <input type="text" readonly class="form-control" name="analysis_group"
                                value="{{$test->analysis[0]->group->group_name}}">
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
                <br>
                <br>
                <div>
                <div style="display:inline-block;width: 65%;">

                @isset($normal_range)
                @foreach($normal_range as $key => $tests)

                <div class="row"  style="display: inline-block; max-width: 100%;">
                    <div class="col-md-2" style="display:inline-block;max-width: 22%;">
                        <div class="form-group">
                            <label for='{{$tests->input->input_name}}' class="bmd-label-floating">Input Name</label>
                            <input type='text' readonly name='input_name[]' class="form-control"
                                value="{{$tests->input->input_name}}">
                            @error("input_name.$key")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2" style="display:inline-block;max-width: 22%;">
                        <div class="form-group">
                            <label class="bmd-label-floating">Data</label>
                            <input type='text' name='Data[]' class="form-control" value="{{ old('Data.'.$key) }}">
                            @error("Data.$key")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    
                    @isset($patient)
                    @if($patient->gender=="male")
                    <div class="col-md-2" style="display:inline-block;max-width: 22%;">
                        <div class="form-group">
                            <label class="bmd-label-floating">Male-Range</label>
                            <input type='text' name='max_normal[]' readonly class="form-control"
                                value='{{$tests->high_range}}'>
                        </div>
                    </div>
                    @endif
                    @endisset
                    
                    @isset($patient)
                    @if($patient->gender=="female")
                    <div class="col-md-2" style="display:inline-block;max-width: 22%;">
                        <div class="form-group">
                            <label class="bmd-label-floating">Female-Range</label>
                            <input type='text' name='min_normal[]' readonly class="form-control"
                                value='{{$tests->low_range}}'>
                        </div>
                    </div>
                    @endif
                    @endisset
                    <div class="col-md-2" style="display:inline-block;max-width: 22%;">
                        <div class="form-group">
                            <label class="bmd-label-floating">Unit</label>
                            <input type='text' name='unit[]' readonly class="form-control"
                                value='{{$tests->unit}}'>
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset

                @isset($data)
                @foreach($data as $key => $op)
                @foreach($op as $key1 => $op1)
                <div class="row"  style="display: block;max-width: 100%;margin-bottom: -10px;">
                    <div class="col-md-2"  style="display:inline-block;max-width: 44%;">
                        <div class="form-group">
                            <label for='' class="bmd-label-floating">Input Name</label>
                            <input type='text' readonly name='input_Op[]' class="form-control" value="{{$key1}}">
                            @error("input_Op.$key")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2"  style="display:inline-block;max-width: 44%;">
                        <div class="form-group">
                            <select class="selectpicker" name="Data_Op[]" data-style="select-with-transition"
                                title="Result" data-size="7">
                                <option disabled>Choose Result</option>
                                @foreach($op1 as $key2 => $option_name)
                                <option value="{{$option_name->option_name}}">{{$option_name->option_name}}</option>
                                @endforeach
                            </select>
                            @error("Data_Op.$key")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                @endisset
               </div>
             <div class="col" style="display: inline-block;width: 20%;padding: 0;">

                @isset($last_result)
                   @foreach($last_result as $index=>$data)
                   <div class="col-md-2" style="max-width: 100%;">
                        <div class="form-group">
                          <label for='{{$data->data}}' class="bmd-label-floating">Last Result</label>
                          <input type='text' readonly name='last_result[]' class="form-control"
                                value="{{$data->data}}">
                        </div>
                    </div>
                   @endforeach
                  @endisset
             </div>
        
        </div>

                <br><br>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-rose  col-md-3 "> Save Result</button>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-rose  col-md-3"> Print</button>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-rose col-md-3 "> Send to patient</button>
                    <div class="clearfix"></div>
                </div>

                <br>
                <br>
            </form>

        </div>
    </div>
</div>
@endsection
