<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function create() {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {

            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);

            // Convert any YouTube links to embed iframes
            $content = $this->convertYouTubeLinksToEmbed($validatedData['content']);

            Post::create([
                'title' => $validatedData['title'],
                'content' => $content,
            ]);

            return redirect()->route('blog.index')->with('success', 'A poszt sikeresen létre lett hozva');
        }

        return redirect()->back();
    }

    /**
     * Convert YouTube links to embed iframes
     */
    private function convertYouTubeLinksToEmbed($content)
    {
        $pattern = '/https?:\/\/(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/';
        $replacement = '<br><div class="flex justify-center"><iframe width="1120" height="630" src="https://www.youtube.com/embed/$1" frameborder="1" allowfullscreen></iframe></div><br>';

        // Replace the YouTube links with the customized iframe embed
        return preg_replace($pattern, $replacement, $content);
    }


    public function index() {
        $latestPost = Post::latest()->first();

        return view('blog.index', ['latestPost' => $latestPost]);
    }
}
