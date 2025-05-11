<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    // Show a list of categories
    public function showCategories()
    {
        // Static data for categories (replace with database query in real app)
        $categories = [
            'general-discussion' => [
                'name' => 'General Discussion',
                'description' => 'Talk about anything here.',
                'slug' => 'general-discussion',
                'icon' => 'fas fa-comments'
            ],
            'support' => [
                'name' => 'Support',
                'description' => 'Get help or support.',
                'slug' => 'support',
                'icon' => 'fas fa-life-ring'
            ],
        ];

        return view('forums.test', compact('categories'));
    }

    // Show posts within a category
    public function showCategory($slug)
    {
        // Static data for categories and posts (replace with a database query in real app)
        $categories = [
            'general-discussion' => [
                'name' => 'General Discussion',
                'description' => 'Talk about anything here.',
                'slug' => 'general-discussion',
                'posts' => [
                    [
                        'id' => 1,
                        'title' => 'Welcome to the Forums!',
                        'author' => 'Admin',
                        'date' => '2025-05-10',
                        'excerpt' => 'Introduce yourself here and say hi...',
                        'comments_count' => 2,  // New: Comment count
                    ],
                    [
                        'id' => 2,
                        'title' => 'How do I set up Tailwind?',
                        'author' => 'User123',
                        'date' => '2025-05-09',
                        'excerpt' => 'I’m new to TailwindCSS and need some help...',
                        'comments_count' => 1,  // New: Comment count
                    ],
                ],
            ],
            'support' => [
                'name' => 'Support',
                'description' => 'Get help or support.',
                'slug' => 'support',
                'posts' => [
                    [
                        'id' => 3,
                        'title' => 'How to troubleshoot errors?',
                        'author' => 'DevMike',
                        'date' => '2025-05-09',
                        'excerpt' => 'Having issues with error handling? Let’s discuss solutions.',
                        'comments_count' => 3,  // New: Comment count
                    ],
                ],
            ],
        ];

        // Check if category exists
        if (!isset($categories[$slug])) {
            abort(404); // Category not found
        }

        $category = $categories[$slug];

        return view('forums.category', compact('category'));
    }

    // Show an individual post
    public function showPost($slug, $id)
    {
        // Static data for posts (replace with a database query in real app)
        $posts = [
            1 => [
                'title' => 'Welcome to the Forums!',
                'content' => 'This is the full content of the post...',
                'comments_count' => 2,  // New: Comment count
                'comments' => [
                    ['author' => 'User1', 'content' => 'Great post! Looking forward to more!', 'date' => '2025-05-10'],
                    ['author' => 'User2', 'content' => 'I agree, welcome everyone!', 'date' => '2025-05-09'],
                ],
            ],
            2 => [
                'title' => 'How do I set up Tailwind?',
                'content' => 'Here is a detailed explanation on setting up TailwindCSS...',
                'comments_count' => 1,  // New: Comment count
                'comments' => [
                    ['author' => 'User123', 'content' => 'This helped me a lot, thanks!', 'date' => '2025-05-09'],
                ],
            ],
            3 => [
                'title' => 'How to troubleshoot errors?',
                'content' => 'Let’s discuss solutions for error handling...',
                'comments_count' => 3,  // New: Comment count
                'comments' => [
                    ['author' => 'DevMike', 'content' => 'This is very useful, will try it out!', 'date' => '2025-05-09'],
                    ['author' => 'UserX', 'content' => 'I have a similar issue, thanks for the tips!', 'date' => '2025-05-08'],
                ],
            ],
        ];

        // Check if the post exists
        if (!isset($posts[$id])) {
            abort(404); // Post not found
        }

        $post = $posts[$id];

        return view('forums.post', compact('post'));
    }
}
