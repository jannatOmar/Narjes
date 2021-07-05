@extends('layouts.manager')
@section('title','Edit Price')
@section('content')

<div class="row">
    <div class="col-md-8" style="margin: auto;">
        <div class="card" style="width:120%; margin-left: -40px;">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">edit
                    </i>
                </div>
                <h4 class="card-title">Edit Price
                </h4>
            </div>
            <div class="card-body">

                <form action="{{route('manager.laboratoryDetails.update', $analysis->analysis_id)}}" method="post">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Analysis name</label>
                                <input name="analysis" type="text" class="form-control"
                                    value="{{$analysis->analysis_name}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Analysis price</label>
                                <input name="price" type="text" class="form-control" value="{{$analysis->price}}">
                                @error('price')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>


                    <br>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-rose" data-toggle="modal" data-target="#exampleModalCenter">
                        Edit Price
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">تأكيد التعديل </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-right">
                                    هل أنت متأكد ؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-rose">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <br>
                </form>

            </div>
        </div>
    </div>

</div>

@endsection