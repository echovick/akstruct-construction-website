<?php
namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;

class Create extends Component
{
    public $name         = '';
    public $title        = '';
    public $description  = '';
    public $template     = 'default';
    public $is_published = true;
    public $sort_order   = 0;

    // JSON content fields
    public $content       = [];
    public $contentBlocks = [];

    protected $rules = [
        'name'         => 'required|string|max:255|unique:pages,name',
        'title'        => 'required|string|max:255',
        'description'  => 'nullable|string',
        'template'     => 'required|string',
        'is_published' => 'boolean',
        'sort_order'   => 'integer|min:0',
    ];

    public function mount()
    {
        $this->initializeContent();
    }

    public function initializeContent()
    {
        $this->contentBlocks = [
            [
                'id'   => uniqid(),
                'type' => 'hero',
                'data' => [
                    'title'            => '',
                    'subtitle'         => '',
                    'description'      => '',
                    'background_image' => '',
                    'button_text'      => '',
                    'button_url'       => '',
                ],
            ],
        ];
    }

    public function addContentBlock($type = 'text')
    {
        $blockData = $this->getBlockTemplate($type);

        $this->contentBlocks[] = [
            'id'   => uniqid(),
            'type' => $type,
            'data' => $blockData,
        ];
    }

    public function removeContentBlock($index)
    {
        unset($this->contentBlocks[$index]);
        $this->contentBlocks = array_values($this->contentBlocks);
    }

    public function moveBlockUp($index)
    {
        if ($index > 0) {
            $temp                            = $this->contentBlocks[$index];
            $this->contentBlocks[$index]     = $this->contentBlocks[$index - 1];
            $this->contentBlocks[$index - 1] = $temp;
        }
    }

    public function moveBlockDown($index)
    {
        if ($index < count($this->contentBlocks) - 1) {
            $temp                            = $this->contentBlocks[$index];
            $this->contentBlocks[$index]     = $this->contentBlocks[$index + 1];
            $this->contentBlocks[$index + 1] = $temp;
        }
    }

    private function getBlockTemplate($type)
    {
        $templates = [
            'hero'     => [
                'title'            => '',
                'subtitle'         => '',
                'description'      => '',
                'background_image' => '',
                'button_text'      => '',
                'button_url'       => '',
            ],
            'text'     => [
                'content'   => '',
                'alignment' => 'left',
            ],
            'image'    => [
                'src'       => '',
                'alt'       => '',
                'caption'   => '',
                'alignment' => 'center',
            ],
            'cta'      => [
                'title'            => '',
                'description'      => '',
                'button_text'      => '',
                'button_url'       => '',
                'background_color' => '#f3f4f6',
            ],
            'features' => [
                'title'       => '',
                'description' => '',
                'items'       => [],
            ],
        ];

        return $templates[$type] ?? $templates['text'];
    }

    public function save()
    {
        $this->validate();

        $this->content = [
            'blocks' => $this->contentBlocks,
        ];

        Page::create([
            'name'         => $this->name,
            'title'        => $this->title,
            'description'  => $this->description,
            'content'      => $this->content,
            'template'     => $this->template,
            'is_published' => $this->is_published,
            'sort_order'   => $this->sort_order,
        ]);

        session()->flash('message', 'Page created successfully.');

        return redirect()->route('admin.pages.overview');
    }

    public function render()
    {
        return view('livewire.admin.pages.create')->layout('layout.admin');
    }
}
