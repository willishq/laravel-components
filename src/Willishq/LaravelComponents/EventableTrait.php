<?php

namespace Willishq\LaravelComponents;

use Laracasts\Commander\Events\EventGenerator;

/**
 * Class EventableTrait
 *
 * Extension of the Laracasts Commander event dispatcher to apply it directly to an object to enable you to raise and
 * dispatch events directly on an object (such as an Eloquent model)
 *
 * It also provides the option to dispatch events for that object on teardown, defaulted to true but can be overwritten.
 *
 * @package Willishq\LaravelComponents
 * @author Andrew Willis <andrew@willishq.co.uk>
 */
trait EventableTrait
{
    use EventGenerator;

    /**
     * Whether to dispatch remaining events when the object is tore down
     *
     * @var bool
     */
    protected $dispatchOnDestruct = true;

    /**
     * Dispatch all remaining events on this element
     */
    public function dispatchEvents()
    {
        $event_dispatcher = App::make('Laracasts\Commander\Events\EventDispatcher');
        $event_dispatcher->dispatch($this->releaseEvents());
    }

    /**
     * Dispatch all remaining events on entity teardown
     */
    public function __destruct()
    {
        if ($this->dispatchOnDestruct) {
            $this->dispatchEvents();
        }
    }
} 