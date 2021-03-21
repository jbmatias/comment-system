<?php

namespace Tests\Unit;

use Database\Factories\UserFactory;
use App\Models\Post;
use App\Models\Username;
use Tests\TestCase;

class NewPostTest extends TestCase
{    
    private $post;
    private $username;    

    /**
     * Unit testing
     * Getting posts and comment on Post
     * @param null
     */

    public function test_post_and_post_comment()
    {   
        $this->post = new Post();
        $this->username = new Username();
        $this->factory = new UserFactory();

        $this->call('GET', '/api/posts')
            ->assertStatus(200);
        
        $post = $this->post->first();
        $username = $this->username->create([
            'name' => 'Abigail Otwell'
        ]);
        
        if($post) {
            $request = ['comment' => 'This is a test comment', 'username_id' => $username->id];            
            $this->call('POST', 'api/posts/'. $post->id .'/comment', $request)
                ->assertStatus(200);                     
        }        
    }
}
