<?php

declare(strict_types=1);

namespace Mageugenes\Cv\Api\Data;

/**
 * @api
 */
interface CvInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return int
     */
    public function getYearOfBirth(): int;

    /**
     * @return string
     */
    public function getExperience(): string;
}
