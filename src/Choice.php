<?php

namespace macrominds\laravel\choice;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class Choice
{
    protected $message;
    protected $options;
    protected $title;

    private function __construct($title, $message, $options)
    {
        $this->title = $title;
        $this->message = $message;
        $this->options = $options;
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function make($title, $message, $options)
    {
        return redirect()->back()->withChoice(serialize([$title, $message, $options]));
    }

    public static function get($serializedChoice)
    {
        $array = unserialize($serializedChoice);

        return new self($array[0], $array[1], $array[2]);
    }

    public function hasTitle()
    {
        return ! empty($this->title);
    }
    public function title()
    {
        return $this->title;
    }
    public function message()
    {
        return $this->message;
    }

    public function options()
    {
        return $this->options;
    }

    public static function render($name = null)
    {
        $name = $name ?: 'choice::dialogue';

        return new HtmlString(view($name, [
            'hasChoice' => Session::has('choice'),
            'choice' => Session::get('choice'),
            ])->render());
    }
}
