<?php


class VacancyDto
{
    public  int $count;
    public array $data;

    /**
     * VacancyDto constructor.
     * @param int $count
     * @param array $data
     */
    public function __construct(int $count, array $data)
    {
        $this->count = $count;
        $this->data = $data;
    }


}