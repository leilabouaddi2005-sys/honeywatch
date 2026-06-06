<?php
namespace App\Http\Controllers;

use App\Models\Honeypot;
use Illuminate\Http\Request;

class HoneypotController extends Controller
{
    public function index()
    {
        $honeypots = Honeypot::orderByDesc('created_at')->get();
        return view('honeypots.index', compact('honeypots'));
    }

    public function create()
    {
        return view('honeypots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'type'     => 'required|in:login,api,form',
            'url_slug' => 'required|string|unique:honeypots,url_slug',
        ]);

        Honeypot::create([
            'name'     => $request->name,
            'type'     => $request->type,
            'url_slug' => $request->url_slug,
            'user_id'  => auth()->id(),
            'is_active'=> true,
            'hit_count'=> 0,
        ]);

        return redirect('/dashboard')->with('success', 'Honeypot créé !');
    }

    public function destroy(Honeypot $honeypot)
    {
        $honeypot->delete();
        return redirect('/dashboard')->with('success', 'Honeypot supprimé.');
    }
}
