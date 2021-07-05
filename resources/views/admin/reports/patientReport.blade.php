@extends('layouts.admin')
@section('title','Patient Reports')
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
                  <h4 class="card-title">Patient Reports</h4>
                  
                  <br> 
                  
                  @include('alert.success')
                   @include('alert.errors')
                  <form action="{{route('admin.report.showPatientReport')}}" method="get">
                    @csrf
                     <div class="row">
                 
                  <div class="col-md-3">
                    <div class="form-group">
                  
                      <div class="tool">
                   <input  type="date"  @isset($dateFrom) value={{$dateFrom}} @endisset name="dateFrom" class="form-control" data-toggle="tooltip" data-placement="top" title="From">
                   <span class="tooltiptext"> From </span>
                       @error("dateFrom")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div>
                   </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="tool">
                            <input  type="date"  @isset($dateTo) value={{$dateTo}} @endisset name="dateTo" class="form-control" data-toggle="tooltip" data-placement="top" title="To">
                             <span class="tooltiptext">To </span>
                            
                        </div>
                      </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                           <button type="submit" class="btn btn-rose " style=" padding:8px">Create Report</button>
                        </div>
                     </div>
                </div>
                </div>
      </form>
               
                  
                <div class="card-body">
                <div class="table-responsive">
                  <table class="table" style="text-align: center;" >
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Patient Name</th>
                        <th class="text-center">Analysis Name</th>
                        <th class="text-center"> Doctor Name </th>
                        <th class="text-center"> Date </th>
                        <th class="text-center"> Company Name </th>
                        <th class="text-center"> Discount Type </th>
                        <th class="text-center"> Comments</th>
                        <th class="text-center">Payment With discount</th>
                        <th class="text-center"> Payment WithOut discount </th>


                      </tr>
                    </thead>
                    <tbody>
                        @isset($data1)
                        <?php $i=0 ?>
                        @foreach($data1 as $index=>$da)
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td class="text-center">{{$da[0]->patient[0]->f_name}} {{$da[0]->patient[0]->m_name}} {{$da[0]->patient[0]->l_name}}</td>
                            <td class="text-center">
                        @isset($data)
                           @foreach($data as $index1=>$analysis)
                              @foreach($analysis as $index2=>$analysis1)
                                @if($da[0]->financial_id==$index2)
                                   @foreach($analysis1 as $index3=>$analysis2)
                                     {{++$index3}}: {{$analysis2}}
                                     <br>
                                   @endforeach
                                @endif
                              @endforeach
                            @endforeach
                        @endisset
                            </td>
                             <td class="text-center">{{$da[0]->doctor[0]->f_name}} {{$da[0]->doctor[0]->m_name}} {{$da[0]->doctor[0]->l_name}}</td>
                            <td  class="text-center">{{$da[0]->created_at}}</td>
                            <td class="text-center">{{$da[0]->financial->discount[0]->company_name}}</td>
                            <td class="text-center">{{$da[0]->financial->discount[0]->discount_type}}</td>
                            <td class="text-center">{{$da[0]->financial->comments}}</td>
                            <td class="text-center">{{$da[0]->financial->payment}}</td>
                            <td class="text-center">{{$da[0]->financial->total_price}}</td>
   
                        </tr>
                             
                             @endforeach
                        @endisset
                    </tbody>
                  </table>
                </div>
                </div>
                    <br>
                    <div class="row" style="margin: 20px;">
                      <div class="col-md-3">
                          <div class="form-group">
                         
                              <label class="bmd-label-floating"> total bills before discount</label>
                              <input type="text" readonly name="total" @isset($sumtotalPrice) value={{$sumtotalPrice}} @endisset class="form-control" >
                            
                          </div>
                      </div>
                      <div class="col-md-3">
                      <div class="form-group">
                          <label class="bmd-label-floating"> total bills after discount</label>
                          <input  name="after_discount"  readonly  @isset($sumPayment) value={{$sumPayment}} @endisset  type="text" class="form-control" >
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label class="bmd-label-floating">count of finacial reports</label>
                          <input  name="comments" type="text"  readonly  @isset($countF) value={{$countF}} @endisset class="form-control" >
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label class="bmd-label-floating">count of patient</label>
                          <input  name="comments" type="text"  readonly  @isset($countP) value={{$countP}} @endisset class="form-control" >
                      </div>
                  </div>

                  </div>
               <br>
                 
                 
              </div>
            </div>
          </div>
@endsection