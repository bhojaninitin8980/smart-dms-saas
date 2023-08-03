<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;

class ReminderController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage reminder')) {
            $reminders = Reminder::where('parent_id', '=', \Auth::user()->parentId())->get();
            return view('reminder.index', compact('reminders'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $documents=Document::where('parent_id',\Auth::user()->parentId())->get()->pluck('name','id');
        $documents->prepend(__('Select Document'),'');
        $users=User::where('parent_id',\Auth::user()->parentId())->get()->pluck('name','id');
        return view('reminder.create', compact('users','documents'));
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
            $reminder->assign_user = !empty($request->assign_user)?implode(',',$request->assign_user):'';
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
        return view('reminder.show',compact('reminder'));
    }


    public function edit(Reminder $reminder)
    {
        $documents=Document::where('parent_id',\Auth::user()->parentId())->get()->pluck('name','id');
        $documents->prepend(__('Select Document'),'');
        $users=User::where('parent_id',\Auth::user()->parentId())->get()->pluck('name','id');
        return view('reminder.edit', compact('users','documents','reminder'));
    }


    public function update(Request $request, Reminder $reminder)
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

            $reminder->document_id = $request->document_id;
            $reminder->date = $request->date;
            $reminder->time = $request->time;
            $reminder->subject = $request->subject;
            $reminder->message = $request->message;
            $reminder->assign_user = !empty($request->assign_user)?implode(',',$request->assign_user):'';
            $reminder->save();

            return redirect()->back()->with('success', __('Reminder successfully updated!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->back()->with('success', 'Reminder successfully deleted!');
    }

    public function myReminder(){
        if (\Auth::user()->can('manage reminder')) {
            $reminders = Reminder::where('created_by', '=', \Auth::user()->id)->get();
            return view('reminder.own', compact('reminders'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
}
