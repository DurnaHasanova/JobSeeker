<?php


class Vacancy
{
    public int $userId;
    public int $categoryId;
    public string $jobTitle;
    public int $minSalary;
    public int $maxSalary;
    public string $description;
    public string $skills;
    public string $expireDate;

    /**
     * Vacancy constructor.
     * @param int $userId
     * @param int $categoryId
     * @param string $jobTitle
     * @param int $minSalary
     * @param int $maxSalary
     * @param string $description
     * @param string $skills
     * @param string $expireDate
     */
    public function __construct(int $userId, int $categoryId, string $jobTitle, int $minSalary, int $maxSalary, string $description, string $skills, string $expireDate)
    {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->jobTitle = $jobTitle;
        $this->minSalary = $minSalary;
        $this->maxSalary = $maxSalary;
        $this->description = $description;
        $this->skills = $skills;
        $this->expireDate = date('Y-m-d', strtotime($expireDate));
    }


}