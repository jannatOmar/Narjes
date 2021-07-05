@extends('layouts.admin')
@section('title','Update Discount')
@section('content')
<div class="row">
    <div class="col-md-8" style="margin: auto;">
        <div class="card" style="width:120%; margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">add_box
                    </i>
                </div>
                <h4 class="card-title">Update Discount
                </h4>
            </div>
            
            @include('alert.success')
                @include('alert.errors')

            <div class="card-body">
                @isset($discount)

                <form class="navbar-form col-lg-12 form" method="post"
                    action="{{route('admin.discount.update', $discount->discount_id)}}">

                    @csrf

                    <br>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Company Name</label>
                                <input type="text" class="form-control" name="company_name"
                                    value="{{$discount->company_name}}">
                                @error('company_name')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Discount Percentage</label>
                                <input type="text" class="form-control" name="discount_percentage"
                                    value="{{$discount->discount_parcenteg}}">
                                @error('discount_percentage')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Discount Type</label>
                                <input type="text" class="form-control" name="discount_type"
                                    value="{{$discount->discount_type}}">
                                @error('discount_type')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Company Finantial Recivable</label>
                                <input type="text" class="form-control" name="company_finantial_recivable"
                                    value="{{$discount->company_finantial_recivable}}">
                                @error('company_finantial_recivable')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Laboratory Finantial Recivable</label>
                                <input type="text" class="form-control" name="laboratory_finatial_recivable"
                                    value="{{$discount->laboratory_finantial_recivable}}">
                                @error('laboratory_finatial_recivable')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <br>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-rose" style="margin-left: 250px; width: 30%; ">Update
                        Discount</button>
                    <div class="clearfix"></div>
                    <br>
                    <br>

                </form>
                @endisset
            </div>
        </div>
    </div>

</div>

@endsection