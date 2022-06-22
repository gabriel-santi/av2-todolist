<?php

namespace App\Http\Controllers;

use App\Models\todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $tasks = Todolist::all();
            return response()->json($tasks, 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()],
             500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($id)
    {
        try{
            $task = Todolist::findOrFail($id);
            return response()->json($task, 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()],
             500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try{
            
            $todolist = new Todolist();
            $todolist->title = $request->title;
            $todolist->description = $request->description;
            $todolist->deadline = $request->deadline;
            $todolist->save();
            
            //todolist::create($request->all());
            return response()->json(['message' => 'Salvando os dados!'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $todolist = Todolist::findOrFail($id);
            $todolist->title = $request->title;
            $todolist->description = $request->description;
            $todolist->deadline = $request->deadline;
            $todolist->save();

            return response()->json(['message'=>'Tarefa editada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message'=>'Erro ao editar tarefa: '.$e.getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $todolist = Todolist::findOrFail($id);
            $todolist->delete();
            return response()->json(['message'=>'Tarefa excluída com sucesso'], 200);
        }catch(\Exception $e){
            return response()->json(['message'=>'Erro ao excluir tarefa: '.$e.getMessage()], 500);
        } 
    }
}
