<?php

namespace App\Http\Controllers;


use App\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Tag::first()->posts);
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request) //createtagrequest is been injuect and it's automatically validate the request.Everything that link to the reuest will be kept in CreateCategoryRequest and not in the controller
    {
        Tag::create([
        //Tag::tag($request->all()); // ($request->all()) is a mass assigning value directly to the db

        'name' => $request->name

        ]);

        session()->flash('success', 'Tag created successfully.');

        return redirect(route('tags.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagsRequest $request, Tag $tag) //type the request first than category
    {
        
        $tag->update([ //category update - this is the easy method
            'name' => $request->name // pass the name
        ]);
        //$tag->name = $request->name; and this is the normal and harder method

        //$tag->save();


        session()->flash('success', 'Tag Updated successfully.'); //flash a message


        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){

            session()->flash('error', 'Tag cannot be deleted because it has some posts');

            return redirect()->back();

        }

        $tag->delete();

        session()->flash('success', 'Tag deleted successfully.');

        return redirect(route ('tags.index'));
        
    }
}
