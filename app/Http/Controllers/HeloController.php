<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MyTable;
 
class HeloController extends Controller
{
	public function getIndex(Request $request)
	{
	    $id = $request->id;
	    if($id){
		    $data = MyTable::where('id', $id)->get();
		    return view('helo', ['message' => 'MyTable List','data' => $data]);	    	
	    }else {
		    $data = MyTable::all();
		    return view('helo', ['message' => 'MyTable List','data' => $data]);	 
	    }

	}

	public function getNew(Request $request)
	{
	    return view('new', ['message' => 'MyTable Create']);
	}
	 
	public function postNew(Request $request)
	{
	    $name = $request->input('name');
	    $mail = $request->input('mail');
	    $age = $request->input('age');
	    $data = array(
	        'name' => $name,
	        'mail' => $mail,
	        'age' => $age
	    );
	    MyTable::create($data);
	    return redirect()->action('HeloController@getIndex');
	}

	public function getUpdate(Request $request)
	{
	    $id = $request->id;
	    $data = MyTable::find($id);
	    $msg = 'MyTable Update [id = ' . $id . ']';
	    return view('update', ['message' => $msg,'data' => $data]);
	}
	 
	public function postUpdate(Request $request)
	{
	    $id = $request->input('id');
	    $data = MyTable::find($id);
	    $data->name = $request->input('name');
	    $data->mail = $request->input('mail');
	    $data->age = $request->input('age');
	    $data->save();
	    return redirect()->action('HeloController@getIndex');
	}

	public function getDelete(Request $request)
	{
	    $id = $request->id;
	    $data = MyTable::find($id);
	    $data->delete();
	    return redirect()->action('HeloController@getIndex');
	}
}