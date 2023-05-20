<?php

namespace App\Services;

class CookieService
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $cookie;

    /**
     * CookieService constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->cookie = request()->cookie($this->name);
    }

    /**
     * Set cookie
     *
     * @param array $value
     * @param int $time
     * @param int $limit
     *
     * @return \Symfony\Component\HttpFoundation\Cookie.
     */
    public function set(array $value = [], int $time = 10080, int $limit = 5)
    {
        $cookie = $this->get() ?? [];

        $data = array_unique(array_merge($value, $cookie));
        $data = array_slice($data, 0, $limit);

        return cookie($this->name, json_encode($data), $time);
    }

    /**
     * Get cookie
     *
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    public function get($defaultValue = null)
    {
        return json_decode(request()->cookie($this->name)) ?? $defaultValue;
    }
}
