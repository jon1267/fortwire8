<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Image;

class PostComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $post_id;
    //public $posts;//не совместимо с пагинацией
    public $title;
    public $body;
    public $img;
    public $oldImage;
    public $isModal;

    public function render()
    {
        //$this->posts = Post::get();
        $posts = Post::paginate(2);
        return view('livewire.post-component', ['posts' => $posts]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->post_id = null;
        $this->title = '';
        $this->body  = '';
        $this->img   = null;
        $this->oldImage   = null;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        // тут на update глюк... на crete OK
        $this->img = $this->storeImage();

        //dd($this);

        Post::updateOrcreate(
            ['id' => $this->post_id],
            [
                'title' => $this->title,
                'body' => $this->body,
                'img' => $this->img,
            ]
        );

        session()->flash('message', 'Данные сохранены.');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        //$this->img = $post->img;
        $this->oldImage = $post->img;

        //dd($this, $post);

        $this->openModal();
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        session()->flash('message', 'Данные удалены.');
    }

    public function storeImage()
    {
        // не выбрали новую картинку: если нет прошлой возвр. null
        if (!$this->img) {
            return $this->oldImage ?? null;
        }

        $image = Image::make($this->img)->encode('jpg');
        $filename = time() . '-' . Str::random(8) . '.jpg';
        //Storage::disk('public')->put($filename, $image);//save in /storage/app/public
        $image->save(public_path() . '/' . 'img/' . $filename); //save in /public/img ... && it must exist

        return $filename;
    }
}
