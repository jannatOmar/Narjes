@extends('layouts.admin')
@section('title','Show Analysis')
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
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Show Analysis</h4>
                </div>
                <br>

                @include('alert.success')
                @include('alert.errors')

                <div class="row" style="margin-right: 0px;margin-left: 0px;">
                    <div class="col-12 col-sm-6">
                        <form method="get" action="{{route('admin.filter')}}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <select class="selectpicker" name="group" data-style="select-with-transition"
                                        title="Group Name" data-size="7">
                                        @if(isset($group))
                                        <option disabled>Group Analysis</option>
                                        <option selected value="0">ALL ANALYSIS </option>
                                        <option value="1" @if($group==1) selected @endif>BIOCHEMISTRY </option>
                                        <option value="2" @if($group==2) selected @endif>SEROLOGY</option>
                                        <option value="3" @if($group==3) selected @endif>HEAMTOLOGY</option>
                                        <option value="4" @if($group==4) selected @endif>URINE ANALYSIS</option>
                                        <option value="5" @if($group==5) selected @endif>DIFFERENTIAL </option>
                                        <option value="6" @if($group==6) selected @endif>STOOLANALYSIS</option>
                                        <option value="7" @if($group==7) selected @endif>CULTURE </option>
                                        <option value="8" @if($group==8) selected @endif>OTHERS</option>
                                        @else
                                        <option disabled>Group Analysis</option>
                                        <option selected value="0">ALL ANALYSIS </option>
                                        <option value="1">BIOCHEMISTRY </option>
                                        <option value="2">SEROLOGY</option>
                                        <option value="3">HEAMTOLOGY</option>
                                        <option value="4">URINE ANALYSIS</option>
                                        <option value="5">DIFFERENTIAL </option>
                                        <option value="6">STOOLANALYSIS</option>
                                        <option value="7">CULTURE </option>
                                        <option value="8">OTHERS</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-2">
                                    <button type="submit" class="btn btn-rose  " style="padding:10px; position: static">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="offset-sm-2"></div>
                    <div class="col-12 col-sm-4">
                        <form class="navbar-form" method="get" action="{{route('admin.search')}}">
                            @csrf
                            <div class="input-group no-border ">
                                <input type="text" name="name" value="@isset($q) {{$q}} @endisset" class="form-control"
                                    data-toggle="tooltip" data-placement="top" title="Search By Analysis Name Or Price"
                                    placeholder="Search..." style="margin-top: 6px;">
                                <button type="submit" class="btn btn-rose btn-round btn-just-icon"
                                    style="position: static">
                                    <i class="material-icons" style="padding-top: 0px;padding-left:0px;">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
          


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Analysis Name</th>
                                <th class="text-center">Price Analysis </th>
                                <th class="text-center">Group Name </th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($analysis)
                            @foreach($analysis as $test)
                            <tr>
                                <td class="text-center">{{$test->analysis_id}}</td>
                                <td class="text-center">{{$test->analysis_name}}</td>
                                <td class="text-center">{{$test->price}}</td>
                                <td class="text-center">{{$test->group->group_name}}</td>
                               
                                <td class="td-actions text-center">
                                    <a href="{{route('admin.showAnalysis.form',$test->analysis_id)}}">
                                        <button type="button" rel="tooltip" class="btn btn-success">
                                            view
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
                </div>

           
        </div>
    </div>
</div>



@endsection
