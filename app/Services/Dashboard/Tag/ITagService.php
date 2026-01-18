<?php

namespace App\Services\Dashboard\Tag;

interface ITagService {

    public function getTags();
    public function createTag(array $data);
    public function findTag($id);
    public function updateTag($tag, array $data);
    public function destroy($tag);
}
