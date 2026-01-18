<?php

namespace App\Services\Dashboard\Tag;

use App\Repositories\Dashboard\Tag\ITagRepository;

class TagService implements ITagService
{
    protected $repo;

    public function __construct(ITagRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getTags()
    {
        return $this->repo->getTags();
    }

    public function createTag(array $data)
    {
        return $this->repo->createTag($data);
    }

    public function findTag($id)
    {
        return $this->repo->findTag($id);
    }

    public function updateTag($tag, array $data)
    {
        return $this->repo->updateTag($tag, $data);
    }

    public function destroy($tag)
    {
        return $this->repo->destroy($tag);
    }
}
