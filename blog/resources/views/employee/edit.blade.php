


<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
  </div>
  <div class="card-body">
    

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
        <form method="post" action="{{URL::to('/employee_update/'.$share->id)}}">
          <div class="form-group">
              @csrf
              <label for="name">First Name:</label>
              <input type="text" class="form-control" name="fname"  value={{ $share->fname }} />
          </div>
          <div class="form-group">
              <label for="price">Last Name :</label>
              <input type="text" class="form-control" name="lname" value={{ $share->lname }}/>
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
         
          
         
          <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>

