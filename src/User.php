<?php

declare(strict_types=1);

namespace App;

final class User
{
    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var string */
    private $imageUrl;

    /** @var string */
    private $gender;

    /** @var string */
    private $country;

    public function __construct(
        string $name,
        string $email,
        string $imageUrl,
        string $gender,
        string $country
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->imageUrl = $imageUrl;
        $this->gender = $gender;
        $this->country = $country;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }

    public function gender(): string
    {
        return $this->gender;
    }

    public function country(): string
    {
        return $this->country;
    }
}