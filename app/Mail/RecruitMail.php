<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecruitMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recruit)
    {
        $this->recruit = $recruit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->from('hoge@hoge.com') // 送信元
          ->subject('採用応募') // メールタイトル
          ->view('recruits.mail') // どのテンプレートを呼び出すか
          ->with(['recruit' => $this->recruit]); // withオプションでセットしたデータをテンプレートへ受け渡す
    }
}
