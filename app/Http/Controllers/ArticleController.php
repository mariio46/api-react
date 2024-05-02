<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->latest()
            ->paginate(9);

        return ArticleResource::collection($articles)->additional([
            'meta' => [
                'has_pages' => $articles->hasPages(),
            ],
        ]);
    }

    public function store()
    {
        // Article::create();
        // $article = new Article;
        // $article->fill([])->saveOrFail();
    }
}
