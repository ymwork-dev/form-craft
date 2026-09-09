<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DemoReset extends Command
{
    protected $signature = 'demo:reset';

    protected $description = 'デモ環境のデータベースを初期状態に戻す(migrate:fresh --seed)';

    public function handle(): int
    {
        // テーブルを作り直してシーダーを流すだけ。
        // routes/console.php のスケジュールから毎日呼ばれる。
        $this->call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
        ]);

        $this->info('デモ環境をリセットしました。');

        return self::SUCCESS;
    }
}
