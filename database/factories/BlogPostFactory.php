<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title        = $this->faker->sentence(rand(3, 8), true);
        $content      = $this->faker->realText(rand(1000, 4000));
//        $is_published = rand(1, 5) > 1;
        $is_published = $this->faker->boolean(55);
        $created_at   = $this->faker->dateTimeBetween('-3 months', '-2 days');
        
        return [
            'category_id'  => rand(1, 11),
            'user_id'      => (rand(1, 5) == 5) ? 1 : 2,
            'title'        => $title,
            'slug'         => Str::slug($title),
            'excerpt'      => $this->faker->text(rand(40, 100)),
            'content_raw'  => $content,
            'content_html' => $content,
            'is_published' => $is_published,
            'published_at' => $is_published
                ? $this->faker->dateTimeBetween('-2 months', '-1 days') : null,
            'created_at'   => $created_at,
            'updated_at'   => $created_at,
        ];
    }
    
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    
    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if ( ! Features::hasTeamFeatures()) {
            return $this->state([]);
        }
        
        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name'          => $user->name . '\'s Team',
                            'user_id'       => $user->id,
                            'personal_team' => true,
                    ];
                }),
            'ownedTeams'
        );
    }
}
