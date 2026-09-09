<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ポートフォリオ公開用: デモ環境を毎日初期状態に戻す。
// 本番サーバーの crontab に `* * * * * php artisan schedule:run` を登録すると動く。
Schedule::command('demo:reset')->daily();
