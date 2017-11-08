<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;
    //private $file;
    protected $files = array();

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param UploadedFile[] $files
     */

    public function setFiles(array $files)
    {
        $this->files = $files;
        return $this;
    }
    /**
     * @return UploadedFile[]
     */
    public function getFiles()
    {
        return $this->files;
    }
    public function upload(){
        if($this->files === null){
            return;
        }

        foreach ($this->files as $file){
            $name = $file[0]->getClientOriginalName();

            $file[0]->move($this->getUploadRootDir(), $name);
        }


        $this->url = $name;
    }
    /*
    public function getFile(){
        return $this->file;
    }
    public function setFile(UploadedFile $file = null){
        $file = $this->file;
    }
    */
    public function getUploadDir(){
        return 'uploads/img/test';
    }

    public function getUploadRootDir(){
        return __DIR__  .   '/../../../../web/'.$this->getUploadDir();
    }
}

