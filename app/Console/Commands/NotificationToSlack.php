<?php

namespace App\Console\Commands;

use App\Recruit;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationToSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noticeSlack:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send alert notification to slack';

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
     * @return mixed
     */
    public function handle()
    {
        // $message = "てすと";
        // urlencode($message);
        // $url = "https://slack.com/api/chat.postMessage?token=xoxp-1056523428438-1087098726576-1152130867856-065dcbaf62b2966142c30a9a090247db&channel=%23general&text=${message}";
        // $client = new Client();
        // $response = $client->request("GET", $url);
        $headers = [
            'Authorization: Bearer xoxb-1056523428438-1113893597127-kbdFpe68PqOqqBfNOTEJp7RN', //（1)
            'Content-Type: application/json;charset=utf-8'
        ];

        $url = "https://slack.com/api/chat.postMessage"; //(2)

        $recruits = Recruit::getIsNotCompletedThreeDaysMore();
        $recruits_text = '';
        foreach($recruits as $recruit) {
            $recruits_text .= "{$recruit->name} ({$recruit->name_kana}) 様:   {$recruit->email}\n詳細URL: {$recruit->getShowUrl()}\n\n";
        }

$text = <<<_EOF_
<!channel>
採用応募の対応が終わっていません。
下記対応お願い致します。

-- 未対応応募者一覧 --
```
${recruits_text}
```
_EOF_;
        //(3)
        $post_fields = [
            "channel" => "random",
            "text" => $text,
            "username" => "◆ 採用応募通知くん ◆",
        ];

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($post_fields)
        ];

        $ch = curl_init();

        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);
        Log::debug($result);

        curl_close($ch);
    }
}
