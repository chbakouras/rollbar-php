<?php namespace Rollbar\TestHelpers\ChildCycle;

class ChildCycleCheckSerializable implements \Serializable
{
    public $parent;
    
    public function __construct($parent)
    {
        $this->parent = $parent;
    }
    
    public function serialize()
    {
        $objectHashes = \Rollbar\Utilities::GetObjectHashes();
        return array(
            "parent" => \Rollbar\Utilities::serializeForRollbar(
                $this->parent,
                null,
                $objectHashes
            )
        );
    }
    
    public function unserialize($serialized)
    {
    }

    public function __serialize(): array
    {
        return $this->serialize();
    }

    public function __unserialize(array $data): void
    {
        $this->unserialize($data);
    }
}
