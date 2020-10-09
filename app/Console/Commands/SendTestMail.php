<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestMail extends Command
{
    protected $signature = 'itware:mail';

    protected $description = 'Send a TestMail';

    public function handle()
    {
        Mail::to('test@itware.hu')->queue(new TestMail());
    }
}
