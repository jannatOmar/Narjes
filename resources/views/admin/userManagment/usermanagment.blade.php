@extends('layouts.admin')
@section('title','User Managment')
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
                <h4 class="card-title">Users Management</h4>
                <br>


                @include('alert.success')
                @include('alert.errors')

                <div class="row">
                    <div class="col-12 col-sm-6">
                        <form  method="get" action="{{route('admin.user.filter')}}">
                            @csrf
                            <div class="row">
                                <div class="col-6" style="max-width:200px" data-toggle="tooltip" data-placement="top" title="Filter By Role">
                                    <select class="selectpicker" name="role" data-style="select-with-transition"
                                        data-size="7">
                                        <option disabled>Roles</option>
                                        @if(isset($role))
                                        <option  value="0" @if($role==0) selected @endif>ALL ROLES </option>
                                        <option value="1" @if($role==1) selected @endif >ADMIN </option>
                                        <option value="2" @if($role==2) selected @endif>MANAGER</option>
                                        <option value="3" @if($role==3) selected @endif>EMPLOYEE</option>
                                        <option value="4" @if($role==4) selected @endif>ACOUNTANT</option>
                                       @else
                                        <option  value="0"  selected>ALL ROLES </option>
                                        <option value="1" >ADMIN </option>
                                        <option value="2" >MANAGER</option>
                                        <option value="3"> EMPLOYEE</option>
                                        <option value="4" >ACOUNTANT</option>
                                       @endif
                                    </select>


                                </div>

                                <div class=" col-2">
                                    <button type="submit" class="btn btn-rose" style="padding:10px; position: static">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="offset-sm-2"></div>

                    <div class="col-12 col-sm-4">
                        <form class="navbar-form " method="get" action="{{route('admin.user.search')}}">
                            @csrf
                            <div class="input-group no-border">
                                <input type="text" name="name" value="@isset($q) {{$q}}@endisset" class="form-control tool"
                                    data-toggle="tooltip" data-placement="top" title="Search By Name or UserName Or Address Or Phone"
                                    placeholder="Search..." style="margin-top: 6px; ">
                                <button type="submit" class="btn btn-rose btn-round btn-just-icon"
                                    style="position: static">
                                    <i class="material-icons" style="padding-top: 4px;padding-left: 8px;">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">User Name</th>
                                <th class="text-center">role_name</th>
                                <th class="text-center">Age</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">username</th>
                                <th class="text-center">status</th>
                                <th class="text-center">start_date</th>
                                <th class="text-center">end_date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($user)
                            @foreach($user as $index)
                            <tr>
                                <td class="text-center">{{$index->id}}</td>
                                <td class="text-center">{{$index->f_name}} {{$index->m_name}} {{$index->l_name}}</td>

                                @if($index->role_id==1)
                                <td class="text-center">admin</td>
                                @elseif($index->role_id==2)
                                <td class="text-center">manager</td>
                                @elseif($index->role_id==3)
                                <td class="text-center">employee</td>
                                @elseif($index->role_id==4)
                                <td class="text-center">accountant</td>
                                @endif
                                <td class="text-center">{{$index->age}}</td>
                                <td class="text-center">{{$index->address}}</td>
                                <td class="text-center">{{$index->email}}</td>
                                <td class="text-center">{{$index->phone}}</td>
                                <td class="text-center">{{$index->username}}</td>
                                <td class="text-center">{{$index->getActive()}}</td>

                                <td class="text-center">{{$index->start_date}}</td>
                                <td class="text-center">{{$index->end_date}}</td>
                                <td class="td-actions text-center">
                                    <a href="{{route('admin.userManagment.edit',$index->id)}}">
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
                    <div class="d-flex justify-content-center"> {!! $user->links() !!} </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection