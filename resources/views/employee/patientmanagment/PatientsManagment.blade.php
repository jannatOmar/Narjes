@extends('layouts.employee')
@section('title','Patient Manangment')
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
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">manage_accounts</i>
                </div>
                <h4 class="card-title">Patients Managment</h4>
            </div>
            <br>

            <div class="col-md-12 float-right" style="width:250px;">
                <form class="navbar-form" method="get" action="{{route('employee.patient.search')}}">
                    @csrf
                    <div class="input-group no-border float-right">
                        <input type="text" name="name" value="@isset($q) {{$q}} @endisset" class="form-control"
                            data-toggle="tooltip" data-placement="top" title="Search By Patient Name"
                            placeholder="Search..." style="margin-top: 6px;">
                        <button type="submit" class="btn btn-rose btn-round btn-just-icon" style="position: static">
                            <div style="position:static; top:0px;right:0px;">
                                <i class="material-icons"
                                    style="padding-top: 1px;padding-left: 1px;padding-right: 1px;padding-botton: 4px;">search</i>
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
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Patient Name</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Birthday</th>
                                <th class="text-center" style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($patient)
                            @foreach($patient as $index)
                            <tr>
                                <td class="text-center">{{$index->patient_id}}</td>
                                <td class="text-center">{{$index->f_name}} {{$index->m_name}} {{$index->l_name}}</td>
                                <td class="text-center">{{$index->gender}}</td>
                                <td class="text-center">{{$index->address}}</td>
                                <td class="text-center">{{$index->email}}</td>
                                <td class="text-center">{{$index->phone}}</td>
                                <td class="text-center">{{$index->birthday}}</td>
                                <td class="td-actions text-center">
                                    
                                    <a href="{{route('employee.patientManagment.history',$index->patient_id)}}">
                                        <button type="button" rel="tooltip" class="btn btn-danger">
                                            <i class="material-icons">history</i>
                                        </button>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                            @endisset
                        </tbody>



                    </table>

                    <div class="d-flex justify-content-center"> {!! $patient->links() !!} </div>

                </div>
            </div>
        </div>
    </div>


</div>


@endsection