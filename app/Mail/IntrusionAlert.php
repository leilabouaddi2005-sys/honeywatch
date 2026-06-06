<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntrusionAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $count;
    public $threshold;

    public function __construct($count, $threshold)
    {
        $this->count     = $count;
        $this->threshold = $threshold;
    }

    public function build()
    {
        return $this->subject('🚨 HoneyWatch — Alerte Intrusion !')
                    ->html("
                        <div style='font-family:Arial;background:#0a0e1a;color:white;padding:30px;'>
                            <h1 style='color:#ef4444;'>🚨 ALERTE HONEYPOT</h1>
                            <p style='color:#9ca3af;'>Le seuil d'attaques a été dépassé !</p>
                            <div style='background:#1f2937;padding:20px;border-radius:8px;margin:20px 0;border-left:4px solid #ef4444;'>
                                <p style='color:white;font-size:18px;'>Nombre d'attaques : <strong style='color:#ef4444;'>{$this->count}</strong></p>
                                <p style='color:white;font-size:18px;'>Seuil configuré : <strong style='color:#f59e0b;'>{$this->threshold}</strong></p>
                            </div>
                            <p style='color:#9ca3af;'>Connectez-vous à HoneyWatch pour voir les détails.</p>
                        </div>
                    ");
    }
}
