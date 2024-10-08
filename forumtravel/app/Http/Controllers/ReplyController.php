<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Reaction;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Storage;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reply' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Primer validacije slike
        ]);
    
        // Preuzimanje ID diskusije iz zahteva (request)
        $threadId = $request->thread_id;
    
        // Pronalaženje diskusije na osnovu ID-ja
        $thread = Thread::find($threadId);
    
        // Provera da li je pronađena diskusija
        if (!$thread) {
            return redirect()->back()->with('error', 'Diskusija nije pronađena.');
        }
    
        // Priprema podataka za odgovor
        $reply = [
            'reply' => $request->reply,
            'user_id' => auth()->id(),
        ];
    
        // Dodavanje slike ako je priložena
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reply-images', 'public');
            $reply['image'] = str_replace('reply-images/', '', $imagePath);
        }
    
        // Kreiranje odgovora unutar diskusije
        $thread->replies()->create($reply);
        flash('Odgovor je uspešno poslat.')->success();
    
        return redirect()->back();
    }
    
    
    public function destroy($id)
    {
        // Provera da li je korisnik prijavljen
        if (auth()->check()) {
            // Pronalaženje odgovora koji korisnik želi da ukloni
            $reply = Reply::findOrFail($id);

            // Provera da li je trenutno prijavljeni korisnik autor tog odgovora
            if ($reply->user_id === auth()->user()->id) {
                // Brisanje odgovora
                $reply->delete();
                flash('Odgovor uspešno obrisan!')->success();
            } else {
                // Ako korisnik nije autor odgovora
                flash('Nemate dozvolu za brisanje ovog odgovora!')->success();
            }
        } else {
            // Ako korisnik nije prijavljen
            flash('Prijavite se da biste obrisali odgovor!')->success();
        }

        return redirect()->back();
    }

    public function react(Request $request, $id)
    {
        $reply = Reply::findOrFail($id);

        // Provera da li je korisnik već reagovao na ovaj odgovor
        $existingReaction = $reply->reactions()->where('user_id', auth()->id())->first();
        if ($existingReaction) {
            flash('Već ste reagovali na ovaj odgovor.')->warning();
            return redirect()->back();
        }

        // Dodavanje reakcije
        $reply->reactions()->create([
            'user_id' => auth()->id(),
            'type' => $request->reaction
        ]);

        // Ažuriranje broja lajkova ili dislajkova
        if ($request->reaction === 'like') {
            // Pronalaženje ili kreiranje reakcije korisnika za ovaj odgovor
            $reaction = Reaction::updateOrCreate([
                'user_id' => auth()->id(),
                'reply_id' => $reply->id,
            ], [
                'type' => 'like',
            ]);
        } elseif ($request->reaction === 'dislike') {
            // Pronalaženje ili kreiranje reakcije korisnika za ovaj odgovor
            $reaction = Reaction::updateOrCreate([
                'user_id' => auth()->id(),
                'reply_id' => $reply->id,
            ], [
                'type' => 'dislike',
            ]);
        }

        flash('Uspešno ste dodali reakciju!')->success();
        return redirect()->back();
    }

    public function like($id)
    {
        $reply = Reply::findOrFail($id);

        // Pronalaženje ili kreiranje reakcije korisnika za ovaj odgovor
        $reaction = Reaction::updateOrCreate([
            'user_id' => auth()->id(),
            'reply_id' => $reply->id,
        ], [
            'type' => 'like',
        ]);

        flash('Uspešno ste lajkovali odgovor!')->success();
        return redirect()->back();
    }

    public function dislike($id)
    {
        $reply = Reply::findOrFail($id);

        // Pronalaženje ili kreiranje reakcije korisnika za ovaj odgovor
        $reaction = Reaction::updateOrCreate([
            'user_id' => auth()->id(),
            'reply_id' => $reply->id,
        ], [
            'type' => 'dislike',
        ]);

        flash('Uspešno ste dislajkovali odgovor!')->success();
        return redirect()->back();
    }
}
