<?php

declare(strict_types = 1);

namespace spec\drupol\valuewrapper\Object;

use drupol\valuewrapper\Object\ClosureObject;
use drupol\valuewrapper\ValueWrapper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClosureObjectSpec extends ObjectBehavior
{
    public function let()
    {
        $closure = function (string $who) {
            return 'hello ' . $who;
        };

        $this->beConstructedWith($closure);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ClosureObject::class);
    }

    public function it_can_hash()
    {
        $this
            ->hash()
            ->shouldReturn('cb69f106128fc1797b55a876e806f07444bb1546');
    }

    public function it_can_be_invoked()
    {
        $this
            ->__call('__invoke', ['world'])
            ->shouldReturn('hello world');
    }

    public function it_can_equals()
    {
        $closure = ValueWrapper::create(function (string $who) {
            return 'hello ' . $who;
        });

        $this
            ->equals($closure)
            ->shouldReturn(true);

        $closure = ValueWrapper::create(function (string $foo) {
            return 'hello ' . $foo;
        });

        $this
            ->equals($closure)
            ->shouldReturn(false);
    }


    public function it_can_serialize()
    {
        $this
            ->serialize()
            ->shouldReturn('a:1:{s:5:"value";s:332:"QzozMjoiU3VwZXJDbG9zdXJlXFNlcmlhbGl6YWJsZUNsb3N1cmUiOjIwMzp7YTo1OntzOjQ6ImNvZGUiO3M6NTQ6ImZ1bmN0aW9uIChzdHJpbmcgJHdobykgewogICAgcmV0dXJuICdoZWxsbyAnIC4gJHdobzsKfSI7czo3OiJjb250ZXh0IjthOjA6e31zOjc6ImJpbmRpbmciO047czo1OiJzY29wZSI7czo0OToic3BlY1xkcnVwb2xcdmFsdWV3cmFwcGVyXE9iamVjdFxDbG9zdXJlT2JqZWN0U3BlYyI7czo4OiJpc1N0YXRpYyI7YjowO319";}');
    }

    public function it_can_unserialize()
    {
        $this
            ->unserialize('a:1:{s:5:"value";s:332:"QzozMjoiU3VwZXJDbG9zdXJlXFNlcmlhbGl6YWJsZUNsb3N1cmUiOjIwMzp7YTo1OntzOjQ6ImNvZGUiO3M6NTQ6ImZ1bmN0aW9uIChzdHJpbmcgJHdobykgewogICAgcmV0dXJuICdoZWxsbyAnIC4gJHdobzsKfSI7czo3OiJjb250ZXh0IjthOjA6e31zOjc6ImJpbmRpbmciO047czo1OiJzY29wZSI7czo0OToic3BlY1xkcnVwb2xcdmFsdWV3cmFwcGVyXE9iamVjdFxDbG9zdXJlT2JqZWN0U3BlYyI7czo4OiJpc1N0YXRpYyI7YjowO319";}');

        $this('closure')
            ->shouldReturn('hello closure');
    }
}
