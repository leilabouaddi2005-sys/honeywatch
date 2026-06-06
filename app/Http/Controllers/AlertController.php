<?php
namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::orderByDesc('created_at')->get();
        return view('alerts', compact('alerts'));
    }

    public function store(Request $request)
    {
        Alert::create([
            'user_id'    => auth()->id(),
            'threshold'  => $request->threshold,
            'email_sent' => false,
        ]);
        return redirect('/alerts')->with('success', 'Alerte créée !');
    }
}
