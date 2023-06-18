<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


if (! function_exists('has_error')) {
    /**
     * check has error and return error class
     *
     * @param string $name
     * @param string $errorClass
     */

      function has_error(string $name, $errorClass = 'has-error')
      {
          $errors = session('errors', app(ViewErrorBag::class))->toArray();
          return Arr::exists($errors, $name) ? $errorClass : '';
      }
}

if (! function_exists('render_error')) {
  /**
   * render validate error base on name
   *
   * @param string $name
   * @param string $extraClass
   */

    function render_error(string $name, $extraClass = '')
    {
        $errors = session('errors', app(ViewErrorBag::class))->toArray();
        $output = null;
        if (Arr::exists($errors, $name)) {
            $message = current(Arr::get($errors, $name));
            $output = "<div class='invalid-feedback $extraClass'>$message</div>";
        }
        return $output;
    }
}

if (! function_exists('formatDate')) {
    /**
     * parse date with format
     *
     * @param string $date
     * @param string $format
     */

      function formatDate($date, $format = 'd/m/Y')
      {
          try {
              return $date ? Carbon::parse($date)->format($format) : null;
          } catch (\Exception $th) {
              return null;
          }
      }
}
