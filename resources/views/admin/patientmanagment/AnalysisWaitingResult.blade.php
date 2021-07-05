@extends('layouts.admin')
@section('title','Analysis Waiting Result')
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">
                        hourglass_bottom
                    </i>
                </div>
                <h4 class="card-title">Analysis Waiting Result</h4>
                <br>

                
                @include('alert.success')
                @include('alert.errors')
                <div class="col-md-12 " style="width:250px;   ">
                    <form class="navbar-form" action="{{route('admin.patient.searchAnalysisWaitingResult')}}"
                        method="get">
                        <div class="input-group no-border">
                            <input type="text" value="@isset($search) {{$search}} @endisset" name="name" class="form-control" placeholder="Search..."
                                data-toggle="tooltip" data-placement="top" title="Search By Patient Name"
                                style="margin-top: 6px;">
                            <button type="submit" class="btn btn-rose btn-round btn-just-icon" style="position: static">
                                <div style="position:static; top:0px;right:0px;">
                                    <i class="material-icons" style="padding-top: 5px;padding-left:8px;">search</i>
                                </div>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <br>

               <div class="card-body">
            <div class="table-responsive">
                @isset($patient)
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Patient Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient as $pat)
                        <tr>
                            <td class="text-center">{{$pat->patient_id}}</td>
                            <td class="text-center">{{$pat->patient[0]->f_name}} {{$pat->patient[0]->m_name}}
                                {{$pat->patient[0]->l_name}} </td>

                            <td class="td-actions text-center">
                                <a href="{{route('admin.patient.showRequiredAnalysis',$pat->patient_id)}}">
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        {{$pat->total}} Analysis
                                    </button>
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center"> {!! $patient->links() !!} </div>
                @endisset

            </div>
        </div>
    </div>
    </div>
</div>
@endsection