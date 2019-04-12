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
          <td>Name</td>l
           <td>Name</td>l
            <td>Name</td>l
          
      </tr>
    </thead>
    <tbody>
          @foreach($data as $shares)
          <tr>
            <td>{{$shares->id}}</td>
            <td>{{$shares->fname}}</td>
           
          </tr>
        @endforeach
    </tbody>
  </table>
 