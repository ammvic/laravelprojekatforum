<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Thread;

class ThreadController extends Controller
{
    /**
     * @var Thread
     */
    private $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Prikazuje listu diskusija.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = $this->thread->paginate(10);

        return view('manager.threadss.index', compact('threads'));
    }

    /**
     * Briše određenu diskusiju.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
			$thread = $this->thread->find($id);
			$thread->delete();

			flash('Diskusija uspešno obrisana!')->success();
			return redirect()->route('threadss.index');

        }catch (\Exception $e) {
        	$message = env('APP_DEBUG') ? $e->getMessage() : 'Greška prilikom brisanja...';

        	flash($message)->error();
        	return redirect()->back();
        }
    }
    public function create(Channel $channel)
    {
        return view('threadss.create',
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
            return redirect()->route('threadss.index', $thread->slug);
            
        } catch (\Exception $e) {
            $message = env('APP_ENV') ? $e->getMessage() : "Greška prilikom obrade zahteva!";
            
            flash($message)->warning();
            return redirect()->back();
        }
    }
    
}
