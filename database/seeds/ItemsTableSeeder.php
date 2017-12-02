<?php

use Illuminate\Database\Seeder;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;
use \App\Model\Item\Item;
use \App\Model\Item\Status;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Types
        $posts = Item_type::create(['name' => 'posts', 'slug' => 'posts']);
        $pages = Item_type::create(['name' => 'pages', 'slug' => 'pages']);

        // Taxonomies
        $post_categories = new Taxonomy;
        $post_categories->name = 'Categories';
        $post_categories->slug = 'categories';
        $post_categories->hierarchical = true;
        $post_categories->item_type()->associate($posts->id);
        $post_categories->save();

        // Statuses
        $status_published = new Status;
        $status_published->name = 'Published';
        $status_published->slug = 'published';
        $status_published->item_type()->associate($posts->id);
        $status_published->save();

        $status_draft = new Status;
        $status_draft->name = 'Draft';
        $status_draft->slug = 'draft';
        $status_draft->item_type()->associate($posts->id);
        $status_draft->save();

        $status_private = new Status;
        $status_private->name = 'Private';
        $status_private->slug = 'private';
        $status_private->item_type()->associate($posts->id);
        $status_private->save();


        // Terms
        Term::create([
            'name' => 'test 1',
            'slug' => 'test-1',
            'taxonomy_id' => $post_categories->id
        ]);

        $term = Term::create([
            'name' => 'test 2',
            'slug' => 'test-2',
            'taxonomy_id' => $post_categories->id
        ]);

        $term_child = Term::create([
            'name' => 'test 3',
            'slug' => 'test-3',
            'taxonomy_id' => $post_categories->id
        ]);
        $term_child->parent()->associate($term->id);
        $term_child->save();

        $item = new Item;
        $item->name = 'test post';
        $item->slug = 'test-post';
        $item->text = 'lorem ipsum dolor sit amet';
        $item->excerpt = 'lorem ipsum';
        $item->template = 0;
        $item->comments = 0;
        $item->status()->associate($status_published);
        $item->author()->associate(1);
        $item->item_type()->associate($posts->id);
        $item->save();

        $item->terms()->sync($term, $term_child);
        $item->save();
    }
}
