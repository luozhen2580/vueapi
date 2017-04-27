<?php
namespace Blog\Domain\Model;

/**
 * 实现 JsonSerializable 接口的序列化方法
 */
trait JsonSerializationTrait
{
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}
