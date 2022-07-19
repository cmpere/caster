<?php

namespace LiaTec\Caster\Cast;

class AsSpreadWord
{
    public const ATTRIBUTE_SEPARATOR = ',';

    protected $length;

    protected $maxItems = null;

    protected $keys = null;

    public function __construct($type)
    {
        if (0 == strlen(trim($type))) {
            return ;
        }

        if (str_contains($type, self::ATTRIBUTE_SEPARATOR)) {
            $attributes = explode(self::ATTRIBUTE_SEPARATOR, trim($type));

            if (is_array($attributes) && 2 == count($attributes)) {
                $attributes     = array_values($attributes);
                $this->length   = (int) $attributes[0];
                $this->maxItems = (int) $attributes[1];
            }

            if (is_array($attributes) && count($attributes) > 2) {
                $attributes     = array_values($attributes);
                $this->length   = (int) $attributes[0];
                $this->maxItems = (int) $attributes[1];
                $this->keys     = array_slice($attributes, 2);
            }
        }

        $this->length = (int) trim($type);
    }

    public function __invoke($data)
    {
        if (is_null($this->maxItems)) {
            return preg_split('/\n/', wordwrap($data, $this->length));
        }

        $values = array_slice(
            preg_split('/\n/', wordwrap($data, $this->length)),
            0,
            $this->maxItems
        );

        if (is_array($this->keys)) {
            return array_combine($this->keys, $values);
        }

        return $values;
    }
}
