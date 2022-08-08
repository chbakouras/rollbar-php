<?php namespace Rollbar\TestHelpers\CycleCheck;

class ParentCycleCheckSerializable implements \Serializable
{
    public $child;
    
    public function __construct()
    {
        $this->child = new ChildCycleCheck($this);
    }
    
    public function serialize()
    {
        $objectHashes = \Rollbar\Utilities::GetObjectHashes();
        return array(
            "child" => \Rollbar\Utilities::serializeForRollbar(
                $this->child,
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
