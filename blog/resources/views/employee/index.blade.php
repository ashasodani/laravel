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
  <table class="table table-striped">
    <thead>
      <tr>
          <td>ID</td>
          <td>Name</td>l
          <td>lname</td>
          <td>designation</td>
          <td colspan="2">Action</td>
      </tr>
    </thead>
    <tbody>
          @foreach($shares as $share)
          <tr>
            <td>{{$share->id}}</td>
            <td>{{$share->fname}}</td>
            <td>{{$share->lname}}</td>
            <td>{{$share->designation}}</td>
            <td><a href="{{URL::to('/employee_edit/'.$share->id)}}">EDIT</a>
                <a href="{{URL::to('/employee_delete/'.$share->id)}}">DELETE</a></td>
          </tr>
        @endforeach
    </tbody>
  </table>
  <div class="row">
    <a href="{{route('employee')}}">add</a>
  </div>
  
