<?php

namespace LiaTec\Caster;

/**
 * Clase que hace cast de un dato
 */
class Cast
{
    protected $types = [
        Cast\AsAbsFloat::class => ['abs', 'absolute'],
        Cast\AsBoolean::class  => ['boolean', 'bool'],
        Cast\AsCurrency::class => ['currency', 'money'],
        Cast\AsInteger::class  => ['integer', 'int'],
        Cast\AsString::class   => ['string', 'str', 'text'],
        Cast\AsArray::class    => ['array', 'arr'],
        Cast\AsFloat::class    => ['float', 'double'],
        Cast\AsDate::class     => ['date'],
        Cast\AsTrim::class     => ['trim', 'spaces'],
    ];

    /**
     * Realiza el cast del valor
     *
     * @param  mixed  $data
     * @param  string $type
     * @return mixed
     */
    public static function as($value, $type)
    {
        if (is_null($value)) {
            return $value;
        }

        if ($chain = explode('|', $type)) {
            return (new static())->castChain($chain, $value);
        }

        $caster = (new static())->getCaster($type);

        return $caster($value);
    }

    /**
     * Hace cast de una cadena de tipos
     *
     * @param  array $chain
     * @param  mixed $value
     * @return mixed
     */
    public function castChain($chain, $value)
    {
        $chainedValue = $value;
        foreach ($chain as $type) {
            $caster       = (new static())->getCaster($type);
            $chainedValue = $caster($chainedValue);
        }

        return $chainedValue;
    }

    /**
     * Determina el parser que se ejecutara para el tipo de dato
     *
     * @param  string $type
     * @return mixed
     */
    public function getCaster($type)
    {
        $found = array_filter($this->types, function ($types, $class) use ($type) {
            return in_array($type, $types);
        }, ARRAY_FILTER_USE_BOTH);

        if (!$found) {
            throw new \Exception(sprintf('No cast implemented for %s', $type), 1);
        }

        $class = key($found);

        if (!class_exists($class)) {
            throw new \Exception(sprintf('Class not found for %s caster', $type), 2);
        }

        return new $class();
    }
}
