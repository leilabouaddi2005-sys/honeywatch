<?php
use App\Http\Controllers\TrapController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HoneypotController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\AlertController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('honeypots', HoneypotController::class);
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
    Route::post('/alerts', [AlertController::class, 'store'])->name('alerts.store');
    Route::get('/blacklist', [BlacklistController::class, 'index'])->name('blacklist.index');
    Route::delete('/blacklist/{ip}', [BlacklistController::class, 'destroy'])->name('blacklist.destroy');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

require __DIR__.'/auth.php';

Route::match(['GET','POST'], '/{slug}', function(\Illuminate\Http\Request $request, $slug) {
    $honeypot = App\Models\Honeypot::where('url_slug', $slug)
                                   ->where('is_active', true)
                                   ->first();
    if (!$honeypot) abort(404);
    return app(TrapController::class)->capture($request, $slug);
});
