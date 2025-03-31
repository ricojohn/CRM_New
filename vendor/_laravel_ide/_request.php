<?php

namespace Illuminate\Http;

interface Request
{
    /**
     * @return \App\Models\q8_employee|null
     */
    public function user($guard = null);
}