<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Services\Dashboard\Tag\ITagService;

class TagController extends Controller
{
    protected $tag;

    public function __construct(ITagService $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->getTags();
        return view('dashboard.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tag.create');
    }

    public function store(StoreTagRequest $request)
    {
        $data = $request->except('_token');

        $tag = $this->tag->createTag($data);

        if (!$tag) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.tag.index')->with('success', __('dashboard.add_msg'));
    }

    public function edit($id)
    {
        $tag = $this->tag->findTag($id);

        if (!$tag) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return view('dashboard.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $data = $request->except('_token', '_method');

        $tag = $this->tag->updateTag($this->tag->findTag($id), $data);

        if (!$tag) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->route('dashboard.tag.index')->with('success', __('dashboard.update_msg'));
    }

    public function destroy($id)
    {
        $tag = $this->tag->destroy($this->tag->findTag($id));

        if (!$tag) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        return redirect()->back()->with('success', __('dashboard.delete_msg'));
    }

    public function search(Request $request)
{
    $search = $request->input('search', '');

    $tags = Tag::where('name', 'LIKE', "%{$search}%")
        ->limit(10)
        ->get();

    return $tags->map(function ($tag) {
        return [
            'id' => $tag->id,
            'value' => $tag->name,
        ];
    });
}

}
