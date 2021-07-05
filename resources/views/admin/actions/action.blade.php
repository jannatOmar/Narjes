@extends('layouts.admin')
@section('title','View Actions')
@section('content')
<div class="row" >
    <div class="col-md-10" style="margin: auto;">
        <div class="card" >
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">manage_accounts</i>
                </div>
                  <h4 class="card-title"> User Actions</h4>
            </div>
                <br>

                @include('alert.success')
                @include('alert.errors')

                <div class="card-body">
                <form action="{{route('admin.action.getUserActions')}}" method="get">
                    @csrf
               <div class="row">
                  <div class="col-md-3">
                        <div class="form-group">
                            <select  class="selectpicker " name="table"  data-style="select-with-transition" title="All users"  data-size="7" style="width: 200px">
                               <option value="6" @isset($table) @if($table== "6") selected @endif  @endisset>ALl Actions</option>
                               <option value="1" @isset($table) @if($table== "1") selected @endif @endisset>Analysis</option>
                               <option value="2" @isset($table) @if($table== "2") selected @endif @endisset>Contracts & Financial</option>
                               <option value="3" @isset($table) @if($table== "3") selected @endif  @endisset>Doctor</option>
                               <option value="4" @isset($table) @if($table== "4") selected @endif  @endisset>Patients</option>
                               <option value="5" @isset($table) @if($table== "5") selected @endif  @endisset>Users</option>
                            </select>
                            @error("table")
                             <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                  <div class="col-md-3">
                    <div class="form-group">
                  
                    <!-- <div class="tool"> -->
                       <input  type="date" title="From"  @isset($dateFrom) value={{$dateFrom}} @endisset name="dateFrom" class="form-control" data-toggle="tooltip" data-placement="top" title="From">
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
                            <input  type="date" title="To"  @isset($dateTo) value={{$dateTo}} @endisset name="dateTo" class="form-control" data-toggle="tooltip" data-placement="top" title="To">
                             <!-- <span class="tooltiptext">To </span> -->
                            
                        <!-- </div> -->
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
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Message</th>
                            <th class="text-center" style="width: 142px;">Time </th>
                        </tr>
                        </thead>
                        <body>
                        @isset($data)
                        @foreach($data as $index=>$da)
                        <tr>
                            <td class="text-center">{{++$index}}</td>
                            <td class="text-left">{{$da->action_name}}</td>
                            <td class="text-center" style="width: 142px;">{{$da->created_at}}</td>
                         
                         </tr>
                             @endforeach
                        @endisset
                       </body>

                    </table>


                </div>

            </div>

        </div>
    </div>
</div>

@endsection
