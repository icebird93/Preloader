<?php

namespace DarkGhostHunter\Preloader;

use DateTime;

trait Conditions
{
    /**
     * If this Preloader should run
     *
     * @var bool
     */
    protected bool $shouldRun = true;

    /**
     * Run the Preloader script after Opcache hits reach certain number
     *
     * @param  int $hits
     * @return $this
     */
    public function whenHits(int $hits = 200000) : self
    {
        return $this->when(fn () => $hits > $this->opcache->getHits());
    }

    /**
     * Run the Preloader script when the condition evaluates to true
     *
     * @param callable|bool $condition
     * @return $this
     */
    public function when($condition) : self
    {
        $this->shouldRun = (bool) (is_callable($condition) ? $condition() : $condition);

        return $this;
    }
}
