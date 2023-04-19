<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

class SendNewPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get data to send mail
        $posts = DB::table('posts')->select('title', 'description', 'website_id')
            ->where('new', true)
            ->join('subscribtions', 'posts.website_id', '=', 'subscribtions.website_id')
            ->join('users', 'subscribtions.user_id', '=', 'users.id')
            ->select('email', 'posts.id', 'posts.title', 'posts.description')
            ->get();

        // mailing
        $data = [];
        foreach ($posts as $post) {
            array_push($data, $post->id);
            $mail = $post->email;
            $title = $post->title;
            $description = $post->description;
            Mail::raw($title . "\n" . $description . "\n", function ($m) use ($mail) {
                $m->from(env('MAIL_USERNAME'), 'Subscription Noti');
                $m->to($mail);
                $m->subject('New Posts Alert');
            });
        }

        // after sending mail, change posts status to old
        DB::table('posts')
            ->whereIn('id', $data)
            ->update(['new' => false]);
    }
}
