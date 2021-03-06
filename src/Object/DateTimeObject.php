<?php

declare(strict_types = 1);

namespace drupol\valuewrapper\Object;

/**
 * Class DateTimeObject
 */
class DateTimeObject extends ObjectValue
{
    /**
     * DateTimeObject constructor.
     *
     * @param \DateTime $value
     */
    public function __construct(\DateTime $value)
    {
        parent::__construct($value);
    }

    /**
     * {@inheritdoc}
     */
    public function hash(): string
    {
        return $this->doHash((string) $this->get()->getTimestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return \serialize([
            'value' => $this->get()->getTimestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $unserialize = \unserialize($serialized);

        $this->set(
            (new \DateTime())->setTimestamp($unserialize['value'])
        );
    }
}
