<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentComment;
use App\Models\DocumentHistory;
use App\Models\Reminder;
use App\Models\shareDocument;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use App\Models\VersionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mail;

class DocumentController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage document')) {
            $documents = Document::where('parent_id', '=', \Auth::user()->parentId())->get();
            return view('document.index', compact('documents'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $category=Category::where('parent_id',\Auth::user()->parentId())->get()->pluck('title','id');
        $category->prepend(__('Select Category'),'');
        $tages=Tag::where('parent_id',\Auth::user()->parentId())->get()->pluck('title','id');

        return view('document.create',compact('category','tages'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create document')) {
            $validator = \Validator::make(
                $request->all(), [
                'name' => 'required|regex:/^[\s\w-]*$/',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'document' => 'required',
            ], [
                    'regex' => __('The Name format is invalid, Contains letter, number and only alphanum'),
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $document = new Document();
            $document->name = $request->name;
            $document->category_id = $request->category_id;
            $document->sub_category_id = $request->sub_category_id;
            $document->description = $request->description;
            $document->tages = !empty($request->tages)?implode(',',$request->tages):'';
            $document->created_by = \Auth::user()->id;
            $document->parent_id = \Auth::user()->parentId();
            $document->save();

            if (!empty($request->document)) {
                $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentFileName = time() . '.' . $documentExtension;

                $dir = storage_path('upload/document');
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('document')->storeAs('upload/document/', $documentFileName);
                $version=new VersionHistory();
                $version->document=$documentFileName;
                $version->current_version=1;
                $version->document_id=$document->id;
                $version->created_by= \Auth::user()->id;
                $version->parent_id= \Auth::user()->parentId();
                $version->save();
            }

            return redirect()->back()->with('success', __('Document successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function show($cid)
    {
        $id=Crypt::decrypt($cid);
        $document=Document::find($id);
        return view('document.show',compact('document'));
    }


    public function edit(Document $document)
    {
        $category=Category::where('parent_id',\Auth::user()->parentId())->get()->pluck('title','id');
        $category->prepend(__('Select Category'),'');
        $tages=Tag::where('parent_id',\Auth::user()->parentId())->get()->pluck('title','id');

        return view('document.edit',compact('document','category','tages'));
    }


    public function update(Request $request, Document $document)
    {
        if (\Auth::user()->can('edit document')) {
            $validator = \Validator::make(
                $request->all(), [
                'name' => 'required|regex:/^[\s\w-]*$/',
                'category_id' => 'required',
                'sub_category_id' => 'required',
            ], [
                    'regex' => __('The Name format is invalid, Contains letter, number and only alphanum'),
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $document->name = $request->name;
            $document->category_id = $request->category_id;
            $document->sub_category_id = $request->sub_category_id;
            $document->description = $request->description;
            $document->tages = !empty($request->tages)?implode(',',$request->tages):'';
            $document->save();

            return redirect()->back()->with('success', __('Document successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy(Document $document)
    {
        if (\Auth::user()->can('delete document')) {
            $document->delete();
            return redirect()->back()->with('success', 'Document successfully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function myDocument()
    {
        if (\Auth::user()->can('manage my document')) {
            $documents = Document::where('created_by', '=', \Auth::user()->id)->get();
            return view('document.own', compact('documents'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
    public function comment($ids){
        $id=Crypt::decrypt($ids);
        $document=Document::find($id);
        $comments=DocumentComment::where('document_id',$id)->get();
        return view('document.comment', compact('document','comments'));
    }

    public function commentData(Request $request,$ids){
        $validator = \Validator::make(
            $request->all(), [
            'comment' => 'required',

        ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $id=Crypt::decrypt($ids);
        $document=Document::find($id);
        $comment=new DocumentComment();
        $comment->comment=$request->comment;
        $comment->user_id=\Auth::user()->id;
        $comment->document_id=$document->id;
        $comment->parent_id=\Auth::user()->parentId();
        $comment->save();
        return redirect()->back()->with('success', 'Document comment successfully created!');
    }

    public function reminder($ids){
        $id=Crypt::decrypt($ids);
        $document=Document::find($id);
        $reminders=Reminder::where('document_id',$id)->get();
        $users=User::where('parent_id',\Auth::user()->parentId())->get()->pluck('name','id');
        return view('document.reminder', compact('document','reminders','users'));
    }

    public function versionHistory($ids){
        $id=Crypt::decrypt($ids);
        $document=Document::find($id);
        $versions=VersionHistory::where('document_id',$id)->get();

        return view('document.version_history', compact('document','versions'));
    }

    public function newVersion(Request $request,$ids){
        $validator = \Validator::make(
            $request->all(), [
                'document' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $id=Crypt::decrypt($ids);

        VersionHistory::where('document_id',$id)->update(['current_version'=>0]);
        if (!empty($request->document)) {
            $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
            $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
            $documentExtension = $request->file('document')->getClientOriginalExtension();
            $documentFileName = time() . '.' . $documentExtension;

            $dir = storage_path('upload/document');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $request->file('document')->storeAs('upload/document/', $documentFileName);
            $version=new VersionHistory();
            $version->document=$documentFileName;
            $version->current_version=1;
            $version->document_id=$id;
            $version->created_by= \Auth::user()->id;
            $version->parent_id= \Auth::user()->parentId();
            $version->save();
        }

        return redirect()->back()->with('success', __('New version successfully uploaded!'));
    }

    public function shareDocument($ids){
        $id=Crypt::decrypt($ids);
        $document=Document::find($id);
        $shareDocuments=shareDocument::where('document_id',$id)->get();
        $users=User::where('parent_id',\Auth::user()->parentId())->get()->pluck('name','id');
        return view('document.share', compact('document','shareDocuments','users'));
    }

    public function shareDocumentData(Request $request,$ids){

        $validator = \Validator::make(
            $request->all(), [
                'assign_user' => 'required',
            ]
        );
        if(isset($request->time_duration)){
            $validator = \Validator::make(
                $request->all(), [
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
        }
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        foreach ($request->assign_user as $user){
            $share=new shareDocument();
            $share->user_id=$user;
            $share->document_id=$request->document_id;
            if(!empty($request->start_date) && !empty($request->end_date)){
                $share->start_date=$request->start_date;
                $share->end_date=$request->end_date;
            }
            $share->parent_id=\Auth::user()->parentId();
            $share->save();
        }
        return redirect()->back()->with('success', 'Document successfully assigned!');
    }

    public function shareDocumentDelete($id){
        $shareDoc=shareDocument::find($id);
        $shareDoc->delete();
        return redirect()->back()->with('success', 'Assigned document successfully removed!');
    }

    public function sendEmail($ids){
        $id=Crypt::decrypt($ids);
        $document=Document::find($id);

        return view('document.send_email', compact('document'));
    }

    public function sendEmailData(Request $request,$ids){
        $validator = \Validator::make(
            $request->all(), [
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data=[
            'to'=>$request->email,
            'from'=>env('MAIL_FROM_ADDRESS'),
            'from_name'=>env('MAIL_FROM_NAME'),
            'subject'=>$request->subject,
            'message'=>$request->message,
        ];

        try
        {
            \Mail::to($request->email)->send(new \App\Mail\Document($data));
        }
        catch(\Exception $e)
        {
            $error = $e->getMessage();
            return redirect()->back()->with('error', $error);
        }

        return redirect()->back()->with('success', 'Mail successfully sent!');
    }

    public function history(){
        $histories=DocumentHistory::where('parent_id',\Auth::user()->parentId())->get();
        return view('document.history', compact('histories'));
    }

}
