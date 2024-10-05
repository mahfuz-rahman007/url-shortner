<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlShortenerController extends Controller
{

    /**
     * Redirect to the original URL when accessing a shortened URL.
     */
    public function redirectUrl(UrlShortener $urlShortener)
    {
        $urlShortener->increment('clicks', 1, [
            'last_clicked_at' => now()
        ]);
        return response()->redirectTo($urlShortener->original_url);
    }

    /**
     * List all shortened URLs created by the current user.
     */
    public function shortenerUrlList()
    {
        $urls = UrlShortener::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
        return view('shortener-url.list', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]); 

        $url = new UrlShortener();
        $url->url = $request->url;
        $url->user_id = Auth::user()->id;
        $url->save();  

        return redirect(route('url.list'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UrlShortener $urlShortener)
    {
        return view('shortener-url.edit', compact('urlShortener'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UrlShortener $urlShortener)
    {
        $request->validate([
            'url' => 'required|url',
        ]); 

        $urlShortener->url = $request->url; 
        $urlShortener->save();  

        return redirect(route('url.list'));
    }

    /**
     * Delete a shortened URL.
     */
    public function destroy(UrlShortener $urlShortener)
    {
        $urlShortener->delete();
        return redirect(route('url.list'));
    }  
}
