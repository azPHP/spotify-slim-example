<?php

namespace SpotifyApp\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SpotifyApp\Model\TrackRepository")
 */
class Track
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="SpotifyApp\Model\Album", inversedBy="tracks")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     **/
    private $album;

    /**
     * @var string
     *
     * @ORM\Column(name="spotify_id", type="string", length=50)
     */
    private $spotifyId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="disc_number", type="integer")
     */
    private $discNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="explicit", type="boolean")
     */
    private $explicit;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration_ms", type="integer")
     */
    private $durationMs;

    /**
     * @var string
     *
     * @ORM\Column(name="preview_url", type="string", length=255)
     */
    private $previewUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="track_number", type="integer")
     */
    private $trackNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="uri", type="string", length=255)
     */
    private $uri;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * @return mixed
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param int $discNumber
     */
    public function setDiscNumber($discNumber)
    {
        $this->discNumber = $discNumber;
    }

    /**
     * @return int
     */
    public function getDiscNumber()
    {
        return $this->discNumber;
    }

    /**
     * @param boolean $explicit
     */
    public function setExplicit($explicit)
    {
        $this->explicit = $explicit;
    }

    /**
     * @return boolean
     */
    public function getExplicit()
    {
        return $this->explicit;
    }

    /**
     * @return int
     */
    public function getDurationMs()
    {
        return $this->durationMs;
    }

    /**
     * @param int $durationMs
     * @return self
     */
    public function setDurationMs($durationMs)
    {
        $this->durationMs = $durationMs;
        return $this;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $previewUrl
     */
    public function setPreviewUrl($previewUrl)
    {
        $this->previewUrl = $previewUrl;
    }

    /**
     * @return string
     */
    public function getPreviewUrl()
    {
        return $this->previewUrl;
    }

    /**
     * @param string $spotifyId
     */
    public function setSpotifyId($spotifyId)
    {
        $this->spotifyId = $spotifyId;
    }

    /**
     * @return string
     */
    public function getSpotifyId()
    {
        return $this->spotifyId;
    }

    /**
     * @param int $trackNumber
     */
    public function setTrackNumber($trackNumber)
    {
        $this->trackNumber = $trackNumber;
    }

    /**
     * @return int
     */
    public function getTrackNumber()
    {
        return $this->trackNumber;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}
