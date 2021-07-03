<?php


class Company
{
    public int $userId;
    public string $name;
    public string $webPage;
    public string $address;
    public string $about;
    public string $image;

    /**
     * Company constructor.
     * @param int $userId
     * @param string $name
     * @param string $email
     * @param string $address
     * @param string $about
     * @param string $image
     */
    public function __construct(int $userId=-1, string $name="", string $webPage="", string $address="", string $about="", string $image="")
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->webPage = $webPage;
        $this->address = $address;
        $this->about = $about;
        $this->image = $image;
    }


}