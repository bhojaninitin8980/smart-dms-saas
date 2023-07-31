<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentComment;
use App\Models\Reminder;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

            if (!empty($request->document)) {
                $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentFileName = $documentFilename . '_' . time() . '.' . $documentExtension;

                $dir = storage_path('upload/document');


                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('document')->storeAs('upload/document/', $documentFileName);
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
        return view('document.reminder', compact('document','reminders'));
    }
}
