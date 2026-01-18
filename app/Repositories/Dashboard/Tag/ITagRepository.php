<?php
namespace App\Repositories\Dashboard\Tag;


interface ITagRepository {


    public function getTags();
    public function createTag(array $data);
    public function findTag($id);
    public function updateTag($tag, array $data);
    public function destroy($tag);
}
