<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ClassController extends Controller
{
    //
    public function index(){

        $class=DB::table('classes')->get();
        return view('admin.class.classes',compact('class'));

    }

    public function create(){
        return view('admin.class.createClass');
    }

    //store class
    public function store(Request $request){
        $request->validate([
            'class_name'=> 'required|unique:classes',
        ]);
        $data=array(
            'class_name' => $request->class_name,
        );
        DB::table('classes')->insert($data);
        return redirect()->back()->with('success','successfully inserted');

    }
    public function delete($id){
        DB::table('classes')->where('id',$id)->delete();
        return redirect()->back()->with('success','successfully Deleted');

    }
    public function edit($id){
        $data = DB::table('classes')->where('id', $id)->first();
        return view('admin.class.edit', compact('data'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'class_name'=> 'required|unique:classes',
        ]);
        $data=array(
            'class_name' => $request->class_name,
        );
        DB::table('classes')->where('id', $id)->update($data);
        return redirect()->back()->with('success','successfully Updated');
    }
    


}
