@extends('layout.a_ashh')
@section('pagecontent')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
</script>

    <section class="content-header">
      <h1>
        Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Elements</li>
      </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                 <div class="box-header with-border">
                        <h3 class="box-title">Forms</h3>
                </div>
                <form method="post" action="{{ route('employee') }}" id="myform" role="form">
                    <div class="box-body">
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
                            <select class="form-control" id="designation" name="designation">
                                 @foreach($designation as $key => $value)
                                     <option value="{{$value->fname}}">{{$value->fname}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" id="add" >Add</button>
                            <button type="button" class="btn btn-primary" id="update">update</button>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" />
                    </div>
                </form>
            </div>
        </div>
    </div>
   

   
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                 <div class="box-header">
                    <h3 class="box-title">Table Data</h3>
                </div>
            <!-- /.box-header -->
                <div class="box-body">
                <div id="headers">
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
                
                </div>
            </div>
        </div>
    </div>
        
   </section>


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

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
    @stop
    