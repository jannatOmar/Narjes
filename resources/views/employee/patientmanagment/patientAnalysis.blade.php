@extends('layouts.employee')
@section('title','Patient Analysis')
@section('content')
<style>
    .pagination>.page-item.active>a,
.pagination>.page-item.active>a:focus,
.pagination>.page-item.active>a:hover,
.pagination>.page-item.active>span,
.pagination>.page-item.active>span:focus,
.pagination>.page-item.active>span:hover {
  background-color: #e42c6c;
  border-color: #9c27b0;
  color: #fff;
  box-shadow: 0 4px 5px 0 rgba(156, 39, 176, 0.14), 0 1px 10px 0 rgba(156, 39, 176, 0.12), 0 2px 4px -1px rgba(156, 39, 176, 0.2);
  
}
.form-control,
.is-focused .form-control {
  background-image: linear-gradient(to top, #e42c6c 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
}
</style>
<div class="row">
    <div class="col-md-12" >
        <div class="card" >
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">
                        hourglass_bottom
                    </i>
                </div>
                <h4 class="card-title">Patient Analysis</h4>

            </div>

            @isset($patient)

            <div class="card-body">
            
            <div class="row" style="margin-left: 0;margin-top: 40px;">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Patient Name</label>
                        <input type="text" disabled class="form-control" name="f_name"
                            value="{{$patient->PATIENTNAME}}">

                    </div>
                </div>
            </div>
            <br>
            @include('alert.success')
            @include('alert.errors')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Analysis Name</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($analysis)
                        @foreach($analysis as $d=>$test)
                        <tr>
                            <td class="text-center">{{$test->id}}</td>
                            <td class="text-center">{{$test->analysis[0]->analysis_name}}</td>
                            <td class="text-center">{{$test->created_at}}</td>

                            <td class="td-actions text-center">
                                <a
                                    href="{{route('employee.patient.enterResult',['analysis_id'=>$test->analysis_id,'patient_id'=>$patient->patient_id,'analysis_required_id'=>$test->id])}}">
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        Enter Result
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
                <div class="d-flex justify-content-center"> {!! $analysis->links() !!} </div>

            </div>

            @endisset
            </div>
        </div>
    </div>
</div>
@endsection