<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\employee;
use DB;
use Response;
use \Carbon\Carbon;
class EmployeeController extends Controller {

    public function index() {
        $shares = employee::all();
        dd($shares);
        return view('employee.index', compact('shares'));
    }
    public function create(Request $request) {
        $designation = DB::Table('department')->select('fname')->get();
        $shares = employee::all();
        return view('employee.create', compact('designation', 'shares'));
    }
    public function store(Request $request) {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'designation' => 'required'
        ]);
        $share = new employee([
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'designation' => $request->get('designation')
        ]);
        $share->save();
        return redirect('/add')->with('success', ' added');
    }

    public function destroy($id) {
        $share = employee::find($id);
        $share->delete();
        return redirect('/add')->with('success', 'Stock has been deleted Successfully');
    }

    public function edit($id) {

        $share = employee::find($id);
        $designation = DB::Table('department')->select('fname')->get();

        return view('employee.edit', compact('share', 'designation'));
    }

    public function update(Request $request, $id) {


        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
        ]);


        $share = employee::find($id);
        $share->fname = $request->get('fname');
        $share->lname = $request->get('lname');
        $share->designation = $request->get('designation');
        $share->save();

        return redirect('/add')->with('success', 'Stock has been updated');
    }

    public function abc(Request $request) {

        $data = new employee([
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'designation' => $request->get('designation')
        ]);

        $data->save();
        $mdata = employee::all();
        $result = $mdata->toArray();
        $data = "";
        $data .=' <table class="table table-striped">
    <thead>
      <tr>
          <td>ID</td>
          <td>Name</td>l
          <td>lname</td>
          <td>designation</td>
          <td>Action</td>
          
      </tr>
    </thead>
    <tbody>';
        foreach ($result as $shares) {
            $data.=' <tr>
            <td>' . $shares['id'] . '</td>
            <td>' . $shares['fname'] . '</td>
            <td>' . $shares['lname'] . '</td>
            <td>' . $shares['designation'] . '</td>
           
             
          </tr>';
        }
        $data .='</tbody></table>';
        echo $data;
        die(0);
    }

    public function updatess(Request $request) {


        $id = $_POST['user_id'];
        $share = employee::find($id);
        $share->fname = $request->get('fname');
        $share->lname = $request->get('lname');
        $share->designation = $request->get('designation');
        $share->save();
        $mdata = employee::all();
        $result = $mdata->toArray();
        $data = "";
        $data .=' <table class="table table-striped">
    <thead>
      <tr>
          <td>ID</td>
          <td>Name</td>l
          <td>lname</td>
          <td>designation</td>
          <td>Action</td>
          
      </tr>
    </thead>
    <tbody>';
        foreach ($result as $shares) {
            $data.=' <tr>
            <td>' . $shares['id'] . '</td>
            <td>' . $shares['fname'] . '</td>
            <td>' . $shares['lname'] . '</td>
            <td>' . $shares['designation'] . '</td>
            
          </tr>';
        }
        $data .='</tbody></table>';
        echo $data;
        die(0);
        
    }

    public function deletess(Request $request) {

       
        $id = $_GET['id'];
        $share = employee::find($id);
        $share->delete();
        $this->getdata();
     
    }
    public function getdata()
    {
        $mdata = employee::all();
        $result = $mdata->toArray();
        $data .=' <table class="table table-striped">
    <thead>
      <tr>
          <td>ID</td>
          <td>Name</td>l
          <td>lname</td>
          <td>designation</td>
          <td>Action</td>
          
      </tr>
    </thead>
    <tbody>';
        foreach ($result as $shares) {
            $data.=' <tr>
            <td>' . $shares['id'] . '</td>
            <td>' . $shares['fname'] . '</td>
            <td>' . $shares['lname'] . '</td>
            <td>' . $shares['designation'] . '</td>

          </tr>';
        }
        echo $data .='</tbody></table>';
       
         
    }
    public function maps(Request $request) {

       
        $data = DB::Table('track_location')->get(['longitude','latitude']);
        
    }
    // public function datefilter(Request $request) {

    //    echo $fromdate=$_GET['fromdate'];
    //    echo $todate=$_GET['todate'];

    //    $selection = DB::table('track_location')->select('track_location_id','latitude','longitude')
    //                 ->whereBetween('created_at', [$fromdate,$todate])
    //                 ->get();
    //    $set=$selection->toArray();
       
    //   print_r($set);
    // }
    public function yestoday(Request $request) {
        $fromdate=$_GET['fromdate'];
        $todate=$_GET['todate'];
        $getdate=$_GET['date1'];
        $jsondata="";
      
       if($getdate!='')
       {
        $day = DB::table('track_location')->select('track_location_id','latitude','longitude')->whereDate('created_at',$getdate)->Where('latitude', '!=', null)->Where('longitude', '!=', null)->get();
        $todayss=$day->toArray();
        $jsondata=$todayss;
        }
       else
       {
        $selection = DB::table('track_location')->select('track_location_id','latitude','longitude')
        ->whereBetween('created_at', [$fromdate,$todate])->Where('latitude', '!=', null)->Where('longitude', '!=', null)
        ->get();
        $set=$selection->toArray();
        $jsondata=$set;
        }
     
        Response::json(array(
        'success' => true,
         'data'   => $jsondata
         )); 
       return response()->json($jsondata);
      
    }

    public function yestodaytest(Request $request) {
        $fromdate=$_GET['fromdate'];
        $todate=$_GET['todate'];
        $getdate=$_GET['date1'];
        $jsondata="";
      
       if($getdate!='')
       {
        $day = DB::table('track_location')->select('track_location_id','latitude','longitude')->whereDate('created_at',$getdate)->Where('latitude', '!=', null)->Where('longitude', '!=', null)->get();
        $todayss=$day->toArray();
        $jsondata=$todayss;
        }
       else
       {
        $selection = DB::table('track_location')->select('track_location_id','latitude','longitude')
        ->whereBetween('created_at', [$fromdate,$todate])->Where('latitude', '!=', null)->Where('longitude', '!=', null)
        ->get();
        $set=$selection->toArray();
        $jsondata=$set;
        }
     
        Response::json(array(
        'success' => true,
         'data'   => $jsondata
         )); 
       return response()->json($jsondata);
      
    }

}
