<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
     * List all shortened URLs created by all users except the current user.
     */
    public function allShortenerUrlList()
    {
        $urls = UrlShortener::where('user_id', '!=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('shortener-url.all-list', compact('urls'));
    }

    /**
     * List all shortened URLs created by the current user.
     */
    public function shortenerUrlList()
    {
        $urls = UrlShortener::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('shortener-url.list', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ],[
            'original_url.url' => "Your long URL must be a valid URL"
        ]);

        try {
            $slug = $this->generateSlug();
            
            UrlShortener::create([
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'original_url' => $request->original_url,
                'slug' => $slug
            ]);
    
            return redirect()->back()->with('shortener-url', $slug);
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Url Shortened Failed');
        }
    }

    /**
     * Delete a shortened URL.
     */
    public function destroy(UrlShortener $urlShortener)
    {
        $urlShortener->delete();
        return redirect(route('url.list'));
    }

    
    /**
     * Generate a unique 8 character slug
     */
    private function generateSlug()
    {
        $slug = Str::random(6);

        if(UrlShortener::where('slug', $slug)->exists()) {
            $this->generateSlug();
        }

        return $slug;
    }
}
