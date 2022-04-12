<?php

namespace App\Http\Controllers;

use App\Providers\SampleServiceProvider;
use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    public function showServiceContainerTest()
    {
        app()->bind("lifeCycleTest", function () {
            return "ライフサイクルテスト";
        });

        $test = app()->make("lifeCycleTest");

        // コンテナなしのパターン
        // $message = new Message;
        // $sample = new Sample($message);
        // $sample->run();

        // コンテナapp()ありのパターン
        app()->bind("sample", Sample::class);
        $sample = app("sample");
        $sample->run();

         $test =app("ServiceProviderTest");


        dd($test, $sample, app());
    }
}

class Sample
{
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function run()
    {
        $this->message->send();
    }
}
class Message
{
    public function send()
    {
        echo "メッセージを表示";
    }
}
