<?php
namespace Blog\Domain\Model;

class News implements \JsonSerializable
{
    use JsonSerializationTrait;
    
    private $id;
    private $title;
	private $content;
    public function __construct($id, $title, $content)
    {
        $this->id = $id;
        $this->title = $title;
		$this->content = $content;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }
	
	public function content()
    {
        return $this->content;
    }
	
    public function paperDataId()
    {
        return $this->paperDataId;
    }
}