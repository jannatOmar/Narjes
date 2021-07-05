@extends('layouts.admin')
@section('title','Discount Managment')
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
                    <i class="material-icons">money_off</i>
                </div>
                <h4 class="card-title">Discounts</h4>
            </div>
            <br>
            @include('alert.success')
                @include('alert.errors')
            <div class="col-md-12" style="width:250px;">
                <form class="navbar-form" method="get" action="{{route('admin.discount.search')}}">
                    <div class="input-group no-border">
                        <input type="text" name="name" value="@isset($q) {{$q}} @endisset" class="form-control" data-toggle="tooltip"
                            data-placement="top" title="Search By Company Name" placeholder="Search..."
                            style="margin-top: 6px;">
                        <button type="submit" class="btn btn-rose btn-round btn-just-icon" style="position: static">
                            <div style="position:static; top:0px;right:0px;">
                                <i class="material-icons" style="padding-top: 1px;padding-left: 2px;">search</i>
                            </div>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
            </div>


           
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Company Name</th>
                                <th style="width: 30%;" class="text-center">Discount Type</th>
                                <th class="text-center">Discount Percentage </th>
                                <th class="text-center">Company Finantial Recivable</th>
                                <th class="text-center">Laboratory Finantial Recivable</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Actions</th>
                            </tr>

                        </thead>
                        <tbody>
                            @isset($discount)
                            @foreach($discount as $dis)
                            <tr>
                                <td class="text-center">{{$dis->discount_id}}</td>
                                <td class="text-center">{{$dis->company_name}}</td>
                                <td class="text-center">{{$dis->discount_type}}</td>
                                <td class="text-center">{{$dis->discount_parcenteg}} %</td>
                                <td class="text-center">{{$dis->company_finantial_recivable}}</td>
                                <td class="text-center">{{$dis->laboratory_finantial_recivable}}</td>
                                <td class="text-center">{{$dis->created_at}}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.discount.edit',$dis->discount_id)}}">
                                        <button type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endisset

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center"> {!! $discount->links() !!} </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection