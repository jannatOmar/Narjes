@extends('layouts.manager')
@section('title','Confirm Patient Analysis')
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
                <h4 class="card-title">Confirm Patient's Analysis</h4>
            </div>
            <br>


            @include('alert.success')
            @include('alert.errors')
            <form method="get" action="{{route('manager.patientManagment.addAnalysis')}}"
                style="margin-left:15px;margin-right:15px">
                @isset($analysis)
                @foreach($analysis as $index=>$a)
                @foreach($a as $var)
                <input type="text" hidden name="analysis[]" value="{{$var->analysis_name}}">
                @endforeach
                @endforeach
                @endisset
                @isset($patient_name)
                <input type="text" hidden class="form-control" name="p_name" value="{{$patient_name}}">
                @endisset
                @isset($doctor_name)
                <input type="text" hidden class="form-control" name="d_name" value="{{$doctor_name}}">
                @endisset
                <button class="btn btn-rose">Update Analysis</button>

            </form>

            <form method="post" action="{{route('manager.patientManagment.confirmPayment')}}"
                style="margin-left:15px;margin-right:15px">
                @csrf


                <br>
                <div class="row" style="margin-left:10px">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Patient Name</label>
                            @isset($patient_name)
                            <input type="text" readonly class="form-control" name="p_name" value="{{$patient_name}}">
                            @endisset
                            @error('p_name')
                            <span class="text-danger" style="    margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Doctor Name</label>
                            
                            <input type="text" readonly class="form-control" name="d_name" value="@isset($doctor_name) {{$doctor_name}}    @endisset">
                         
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

                            @isset($analysis)
                            @foreach($analysis as $index=>$a)
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
                    <div class="col-md-4">
                        <div class="form-group">
                            @isset($discount)
                            <select id="company" class="selectpicker " name="company"
                                data-style="select-with-transition" title="Discout" data-size="7" style="width: 200px">
                                @foreach($discount as $d)
                                @if(old('company')== $d->discount_id)
                                   <option value="{{$d->discount_id}}" selected>{{$d->company_name}} - {{$d->discount_type}} :
                                    {{$d->discount_parcenteg}}%</option>
                                @else
                                <option value="{{$d->discount_id}}">{{$d->company_name}} - {{$d->discount_type}} :
                                    {{$d->discount_parcenteg}}%</option>
                                    @endif
                                @endforeach
                            </select>
                            @endisset
                            @error('company')
                            <span class="text-danger" style="margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 20px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            @isset($total)
                            <label class="bmd-label-floating">The total price</label>
                            <input type="text" name="total" readonly  class="form-control" value="{{$total}}">
                            @endisset
                            @error('total')
                            <span class="text-danger" style="margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Price after discount</label>
                            <input name="after_discount" value="{{old('after_discount')}}"type="text" class="form-control">
                            @error('after_discount')
                            <span class="text-danger" style="margin: 34px;">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Comments</label>
                            <input name="comments" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-rose">Confirm Payment</button>
                    </div>
                </div>

                <br>
                <br>
            </form>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '#remove', function() {
        $(this).closest('.remove').remove();
    });

});
$("#company").select2({
    placeholder: "Select Discount",
    allowClear: true
});
</script>


@endsection
