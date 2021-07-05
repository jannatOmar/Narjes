@extends('layouts.admin')
@section('title','Create New Analysis')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Create New Form</h4>
                </div>
                <br>
                @include('alert.success')
                @include('alert.errors')
                <br>
                <div class="card-body">
                    <form method="post" action="{{route('admin.analysis.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="analysis_name" class="bmd-label-floating">Analysis Name</label>
                                    <input name='analysis_name' class="form-control" type="text"
                                        value="{{old('analysis_name')}}">
                                    @error("analysis_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <select name="group" class="selectpicker" name="group" group-title="Group Name"
                                        data-style="select-with-transition" title="Group Name" data-size="7">
                                        <option disabled>Group Analysis</option>
                                        @if (old('group') == '1')
                                        <option value="1" selected>BIOCHEMISTRY</option>
                                        @else
                                        <option value="1">BIOCHEMISTRY</option>
                                        @endif
                                        @if (old('group') == '2')
                                        <option value="2" selected>SEROLOGY</option>
                                        @else
                                        <option value="2">SEROLOGY</option>
                                        @endif
                                        @if (old('group') == '3')
                                        <option value="3" selected>HEAMTOLOGY</option>
                                        @else
                                        <option value="3">HEAMTOLOGY</option>
                                        @endif
                                        @if (old('group') == '4')
                                        <option value="4" selected>URINE ANALYSIS</option>
                                        @else
                                        <option value="4">URINE ANALYSIS</option>
                                        @endif
                                        @if (old('group') == '5')
                                        <option value="5" selected>DIFFERENTIAL</option>
                                        @else
                                        <option value="5">DIFFERENTIAL</option>
                                        @endif

                                        @if (old('group') == ' 6')
                                        <option value="6" selected> STOOLANALYSIS</option>
                                        @else
                                        <option value="6"> STOOLANALYSIS </option>
                                        @endif
                                        @if (old('group') == '7')
                                        <option value="7" selected>CULTURE </option>
                                        @else
                                        <option value="7">CULTURE </option>
                                        @endif
                                        @if (old('group') == '8')
                                        <option value="8" selected>OTHERS</option>
                                        @else
                                        <option value="8">OTHERS</option>
                                        @endif

                                    </select>
                                    <br>
                                    @error("group")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price" class="bmd-label-floating">Analysis Price</label>
                                    <input name='price' class="form-control" type="text" value="{{old('price')}}">
                                    @error("price")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
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
                            <div class="input2"></div>
                        </div>
                        <button type="submit" class="btn btn-rose">save</button>
                        <br>
                        <br>

                    </form>


                </div>

           
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
// This is the class for adding a new option
function addOption(clickID) {

            row1=  "<div class='removeOption'>"+
                         "<div class='row'>"+
                          "<div class='col-md-4'>"+
                            "<div class='form-group'>"+
                            "<label class='bmd-label-floating'>option</label> "+
                              "<input type='text' class='form-control' name='option"+clickID+"[]' value=''>"+
                            //   " @error('option"+clickID+"."+clickID"')"+
                            //    " <span class='text-danger'>{{$message}}</span>"+
                            //  " @enderror"+
                             "</div>"+"</div>"+

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
                
                "</div>" + "</div>" +
                
                "<div class='col-md-1'>" +
                "<div class='form-group'>" +
                "<button type='button' class='btn btn-danger' id='remove'>-</button>" +
                "</div>" +
                "</div>"+
                "</div>" +
                "</div>";
        } else if (selectedType == "drop down") {
            increaseID++;
            $('.input2').html("");
            row="<div class='remove'>"+
                 "<div class='row'>"+
                        "<div class='col-md-3'>"+
                            "<div class='form-group'>"+
                             "<label class='bmd-label-floating'>Input Name </label>"+
                             "<input name='optioInput[]'class='form-control' value=''>"+

                             "</div>"+"</div>"+

                   "<div class='col-md-9'>"+
                     "<div class='option"+increaseID+"'>"+
                             "<button type='button'  onclick='addOption(this.id)' id='option"+increaseID+"'    class='btn btn-danger' >+</button>"+
                            "<button type='button' class='btn btn-rose' id='remove'>-</button>" +
                      "</div>"+
                  "</div>"+
                "</div>"+
              "</div>";

          }else{
           $('.input2').html("<span class='text-danger'>هذا الحقل مطلوب</span>");
          }
            $('.input').append(row);


        });


        $(document).on('click','#remove',function(){
          $(this).closest('.remove').remove();
        });
        $(document).on('click','#removeOption',function(){
          $(this).closest('.removeOption').remove();
        });
      });

        </script>

@endsection
