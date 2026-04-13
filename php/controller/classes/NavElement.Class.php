<?php



class NavElement
{
    private $name;
    private $url;

    public function __construct($data = [])
    {
        if (is_array($data)) {
            $this->hydrate($data);
        } else {
            $this->url = $data;
        }
    }

    private function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable([$this, $methode])) {
                $this->$methode($value);
            }
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
}
