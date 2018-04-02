<?php
/**
 * Created by PhpStorm.
 * User: Ablo
 * Date: 14/03/2018
 * Time: 21:55
 */

namespace App\Repository;


use App\Tag;
use Illuminate\Support\Str;

class TagRepository
{
    protected $tag;
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
    public function store($post, $tags)
    {
        $tags = explode(',', $tags);
        foreach ($tags as $tag)
        {
            $tag = trim($tag);
            $tag_url = Str::slug($tag);
            //on verifie voir si le tag existe dejà...
            $tag_ref = $this->tag->where('tag_url', $tag_url)->first();
            if (is_null($tag_ref)){
                //si le tag n'existe pas on creer un objet tag
                $tag_ref = new $this->tag(['tag'=>$tag, 'tag_url'=>$tag_url]);
                $post->tags()->save($tag_ref);
            }else{
                $post->tags()->attach($tag_ref->id);
            }
        }
    }
}