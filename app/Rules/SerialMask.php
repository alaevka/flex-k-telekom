<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class SerialMask implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        protected Collection $types,
        protected ?int $typeId = null,
    ) { }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $regExArray = $this->prepareTypes();
        return
            $regExArray->map(function ($item) use ($value) {
                if (preg_match('/' . $item->mask . '/', $value)) {
                    $item->contains = true;
                    $this->setTypeId($item->id);
                } else {
                    $item->contains = false;
                }
                return $item;
            })
                ->contains('contains', true)
        ;
    }

    public function setTypeId(int $val): self
    {
        $this->typeId = $val;
        return $this;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The serial number must be in the correct format.';
    }

    protected function prepareTypes(): Collection
    {
        return $this->types->map(function ($type) {
            $type->mask = $this->convertMask($type->mask);
            return $type;
        });
    }

    protected function convertMask($mask): string
    {
        $serial = '';
        foreach (str_split($mask) as $char) {
            $serial .=  $this->generateChar($char);
        }
        return $serial;
    }

    protected function generateChar(string $char): string
    {
        return match ($char) {
            'N' => '[0-9]',
            'X' => '[A-Z0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'Z' => '(-|_|@)',
            default => '',
        };
    }
}
