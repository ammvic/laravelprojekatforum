<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
     User, Channel
};
use App\Http\Requests\ThreadRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Thread;



class ThreadController extends Controller
{
    private $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Prikazuje listu tema.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        // $this->authorize('threads/index');

        $channelParam = $request->channel;
        if (null !== $channelParam) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate(5);
        } else {
            $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('threads.index', compact('threads'));
    }

    /**
     * Prikaže formu za kreiranje nove teme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {
        return view('threads.create',
            ["channels" => $channel->all()]
        );
    }

    /**
     * Čuva novo kreiranu temu.
     *
     * @param  \App\Http\Requests\ThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try {
            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);
    
            // Dohvatanje trenutno prijavljenog korisnika
            $user = auth()->user();
    
            // Kreiranje nove niti za trenutno prijavljenog korisnika
            $thread = $user->threads()->create($thread);
    
            flash('Diskusija je uspešno kreirana!')->success();
            return redirect()->route('threads.show', $thread->slug);
            
        } catch (\Exception $e) {
            $message = env('APP_ENV') ? $e->getMessage() : "Greška prilikom obrade zahteva!";
            
            flash($message)->warning();
            return redirect()->back();
        }
    }
    
    /**
     * Prikazuje određenu temu.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();
        if(!$thread) return redirect()->route('threads.index');
        return view('threads.show', compact('thread'));
    }

    
 public function edit(Request $request, $thread)
{
    try {
        $thread = Thread::whereSlug($thread)->firstOrFail();
        $this->authorize('update', $thread);
        
        // Ako je zahtev POST, znači da korisnik šalje podatke za ažuriranje
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'body' => 'required|string',
            ]);

            $thread->update([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            session()->flash('success', 'Diskusija je uspešno ažurirana.');
            return redirect()->route('threads.show', $thread->slug); // Preusmeravanje na stranicu za prikaz teme
        }

        return view('threads.edit', compact('thread'));
    } catch (\Exception $e) {
        $message = env('APP_ENV') ? $e->getMessage() : "Greška prilikom obrade vašeg zahteva!";
        
        flash($message)->warning();
        return redirect()->back();
    }
}

public function follow(Thread $thread)
{
    $user = auth()->user();

    if ($user->following($thread)) {
        $user->unfollow($thread);
        flash('Uspešno ste otpratili diskusiju!')->success();
    } else {
        $user->follow($thread);
        flash('Uspešno ste zapratili diskusiju!')->success();
    }

    return back();
}
public function myThreads()
{
    $user = auth()->user();
    $threads = $user->followedThreads()->paginate(10);
    
    return view('threads.my_threads', compact('threads'));
}

public function destroy($thread)
{
    try {
        $thread = Thread::whereSlug($thread)->firstOrFail();

        $thread->delete();

        flash('Diskusija je uspešno obrisana!')->success();
        return redirect()->route('threads.index');
    } catch (\Exception $e) {
        $message = env('APP_ENV') ? $e->getMessage() : "Greška prilikom brisanja diskusije!";
        
        flash($message)->warning();
        return redirect()->back();
    }
}

}

