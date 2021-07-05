@extends('layouts.manager')
@section('title','Add Patient Analysis')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-8" style="margin: auto;">
        <div class="card" style="width: 90%;">

            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">playlist_add</i>
                </div>
                <h4 class="card-title">Add Patient's Analysis</h4>


                <div class="card-body">
                    @include('alert.success')
                    @include('alert.errors')


                    <form method="get" action="{{route('manager.patientManagment.filter')}}">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">

                                <select id="nameid" name="patient_name" class="selectpicker"
                                    data-style="select-with-transition" title="Patient Name" data-size="7"
                                    style="width: 200px">

                                    @isset($patient)
                                    <option></option>
                                    @foreach($patient as $p)
                                    @if(@isset($p_name))
                                    <option value="{{$p->PATIENTNAME}}" @if($p->PATIENTNAME==$p_name)selected
                                        @endif>{{$p->PATIENTNAME}}</option>
                                    @else
                                    <option value="{{$p->PATIENTNAME}}">{{$p->PATIENTNAME}}</option>
                                    @endif
                                    @endforeach
                                    @endisset
                                </select>
                                @error("patient_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                <a href="{{route('manager.patientManagment.create')}}">
                                    <button type="button" class="btn btn-rose">
                                        ADD NEW PATIENT
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">

                                <select id="nameDid" name="doctor_name" class="selectpicker"
                                    data-style="select-with-transition" title="Doctor Name" data-size="7"
                                    style="width: 200px">
                                    @isset($doctor)
                                    <option></option>
                                    @foreach($doctor as $p)
                                    @if(@isset($d_name))
                                    <option value="{{$p->DOCTORNAME}}" @if($p->DOCTORNAME==$d_name)selected
                                        @endif>{{$p->DOCTORNAME}}</option>
                                    @else
                                    <option value="{{$p->DOCTORNAME}}">{{$p->DOCTORNAME}}</option>
                                    @endif
                                    @endforeach
                                    @endisset
                                </select>
                                @error("doctor_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="analysisid" name="analysis_name[]" class="selectpicker" multiple
                                    data-style="select-with-transition" multiple title="Analysis Name" data-size="7"
                                    style="width: 200px">

                                    @isset($analysis)
                                    <option></option>
                                    @foreach($analysis as $key=>$a)

                                    @if(@isset($analysis_prevoius))
                                    @if(in_array($a->analysis_name, $analysis_prevoius))
                                    <option value="{{$a->analysis_name}}" selected>{{$a->analysis_name}}---{{$a->price}}
                                    </option>
                                    @else
                                    <option value="{{$a->analysis_name}}">{{$a->analysis_name}}---{{$a->price}}</option>

                                    @endif
                                    @else
                                    <option value="{{$a->analysis_name}}">{{$a->analysis_name}}---{{$a->price}}</option>
                                    @endif
                                    @endforeach
                                    @endisset
                                </select>
                                @error("analysis_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-rose">Filter</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
$("#nameid").select2({
    placeholder: "Select  Patient Name",
    allowClear: true
});
$("#analysisid").select2({
    placeholder: "Select Analysis Name",
    allowClear: true
});
$("#nameDid").select2({
    placeholder: "Select  Doctor Name",
    allowClear: true
});
</script>



@endsection
