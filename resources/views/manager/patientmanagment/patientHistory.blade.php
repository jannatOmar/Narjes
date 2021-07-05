@extends('layouts.manager')
@section('title','Patient History')
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
                    <i class="material-icons">description</i>
                </div>
                <h4 class="card-title">Patient's Records </h4>
                <br>
            </div>
            
            

          
            <div class="col-md-12 " style="width:250px;">
                    <form class="navbar-form" action="{{route('manager.patientHistory.search',$patient_id)}}">
                        <div class="input-group no-border">
                            <input type="text" value="@isset($search) {{$search}} @endisset" name="name" class="form-control" data-toggle="tooltip"
                                data-placement="top" title="Search By Analysis Name" placeholder="Search..."
                                style="margin-top: 6px;">
                            <button type="submit" class="btn btn-rose btn-round btn-just-icon" style="position:static">
                                <div style="position:static; top:0px;right:0px;">
                                    <i class="material-icons" style="padding-top: 2px;padding-left:1px;">search</i>
                                </div>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                </div>
                 
            <div class="card-body">
                @include('alert.success')
            @include('alert.errors')
            <div class="table-responsive">
                <table class="table">
                @isset($analysis)

                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Analysis Name</th>
                            <th class="text-center">Doctor Name</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($analysis as $req)
                        <tr>
                            <td class="text-center">{{$req->id}}</td>
                            <td class="text-center">{{$req->analysis[0]->analysis_name}}</td>
                            <td class="text-center">{{$req->doctor[0]->f_name}} {{$req->doctor[0]->m_name}}
                                {{$req->doctor[0]->l_name}}</td>
                            <td class="text-center">{{$req->result_time}}</td>
                            <td class="text-center">

                                <a
                                    href="{{route('manager.patientManagment.result',['analysis_id'=>$req->analysis[0]->analysis_id,'patient_id'=>$patient_id,'analysis_required_id'=>$req->id])}}">
                                    <button type="button" rel="tooltip" class="btn btn-success">
                                        Show Result
                                    </button>
                                </a>
                               
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    @endisset

                </table>
                <div class="d-flex justify-content-center"> {!! $analysis->links() !!} </div>


            </div>
        </div>
    </div>
    </div>
</div>


@endsection