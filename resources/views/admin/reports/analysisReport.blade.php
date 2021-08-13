@extends('layouts.admin')
@section('title','Analysis Reports')
@section('content')
<style>
       .form-control:read-only {
    background-image: linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px), linear-gradient(to top, #d2d2d2 1px, rgb(255, 255, 255) 1px)}
    </style>

<div class="row">
    <div class="col-md-12" style="margin: auto;">
        <div class="card" >
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">description</i>
                </div>
                <h4 class="card-title">Reports of Analysis</h4>
                <br>
                @include('alert.success')
                @include('alert.errors')

                <form action="{{route('admin.report.showAnalysis')}}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                            <div class="tool">
                                <input name="from" @isset($from) value="{{$from}}"  @endisset type="date" class="form-control" data-toggle="tooltip" data-placement="top" title="From">
                                <span class="tooltiptext"> From </span>
                                @error("from")
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="tool">
                                <input name="to" @isset($to) value={{$to}} @endisset type="date" class="form-control" data-toggle="tooltip" data-placement="top" title="To">
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

                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table" style="text-align: center;">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th style="width: 30%;">Analysis Name</th>
                        <th> Count </th>
                        <th> Validate </th>

                    </tr>

                    </thead>

                    <tbody>
                    <?php $i=0 ?>
                    <?php $j=0 ?>
                    @isset($ana)

                        @foreach($ana as $a)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$a->analysis_name}}</td>
                        <td>{{$a->name_count}}</td>
                        @if($a->valid == 1)
                            <td> valid </td>
                        @else
                            <td> invalid </td>
                        @endif
                    </tr>
                        @endforeach

                    @endisset
                    @isset($not_used)
                        @foreach($not_used as $a)
                            <tr>

                                <td>{{++$i}}</td>
                                <td>{{$a->analysis_name}}</td>
                                <td> 0 </td>
                                @if($a->valid == 1)
                                <td> valid </td>
                                @else
                                    <td> invalid </td>
                                @endif

                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">

                        <label class="bmd-label-floating">Most usable Analysis</label>
                        <input type="text" @isset($analysis_name) value="{{$analysis_name}} @isset($high):{{$high}} times @endisset" @endisset name="total" readonly class="form-control" >

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Sum of all analysis</label>
                        <input  name="after_discount" @isset($sum) value="{{$sum}}" @endisset readonly type="text" class="form-control" >
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection
