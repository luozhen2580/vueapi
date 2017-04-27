<?php
namespace Blog\Domain\Model;

class Blog implements \JsonSerializable
{
    use JsonSerializationTrait;
    
    private $id;
    private $title;

    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function paperDataId()
    {
        return $this->paperDataId;
    }
}