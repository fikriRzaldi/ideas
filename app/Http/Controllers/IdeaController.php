<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{

    public function show(Idea $idea)
    {
        return view('ideas.show', [
            'idea' => $idea
        ]);
    }


    public function store()
    {

        request()->validate([
            'idea' => 'required|min:3|max:240'
        ]);

        $idea = Idea::create([
            'content' => request()->get('idea', ''),
        ]);
        return redirect()->route('dashboard')->with('success', 'Idea was created');
        // with being used to flash a message to the session
    }

    public function destroy(Idea $idea) // this is route model binding jadi ID yang diambil langsung dari model dan harus sama dengan yang di route
    {
        // $idea = Idea::where('id', $id)->firstOrFail();
        // $idea->delete();
        $idea->delete(); // this is the same as the above two lines
        return redirect()->route('dashboard')->with('success', 'Idea was deleted');
    }
}
