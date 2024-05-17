<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{

    public function show(Idea $idea)
    {
        // return view('ideas.show', [
        //     'idea' => $idea
        // ]);

        return view('ideas.show', compact('idea')); // this is the same as the above 
        // compact berfungsi untuk mengirim data ke view dengan key yang sama dengan nama variabelnya 
    }


    public function store()
    {

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $validated['user_id'] = auth()->id();

        // $idea = Idea::create([
        //     'content' => request()->get('content', ''),
        // ]);
        Idea::create($validated); // same as the above
        return redirect()->route('dashboard')->with('success', 'Idea was created');
    }

    public function destroy(Idea $idea) // this is route model binding jadi ID yang diambil langsung dari model dan harus sama dengan yang di route
    {
        if (auth()->id() !== $idea->user_id) { // ngebandingin id user yang login dengan id user yang punya idea
            abort(404);
        }
        // $idea = Idea::where('id', $id)->firstOrFail();
        // $idea->delete();
        $idea->delete(); // this is the same as the above two lines
        return redirect()->route('dashboard')->with('success', 'Idea was deleted');
    }

    public function edit(Idea $idea)
    {
        if (auth()->id() !== $idea->user_id) { // ngebandingin id user yang login dengan id user yang punya idea
            abort(404);
        }
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        if (auth()->id() !== $idea->user_id) { // ngebandingin id user yang login dengan id user yang punya idea
            abort(404);
        }

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        // $idea->content = request()->get('content');
        // $idea->save();
        $idea->update($validated); // this is the same as the above two lines
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea was updated');
    }
}
