<?php

namespace App\Repositories\Dashboard\Tag;

use App\Models\Tag;

class TagRepository implements ITagRepository
{
    public function getTags()
    {
        return Tag::select('id', 'name', 'slug' , 'status')->paginate(10);
    }

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function findTag($id)
    {
        return Tag::findOrFail($id);
    }

    public function updateTag($tag, array $data)
    {
        $tag->update($data);
        return $tag;
    }

    public function destroy($tag)
    {
        return $tag->delete();
    }
}
