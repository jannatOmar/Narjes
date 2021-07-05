@extends('layouts.admin')
@section('title','Logging Actions')
@section('content')
<style>
       .form-control:read-only {
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgb(255, 255, 255) 1px)}
    </style>
<div class="row" >
            <div class="col-md-12" style="margin: auto;">
              <div class="card"  >
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">description</i>
                  </div>
                   <h4 class="card-title">Logging</h4>
                </div>
                  <br> 
                  
                  @include('alert.success')
                   @include('alert.errors')
                <div class="card-body">

            <form action="{{route('admin.action.showDetialsLogging')}}" method="get">
                    @csrf
                <div class="row">
                 
                  <div class="col-md-3">
                    <div class="form-group">
                  
                    <!-- <div class="tool"> -->
                       <input  type="date"  title="From" @isset($dateFrom) value={{$dateFrom}} @endisset name="dateFrom" class="form-control" data-toggle="tooltip" data-placement="top" title="From">
                        <!-- <span class="tooltiptext"> From </span> -->
                       @error("dateFrom")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    <!-- </div> -->
                    </div>
                   </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <!-- <div class="tool"> -->
                            <input  type="date" title="To" @isset($dateTo) value={{$dateTo}} @endisset name="dateTo" class="form-control" data-toggle="tooltip" data-placement="top" title="To">
                             <!-- <span class="tooltiptext">To </span> -->
<!--                             
                        </div> -->
                      </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form-group">
                           <button type="submit" class="btn btn-rose " style=" padding:8px">Show Details</button>
                        </div>
                     </div>
                </div>
               
        </form>
                <br>
                    
                  
                <div class="table-responsive">
                  <table class="table" style="text-align: center;" >
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">User-Name</th>
                        <th class="text-center">User Role</th>
                        <th class="text-center">Log-In Time</th>
                        <th class="text-center"> Log-Out Time </th>


                      </tr>
                    </thead>
                    <tbody>
                        @isset($data)
                        @foreach($data as $index=>$da)
                        <tr>
                            <td class="text-center">{{++$index}}</td>
                            <td class="text-center">{{$da->user->f_name}} {{$da->user->m_name}} {{$da->user->l_name}}</td>
                            <td class="text-center">{{$da->user->username}}</td>
                            <td class="text-center">{{$da->user->role->role_name}}</td>
                            <td class="text-center">{{$da->created_at}}</td>
                            <td class="text-center">{{$da->updated_at}}</td>
                          </tr>
                             
                             @endforeach
                        @endisset
                    </tbody>
                  </table>
                </div>
                </div>
              
                 
              </div>
            </div>
          </div>
@endsection