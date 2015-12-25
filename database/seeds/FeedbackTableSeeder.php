<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-02 09:34:46
/*
/* ************************************************************************** */
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Feedback;
class FeedbackTableSeeder extends Seeder {

	public function run() {
		DB::table('feedbacks')->truncate();
		for ($i=0; $i < 10; $i++) {
			Feedback::create(['status' => 0, 'type' => 'web', 'content' => Str::random(mt_rand(0, 255), 'qwertpasdfghjsadsapo是破产珠江新城努力哦饿哦抛弃我 klzxcvbnmQWERTYUIOPsdgfsid说的话请为你好去我IEu037点开播刷卡机对方空间啊说'."\r\n"), 'contact_type' => 'QQ', 'contact_value' => mt_rand(), 'ip' => '127.0.0.1']);
		}
		for ($i=0; $i < 10; $i++) {
			Feedback::create(['status' => 0, 'type' => 'cos', 'content' => Str::random(mt_rand(0, 255), 'qwertpasdfghjsadsapo是破产珠江新城努力哦饿哦抛弃我 klzxcvbnmQWERTYUIOPsdgfsid说的话请为你好去我IEu037点开播刷卡机对方空间啊说'."\r\n"), 'contact_type' => 'QQ', 'contact_value' => mt_rand(), 'ip' => '127.0.0.1']);
		}
	}
}
