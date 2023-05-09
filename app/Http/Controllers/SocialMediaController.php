<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreSocialMediaRequest;


class SocialMediaController extends Controller
{

    public function index()
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $socialmedias = SocialMedia::latest()->paginate(10);
        return view('socialmedia.index',['socialmedias' => $socialmedias]);
    }
    
    public function show(SocialMedia $socialmedia)
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('socialmedia.show',['socialmedia' => $socialmedia]);
    }
    
    public function store(StoreSocialMediaRequest $request)
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
    
        $socialmedia = SocialMedia::create($request->validated());
    
        if ($request->has('photo')) {
            $socialmedia->addMediaFromRequest('photo')->toMediaCollection('photos');
        }
    
        session()->flash('success', 'Posted');
    
        return redirect()->route('socialmedia.index');
    }
    
    public function edit(SocialMedia $socialmedia)
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('socialmedia.edit', ['socialmedia' => $socialmedia]);
    }
    
    public function update(UpdateSocialMediaRequest $request, SocialMedia $socialmedia)
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
    
        $socialmedia->update($request->validated());
    
        if ($request->has('photo')) {
            $socialmedia->addMediaFromRequest('photo')->toMediaCollection('photos');
        }
    
        session()->flash('success', 'Updated');
    
        return redirect()->route('socialmedia.show', ['socialmedia' => $socialmedia]);
    }
    
    public function destroy(SocialMedia $socialmedia)
    {
        abort_if(!auth()->user()->can('store socialmedia'), Response::HTTP_FORBIDDEN, 'Unauthorized');
    
        $socialmedia->delete();
    
        session()->flash('success', 'Deleted');
    
        return redirect()->route('socialmedia.index');
    }

}