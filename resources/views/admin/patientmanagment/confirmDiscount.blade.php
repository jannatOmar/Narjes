@extends('layouts.admin')
@section('title','Confirm Discount')
@section('content')
<style>
       .form-control:read-only {
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgb(255, 255, 255) 1px)}
    </style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-10" style="margin: auto;">
        <div class="card" style="width: 90%;">

            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">playlist_add</i>
                </div>
                <h4 class="card-title">Confirm Discount</h4>
            </div>
            <br>


            @include('alert.success')
            @include('alert.errors')

            <form method="post" action="{{route('admin.patientManagment.confirmDiscount')}} "
                style="margin-left:15px;margin-right:15px" >
                @csrf

                @isset($id)
                    <input type="text"  hidden class="form-control" name="notify_id" value="{{$id}}">
                 @endisset
                <br>
                <div class="row" style="margin-left:10px">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Patient Name</label>
                            @isset($patient_name)
                            <input type="text"  readonly class="form-control" name="p_name" value="{{$patient_name}}">
                            @endisset
                            @error('p_name')
                            <span class="text-danger" style="    margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Doctor Name</label>
                            <input type="text"  readonly  class="form-control" name="d_name" value=" @isset($doctor_name) {{$doctor_name}} @endisset">
                            
                            @error('d_name')
                            <span class="text-danger" style="    margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center" style="width: 30%;">Analysis Name</th>
                                <th class="text-center"> Price </th>
                            </tr>

                        </thead>

                        <tbody>

                            @isset($my_analysis)
                            @foreach($my_analysis as $index=>$a)
                            @foreach($a as $var)
                            <tr class="remove">
                                <td class="text-center">{{++$index}}</td>
                                <td class="text-center">{{$var->analysis_name}}</td>
                                <td class="text-center">{{$var->price}}</td>
                           
                                <input type="text" hidden name="analysis[]" value="{{$var->analysis_name}}">
                                <input type="text" hidden name="price[]" value="{{$var->price}}">
                            </tr>
                            @endforeach
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="row" style="margin: 20px;">
                </div>
                <div class="row" style="margin: 20px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            @isset($total)
                            <label class="bmd-label-floating">The total price</label>
                            <input type="text" name="total"  readonly class="form-control" value="{{$total}}">
                            @endisset
                            @error('total')
                            <span class="text-danger" style="margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Price after discount</label>
                            <input name="after_discount" type="text" class="form-control"
                                value="{{$priceAfterDiscount}}">
                            @error('after_discount')
                            <span class="text-danger" style="margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Discount</label>
                            
                            <input name="companyName" type="text" class="form-control" value="{{$discount[0]->company_name}}-{{$discount[0]->discount_type}}:{{$discount[0]->discount_parcenteg}} %">
                            <input name="company" hidden type="text" class="form-control" value="{{$company}}">
                    
                     </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Comments</label>
                            <input name="comments" type="text" class="form-control" value="{{$comments}}">
                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-rose">Confirm Discount</button>
                        @isset($id)
                          <a href="{{route('admin.patientManagment.declineDiscount',['id'=>$id,'patient_name'=>$patient_name])}}"> 

                         <button type="button" class="btn btn-rose"> Decline </button>
                         @endisset

                        </a>
                    </div>
                </div>

                <br>
                <br>
            </form>
        </div>
    </div>
</div>




@endsection
