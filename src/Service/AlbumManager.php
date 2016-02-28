<?php

namespace SpotifyApp\Service;

use SpotifyApp\Model\Album;
use SpotifyApp\Model\Image;
use SpotifyApp\Model\Track;
use Doctrine\ORM\EntityManager;

class AlbumManager {

    private $em;
    private $spotifyManager;

    public function __construct(EntityManager $em, SpotifyManager $spotifyManager) {

        $this->em = $em;
        $this->spotifyManager = $spotifyManager;
    }

    /**
    * Search the spotify database for albums and save the results in the database
    *
    * @param $query
    * @return array
    */
    public function search($query)
    {
        $spotifyAlbumSearchResponse = $this->spotifyManager->search($query);

        $albums = [];

        foreach ($spotifyAlbumSearchResponse['items'] as $item) {

            $albums[] = $this->getAlbumForSpotifySearchItem($item);
        }

        return $albums;
    }

    /**
     * Get an album from database otherwise get it from spotify
     * @param $id
     * @return Album
     */
    public function getAlbum($id)
    {
        /** @var Album $album */
        $album = $this->em->getRepository(Album::class)
            ->find($id);

        if( ! $album->getDownLoaded() ) {
            $this->saveTracks($album);
        }

        return $album;
    }

    /**
     * Get an album from the database if we have it otherwsie save it
     *
     * @param $item
     * @return mixed
     */
    private function getAlbumForSpotifySearchItem($item)
    {
        //Query for Album and if no album exists, save album data
        $album = $this->em->getRepository(Album::class)->findOneBy(array('spotifyId' => $item['id']));
        if (!$album) {
            $album = $this->saveAlbumData($item);
        }

        return $album;
    }

    /**
     * Save searched Album data
     *
     * @param $item
     * @return Album
     */
    private function saveAlbumData($item)
    {
        $album = new Album();

        //extra array variables
        $externalUrls = $item['external_urls'];

        //Quick and dirty way to fix no images from Spotify api, could do better...
        $images = $item['images'];
        if ($images[1]){
            $previewImage = $images[1];
            $album->setPhotoPreview($previewImage['url']);
        }

        $album->setSpotifyId($item['id']);
        $album->setSpotifyUrl($externalUrls['spotify']);
        $album->setName($item['name']);

        $album->setAlbumType($item['album_type']);
        $album->setHref($item['href']);
        $album->setType($item['type']);
        $album->setUri($item['uri']);


        $this->em->persist($album);
        $this->em->flush($album);

        //Save Images for Album
        $this->saveAlbumImages($item, $album);

        return $album;
    }

    /**
     * Save album Images (urls)
     *
     * @param $item
     * @param Album $album
     * @return array
     */
    private function saveAlbumImages($item, Album $album)
    {
        $images = [];

        foreach ($item['images'] as $image) {

            $albumImage = new Image();

            $albumImage->setAlbum($album);
            $albumImage->setHeight($image['height']);
            $albumImage->setWidth($image['width']);
            $albumImage->setUrl($image['url']);

            $this->em->persist($albumImage);
            $this->em->persist($album);

            $this->em->flush();

            $images[] = $albumImage;
        }

        return $images;
    }

    /**
     * Save an Album's tracks into the database
     *
     * @param Album $album
     */
    public function saveTracks(Album $album)
    {
        $spotifyAlbum = $this->spotifyManager->getAlbum($album->getSpotifyId());

        $tracks = $spotifyAlbum['tracks'];

        foreach ($tracks['items'] as $track) {

            $albumTrack = new Track();

            $albumTrack->setAlbum($album);
            $albumTrack->setSpotifyId($track['id']);
            $albumTrack->setDiscNumber($track['disc_number']);
            $albumTrack->setName($track['name']);
            $albumTrack->setDurationMs($track['duration_ms']);
            $albumTrack->setExplicit($track['explicit']);
            $albumTrack->setPreviewUrl($track['preview_url']);
            $albumTrack->setTrackNumber($track['track_number']);
            $albumTrack->setType($track['type']);
            $albumTrack->setUri($track['uri']);

            if ($track['explicit'] == true) {
                $albumTrack->setExplicit(true);
            } else {
                $albumTrack->setExplicit(false);
            }

            $this->em->persist($albumTrack);
        }

        $album->setDownLoaded(true);
        $this->em->persist($album);
        $this->em->flush();
    }
}