<?php
namespace App\Http\Controllers;

use App\Models\Blacklist;

class BlacklistController extends Controller
{
    public function index()
    {
        $blacklist = Blacklist::orderByDesc('created_at')->get();
        return view('blacklist.index', compact('blacklist'));
    }

    public function destroy(string $ip)
    {
        Blacklist::where('ip_address', $ip)->delete();
        return back()->with('success', 'IP retirée de la blacklist.');
    }
}
