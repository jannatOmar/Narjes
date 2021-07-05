@extends('layouts.manager')
@section('title','Show Form')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Show Form</h4>
                <br>
                @include('alert.success')
                @include('alert.errors')
                <br>
                <div class="card-body">
                    @isset($analysis)
                    <form method="post" action="{{route('manager.showAnalysis.updateForm',$analysis->analysis_id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='{{$analysis->analysis_name}}' class="bmd-label-floating">Analysis
                                        Name</label>
                                    <input type='text' class="form-control" disabled name='analysis_name'
                                        value="{{$analysis->analysis_name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker" name="group" data-style="select-with-transition"
                                        title="Group Name" data-size="7">
                                        <option disabled>Group Analysis</option>
                                        <option value="1" @if($analysis->group_id==1)selected @endif>BIOCHEMISTRY
                                        </option>
                                        <option value="2" @if($analysis->group_id==2)selected @endif>SEROLOGY</option>
                                        <option value="3" @if($analysis->group_id==3)selected @endif>HEAMTOLOGY</option>
                                        <option value="4" @if($analysis->group_id==4)selected @endif>URINE ANALYSIS
                                        </option>
                                        <option value="5" @if($analysis->group_id==5)selected @endif>DIFFERENTIAL
                                        </option>
                                        <option value="6" @if($analysis->group_id==6)selected @endif>STOOLANALYSIS
                                        </option>
                                        <option value="7" @if($analysis->group_id==7)selected @endif>CULTURE </option>
                                        <option value="8" @if($analysis->group_id==8)selected @endif>OTHERS</option>
                                    </select>

                                    @error("group")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price" class="bmd-label-floating">Aanlysis Price</label>
                                    <input name='price' class="form-control" type="text" value="{{$analysis->price}}">
                                    @error("price")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @isset($normal_range)
                        @foreach($normal_range as $key => $tests)
                        <div class="input">
                            <div class="remove">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='{{$tests->input->input_name}}' class="bmd-label-floating">Input
                                                Name</label>
                                            <input type='text' class="form-control" name='input_name[]'
                                                value="{{$tests->input->input_name}}">
                                            @error("input_name.$key")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='' class="bmd-label-floating">Male-Range</label>
                                            <input type='text' class="form-control" name='max_normal[]'
                                                value='{{$tests->high_range}}'>
                                            @error("max_normal.$key")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='' class="bmd-label-floating">Female-Range</label>
                                            <input type='text' class="form-control" name='min_normal[]'
                                                value='{{$tests->low_range}}'>
                                            @error("min_normal.$key")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for='' class="bmd-label-floating">Unit</label>
                                            <input type='text' class="form-control" name='unit[]'
                                                value='{{$tests->unit}}'>
                                            @error("unit.$key")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">

                                            @isset($count_chick)
                                            @if($count_chick<=0) 
                                            <a
                                                href="{{route('manager.showAnalysis.deleteInput',['analysis_id'=>$tests->analysis_id,'input_id'=>$tests->input_id])}}">
                                                <button type='button' class='btn btn-danger' id="remove">-</button>
                                                </a>
                                                @endif
                                                @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                        @isset($data)
                        <?php $increaseID = 0;?>
                        @foreach($data as $key => $op)
                        @foreach($op as $key1 => $op1)
                        <?php $increaseID++;?>
                        <div class="input">
                            <div class="remove">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for='{{$key1}}' class="bmd-label-floating">Input Name</label>
                                            <input type='text' class="form-control" name='optioInput[]'
                                                value="{{$key1}}">
                                                @error("optioInput.$key")
                                                   <span class="text-danger">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="option{{$increaseID}}">
                                            @isset($count_chick)
                                            @if($count_chick == 0)
                                          

                                            <a href="{{route('manager.showAnalysis.deleteInputName',['analysis_id'=>$analysis->analysis_id,'input_id'=>$input[$i++]->input_id])}}">
                                                <button type='button' class='btn btn-danger' id='remove'>-</button>
                                            </a>
                                           
                                            @endif
                                            @endisset
                                            @foreach($op1 as $key2 => $op3)
                                            <div class='removeOption'>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for='{{$op3}}'
                                                                class="bmd-label-floating">option</label>
                                                            <input type='text' class="form-control"
                                                                name='optionoption{{$increaseID}}[]' value='{{$op3}}'>
                                                            @error("optionoption{{$increaseID}}.$key2")
                                                            <span class='text-danger'>{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @isset($count_chick)
                                                    @if($count_chick<=0)
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                    <a href="{{route('manager.showAnalysis.deleteOption',['analysis_id'=>$analysis->analysis_id,'input_id'=>$input[$l]->input_id,'option_id'=>$data_option[$l][$key2]])}}">
                                                        <button type='button' class='btn btn-danger'
                                                            id='removeOption'>-</button>
                                                    </a>
                                                    </div>
                                                    </div>
                                                        @endif
                                                        @endisset
                                                </div>

                                            </div>
                                            @endforeach
                                            <?php $l++;?>
                                            @isset($count_chick)
                                                    @if($count_chick<=0)
                                            <div class="col-md-9">
                                                <div class="option">
                                                    <button  type='button'style="margin-left: -11px;" class='btn btn-rose'
                                                        onclick='addOption(this.id)'
                                                        id='option{{$increaseID}}'>+
                                                    </button>
                                                </div>
                                            </div>
                                            @endif
                                          @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        @endisset
                        <button type="submit" class="btn btn-rose" data-toggle="tooltip" data-placement="top"
                            title="update this form">Update</button>
                    </form>
                    <form method="get" action="{{route('manager.analysis.addInputs',$analysis->analysis_id)}}">
                        @csrf
                        <button type="submit" class="btn btn-rose" data-toggle="tooltip" data-placement="top"
                            title="add new inputs for this form">Add</button>
                    </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
function addOption(clickID) {
    row1 = "<div class='removeOption'>" +
        "<div class='row'>" +
        "<div class='col-md-4'>" +
        "<div class='form-group'>" +
        "<label class='bmd-label-floating'>option</label> " +
        "<input type='text' class='form-control' name='option" + clickID + "[]' value=''>" +
        " @error('option" + clickID + "')" +
        " <span class='text-danger'>{{$message}}</span>" +
        " @enderror" +
        "</div>" + "</div>" +
        "<button type='button' class='btn btn-danger' id='removeOption'>-</button>" +
        "</div>" +
        "</div>";
    $('.' + clickID).append(row1);
}
$(document).ready(function() {
    $(document).on('click', '#remove', function() {
        $(this).closest('.remove').remove();
    });
    $(document).on('click', '#removeOption', function() {
        $(this).closest('.removeOption').remove();
    });

});
</script>
@endsection
