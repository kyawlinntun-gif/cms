<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create(['name' => 'News']);
        $category2 = Category::create(['name' => 'Design']);
        $category3 = Category::create(['name' => 'Marketing']);

        $tag1  = Tag::create(['name' => 'Customers']);
        $tag2  = Tag::create(['name' => 'Job']);
        $tag3  = Tag::create(['name' => 'Design']);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg'
        ]);

        $post2 = Post::create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'
        ]);

        $post3 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'
        ]);

        $post4 = Post::create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.',
            'category_id' => $category2->id,
            'image' => 'posts/4.jpg'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag2->id, $tag3->id]);

    }
}
