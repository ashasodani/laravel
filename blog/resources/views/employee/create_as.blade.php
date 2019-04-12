@extends('layout.master')
@section('header_section')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
</script>
<div class="card uper">
    <div class="card-header">
        Add Share
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
        @endif
        <form method="post" action="{{ route('employee') }}" id="myform">
            <div class="form-group">
                @csrf
                <label for="name">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" />
            </div>
            <div class="form-group">
                <label for="price">Last Name :</label>
                <input type="text" class="form-control" name="lname" id="lname"/>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Designation</label>
                <div class="col-lg-10">
                    <select class="form-control" id="designation" name="designation">


                        @foreach($designation as $key => $value)

                        <option value="{{$value->fname}}">{{$value->fname}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-primary" id="add" >Add</button>
                <button type="button" class="btn btn-primary" id="update">update</button>
                <input type="hidden" name="user_id" id="user_id" />
        </form>
    </div>
</div>
<div id="headers">
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br/>
        @endif
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>FName</td>
                    <td>LName</td>
                    <td>Designation</td>

                </tr>
            </thead>
            <tbody>
                @foreach($shares as $share)
                <tr>
                    <td class="data_id">{{$share->id}}</td>
                    <td class="data_fname">{{$share->fname}}</td>
                    <td class="data_lname">{{$share->lname}}</td>
                    <td class="data_des">{{$share->designation}}</td>
                    <td>
                        <a class="group1 btn_edit" style="cursor:pointer;color:#00BFFF" data-id="{{$share->id}}">Edit</a>
                        <a class="group1 btn_delete" style="cursor:pointer;color:#00BFFF" data-id="{{$share->id}}">Delete</a>
                    </td>    
                </tr>
                @endforeach
            </tbody>
        </table>  
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#add").click(function () {
                alert("hii");
                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var designation = $('#designation').val();
                alert(fname + lname + designation);
                alert("hello");
                $.ajax({
                    type: 'get',
                    url: APP_URL + '/abc',
                    data: {fname: fname, lname: lname, designation: designation},
                    success: function (data) {
                        $("#headers").html(data);
                    },
                });
            });

            $("#update").click(function () {

                var formdata = jQuery("#myform").serialize()
                alert(formdata);
                $.ajax({
                    type: 'post',
                    url: APP_URL + '/updatess',
                    data: formdata,
                    success: function (data) {
                        $("#headers").html(data);
                    },
                });
            });
            jQuery(".btn_edit").click(function () {
                $("#add").hide();
                var tr = jQuery(this).parents("tr");
                var id = tr.find(".data_id").text();
                var fname = tr.find(".data_fname").text();
                var lname = tr.find(".data_lname").text();
                var des = tr.find(".data_des").text();
                alert(id + fname + lname);
                jQuery("#fname").val(fname);
                jQuery("#lname").val(lname);
                jQuery("#designation").val(des);
                jQuery("#user_id").val(id);
            });

            jQuery(".btn_delete").click(function () {
                $("#add").hide();
                var tr = jQuery(this).parents("tr");
                var id = tr.find(".data_id").text();
                var fname = tr.find(".data_fname").text();
                var lname = tr.find(".data_lname").text();
                var designation = tr.find(".data_des").text();
                $.ajax({
                    type: 'get',
                    url: APP_URL + '/deletess',
                    data: {id: id, fname: fname, lname: lname, designation: designation},
                    success: function (data) {
                        alert("hello");
                    },
                });


            });

        });
    </script>
    @stop