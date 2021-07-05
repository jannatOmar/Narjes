@extends('layouts.admin')
@section('title','Discount Reports')
@section('content')
<style>
       .form-control:read-only {
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgb(255, 255, 255) 1px)}
    </style>
<div class="row" >
            <div class="col-md-12" style="margin: auto;">
              <div class="card" >
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">description</i>
                  </div>
                  <h4 class="card-title">Discount Reports</h4>

                  <br> 

                  @include('alert.success')
                    @include('alert.errors')

                  <form action="{{route('admin.report.ShowDiscount')}}" method="get">
                    @csrf
                     <div class="row">
                 
                  <div class="col-md-3">
                    <div class="form-group">

                      <div class="tool">
                   <input  type="date" @isset($dateFrom) value={{$dateFrom}} @endisset name="dateFrom" class="form-control" data-toggle="tooltip" data-placement="top" title="From">

                   <span class="tooltiptext" > From </span>
                      @error("dateFrom")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div>
                   </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="tool">
                     <input  type="date" name="dateTo" @isset($dateTo) value={{$dateTo}} @endisset class="form-control" data-toggle="tooltip" data-placement="top" title="To">
                     <span class="tooltiptext" >To </span>
                      </div>
                      </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                      <button type="submit" class="btn btn-rose " style=" padding:8px">Create Report</button>

                    </div>
                      </div>






                     </div>
                      </form>
                 </div>

                <div class="card-body">
                <div class="table-responsive">
                  <table class="table" style="text-align: center;" >
                    <thead>
                      <tr>
                        <th class="text-center">#</th>

                        <th class="text-center"> Company Name</th>
                        <th class="text-center"> Discount Type</th>
                        <th class="text-center"> Discount Percentage</th>
                        <th class="text-center">Company Finantial Recivable</th>
                        <th class="text-center">Laboratory Finantial Recivable</th>
                        <th class="text-center">Count Of Patient</th>
                      </tr>

                    </thead>
                    <tbody>
                    @isset($discounts)
                      @foreach($discounts as $index=>$discount)
                         <tr>
                         <td class="text-center">{{++$index}}</td>
                         <td class="text-center">{{$discount->company_name}}</td>
                         <td class="text-center">{{$discount->discount_type}}</td>
                         <td class="text-center">{{$discount->discount_parcenteg}}</td>
                         <td class="text-center">{{$discount->company_finantial_recivable}}</td>
                         <td class="text-center">{{$discount->laboratory_finantial_recivable}}</td>
                         <td class="text-center">
                         @isset($countPatient)
                         @foreach($countPatient as $dis)
                           @if($discount->discount_id==$dis->discount_id)
                            {{$dis->countPatient}}
                           @endif
                          @endforeach
                          @endisset

                         </td>

                         </tr>
                      @endforeach
                    @endisset


                    </tbody>
                  </table>


                </div>
                </div>
                    <br>




               <br>







              </div>
            </div>
          </div>
          @endsection
