<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function edit(User $user, Article $article): bool
    {
        return $article->user->is($user);
    }

}
