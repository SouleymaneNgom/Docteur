<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class TopicController extends Controller
{



    public function __construct(){

        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics=Topic::latest()->paginate();
        return view('topics.topic', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
       //return redirect('topics');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=>'required|min:5',
            'content'=>'required|min:10'
        ]);

        $topic=auth()->user()->topics()->create($data);
        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }
<<<<<<< HEAD
    public function showFromNotification(Topic $topic, DatabaseNotification $notification){

        $notification->markAsRead();
        return view('topics.show', compact('topic'));
    }
=======
>>>>>>> 85f90c5a62e12697e7db9f4ce3927e1567510187

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {

        $this->authorize('update',$topic);
        return view('topics.edit',compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update',$topic);
        
        $data=$request->validate([
            'title'=>'required|min:5',
            'content'=>'required|min:10'
        ]);

        $topic->update($data);
        return redirect()->route('topics.show', $topic->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
<<<<<<< HEAD
        $this->authorize('delete',$topic);
=======
        $this->authorize('update',$topic);
>>>>>>> 85f90c5a62e12697e7db9f4ce3927e1567510187
        Topic::destroy($topic->id);
        
        return redirect('topics');
    }
}
