<?php

namespace Illuminate\Support\Facades;

interface Auth
{
    /**
     * @return \App\Models\q8_employee|false
     */
    public static function loginUsingId(mixed $id, bool $remember = false);

    /**
     * @return \App\Models\q8_employee|false
     */
    public static function onceUsingId(mixed $id);

    /**
     * @return \App\Models\q8_employee|null
     */
    public static function getUser();

    /**
     * @return \App\Models\q8_employee
     */
    public static function authenticate();

    /**
     * @return \App\Models\q8_employee|null
     */
    public static function user();

    /**
     * @return \App\Models\q8_employee|null
     */
    public static function logoutOtherDevices(string $password);

    /**
     * @return \App\Models\q8_employee
     */
    public static function getLastAttempted();
}