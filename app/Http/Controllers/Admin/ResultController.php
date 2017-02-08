<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Result;
use App\User;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResultController extends Controller
{

    public function index()
    {
        $results = Result::orderBy('updated_at','DESC')->get();

        return view('admin.results',[ 'results' => $results ]);
    }

    public function create(Request $request)
    {
        if ( !$request->input('name') || !$request->file('file') )
            return redirect(route('tasks'))->with('error', 'Задание не сохранено.');

        $task = new Result;

        $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move( storage_path().'/results/', $fileName);

        $task->name = $request->input('name');
        $task->desc = $request->input('desc');
        $task->file = $fileName;
        $task->save();

        return redirect(route('admin.results'))->with('success', 'Новый файл  успешно добавлен!');
    }

    public function update(Request $request)
    {
        $task = Result::find( $request->input('id') );

        if ( $request->input('name') ) $task->name = $request->input('name');
        if ( $request->input('desc') ) $task->desc = $request->input('desc');

        if ( $request->file('file') ) {
            $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move( storage_path().'/results/', $fileName);
            $task->file = $fileName;
        }

        $task->status = $request->input('status');

        $task->save();


        return redirect(route('admin.results'))->with('success', "Результат №{$task->id} успешно обнавлен.");
    }

    public function delete(Request $request)
    {
        $task = Result::find( $request->input('id') );

        if ( $task ) $task->delete();

        return redirect(route('admin.results'));
    }

}