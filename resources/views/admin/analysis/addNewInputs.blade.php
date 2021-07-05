@extends('layouts.admin')
@section('title','Add Inputs')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Add Inputs For Analysis</h4>
                </div>
                <br>

                @include('alert.success')
                @include('alert.errors')
                <br>
                <div class="card-body">

                    @isset($analysis)
                    @foreach($analysis as $analysis)
                    <form class="navbar-form col-lg-12 form" method="post"
                        action="{{route('admin.analysis.storeInputs',$analysis->analysis_id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='{{$analysis->analysis_name}}' class="bmd-label-floating">Analysis
                                        Name</label>
                                    <input type='text' name='name' disabled class="form-control"
                                        value="{{$analysis->analysis_name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='{{$analysis->group->group_name}}' class="bmd-label-floating">Analysis
                                        Group</label>
                                    <input type='text' name='group_name' disabled class="form-control"
                                        value="{{$analysis->group->group_name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='{{$analysis->price}}' class="bmd-label-floating">Analysis Price</label>
                                    <input type='text' name='price' disabled class="form-control"
                                        value="{{$analysis->price}}">
                                </div>
                            </div>

                        </div>
                        <div class="input">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="addtype" id="Type" title="Type" class="selectpicker"
                                            data-background-color="rose" data-style="select-with-transition"
                                            data-size="7">
                                            @if (old('type') == 'text')
                                            <option value="text" selected>Text</option>
                                            @else
                                            <option value="text">Text</option>
                                            @endif
                                            @if (old('type') == 'drop down')
                                            <option value="drop down" selected>Drop down</option>
                                            @else
                                            <option value="drop down">Drop down</option>
                                            @endif

                                        </select>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-rose" id="add">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input2"></div>
                        <div>
                            <button type="submit" class="btn btn-rose">save</button>
                        </div>
                        <br>
                        <br>

                    </form>

                    @endforeach

                    @endisset

                </div>

            
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
// This is the class for adding a new option
function addOption(clickID) {

    row1 = "<div class='removeOption'>" +
        "<div class='row'>" +
        "<div class='col-md-4'>" +
        "<div class='form-group'>" +
        "<label class='bmd-label-floating'>option</label> " +
        "<input type='text' class='form-control' name='option" + clickID + "[]' value=''>" +
        " @error('option" + clickID + "[]')" +
        " <span class='text-danger'>{{$message}}</span>" +
        " @enderror" +
        "</div>" + "</div>" +

        "<button type='button' class='btn btn-danger' id='removeOption'>-</button>" +
        "</div>" +
        "</div>";

    $('.' + clickID).append(row1);


}

$(document).ready(function() {
    var increaseID = 0; // this is the variable that will increase with input

    $(document).on('click', '#add', function() {
        $('.input2').html("");
        var selectedType = $("#Type").children("option:selected").val();
        var row = "";
        if (selectedType == "text") {
            row = " <div class='remove'>" +
                "<div class='row'>" +
                "<div class='col-md-3'>" +
                "<div class='form-group'>" +
                "<label class='bmd-label-floating'>Input Name </label>" +
                "<input name='input[]'class='form-control' value=''>" +
                // " @error('input.*')" +
                // " <span class='text-danger'>{{$message}}</span>" +
                // " @enderror" +
                "</div>" + "</div>" +

                "<div class='col-md-3'>" +
                "<div class='form-group'>" +
                "<label class='bmd-label-floating'>Male-Range</label> " +
                "<input type='text' class='form-control' name='max_normal[]' value=''>" +
                // " @error('max_normal.*')" +
                // " <span class='text-danger'>{{$message}}</span>" +
                // " @enderror" +
                "</div>" + "</div>" +
                "<div class='col-md-3'>" +
                "<div class='form-group'>" +
                "<label class='bmd-label-floating'>Female-Range</label> " +
                "<input type='text' class='form-control' name='min_normal[]' value=''>" +
                // " @error('min_normal.*')" +
                // " <span class='text-danger'>{{$message}}</span>" +
                // " @enderror" +
                "</div>" + "</div>" +
                "<div class='col-md-2'>" +
                "<div class='form-group'>" +
                "<label class='bmd-label-floating'>Unit</label> " +
                "<input type='text' class='form-control' name='unit[]' value=''>" +
                // " @error('unit.*')" +
                // " <span class='text-danger'>{{$message}}</span>" +
                // " @enderror" +
                "</div>" + "</div>" +

                "<div class='col-md-1'>" +
                "<div class='form-group'>" +
                "<button type='button' class='btn btn-danger' id='remove'>-</button>" +
                "</div>" + "</div>" +

                "</div>" +
                "</div>";
        } else if (selectedType == "drop down") {
            increaseID++;
            $('.input2').html("");
            row = "<div class='remove'>" +
                "<div class='row'>" +
                "<div class='col-md-3'>" +
                "<div class='form-group'>" +
                "<label class='bmd-label-floating'>Input Name </label>" +
                "<input name='optioInput[]'class='form-control' value=''>" +

                "</div>" + "</div>" +

                "<div class='col-md-9'>" +
                "<div class='option" + increaseID + "'>" +
                
                "<button type='button'  onclick='addOption(this.id)' id='option" + increaseID +
                "'    class='btn btn-danger' >+</button>" +
                "<button type='button' class='btn btn-rose' id='remove'>-</button>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>";

        } else {
            $('.input2').html("<span class='text-danger'>هذا الحقل مطلوب</span>");
        }
        $('.input').append(row);


    });


    $(document).on('click', '#remove', function() {
        $(this).closest('.remove').remove();
    });
    $(document).on('click', '#removeOption', function() {
        $(this).closest('.removeOption').remove();
    });
});
</script>

@endsection
