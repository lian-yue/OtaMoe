<?php
/* ************************************************************************** */
/*
/*	Lian Yue
/*
/*	Url: www.lianyue.org
/*	Email: admin@lianyue.org
/*	Author: Moon
/*
/*	Created: UTC 2015-12-22 10:22:56
/*
/* ************************************************************************** */
namespace App\Http\Controllers\Admin;
use Auth;
use App\User\log;
use App\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller {
	public function __construct() {
		$this->authorize('permission', 'feedback');
	}

	public function index(Request $request) {
		$feedbacks = new Feedback;
		switch ($request->input('filter')) {
			case 'all':
				$feedbacks = $feedbacks->withTrashed();
				break;
			case 'trashed':
				$feedbacks = $feedbacks->onlyTrashed();
				break;
			case 'read':
				$feedbacks = $feedbacks->where('status', '=', 1);
				break;
			default:
				$feedbacks = $feedbacks->where('status', '=', 0);
		}
		$feedbacks = $feedbacks->orderBy('id', 'DESC')->paginate(20);
		foreach ($request->query() as $key => $value) {
			$feedbacks->addQuery($key, $value);
		}
		return view('admin.feedback.index')->with(['feedbacks' => $feedbacks]);
	}

	public function show($id) {
		$feedback = (new Feedback)->findOrFail($id);
		if ($feedback->status == 0) {
			$feedback->status = 1;
			$feedback->save();
		}
		return view('admin.feedback.show')->with(['feedback' => $feedback]);
	}

	public function read($id) {
		(new Feedback)->findOrFail($id)->update(['status' => 1]);
		return redirect()->back();
	}

	public function unread($id) {
		(new Feedback)->findOrFail($id)->update(['status' => 0]);
		return redirect()->back();
	}



	public function destroy($id) {
		(new Feedback)->findOrFail($id)->delete();
		log::create(['user_id' => Auth::user()->id, 'type' => 'feedback', 'content' => ['id' => $id, 'method' => 'destroy'], 'ip' => app('request')->ip()]);
		return redirect()->back();
	}

	public function restore($id) {
		(new Feedback)->withTrashed()->findOrFail($id)->restore();
		log::create(['user_id' => Auth::user()->id, 'type' => 'feedback', 'content' => ['id' => $id, 'method' => 'restore'], 'ip' => app('request')->ip()]);
		return redirect()->back();
	}
}
