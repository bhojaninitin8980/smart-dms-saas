<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create document')) {
            $validator = \Validator::make(
                $request->all(), [
                'date' => 'required',
                'time' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $reminder = new Reminder();
            $reminder->document_id = $request->document_id;
            $reminder->date = $request->date;
            $reminder->time = $request->time;
            $reminder->subject = $request->subject;
            $reminder->message = $request->message;
            $reminder->assign_user = !empty($request->tages)?implode(',',$request->assign_user):'';
            $reminder->created_by = \Auth::user()->id;
            $reminder->parent_id = \Auth::user()->parentId();
            $reminder->save();

            return redirect()->back()->with('success', __('Reminder successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

    }


    public function show(Reminder $reminder)
    {
        //
    }


    public function edit(Reminder $reminder)
    {
        //
    }


    public function update(Request $request, Reminder $reminder)
    {
        //
    }


    public function destroy(Reminder $reminder)
    {
        //
    }
}
