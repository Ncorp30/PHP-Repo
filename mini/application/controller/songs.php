<?php

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Songs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        // getting all songs and amount of songs
        $songs = $this->model->getAllSongs();
        $amount_of_songs = $this->model->getAmountOfSongs();

       // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/songs/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: addSong
     * This method handles what happens when you move to http://yourproject/songs/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on songs/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function addSong()
    {
        if (isset($_POST["submit_add_song"])) {
            $artist = filter_input(INPUT_POST, "artist", FILTER_SANITIZE_SPECIAL_CHARS);
            $track = filter_input(INPUT_POST, "track", FILTER_SANITIZE_SPECIAL_CHARS);
            $link = filter_input(INPUT_POST, "link", FILTER_SANITIZE_URL);

            if ($artist !== null && $artist !== false && $track !== null && $track !== false && $link !== null && $link !== false) {
                $this->model->addSong($artist, $track, $link);
            }
        }

        header('location: ' . URL . 'songs/index');
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on songs/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete song
     */
    public function deleteSong($song_id)
    {
        $song_id = filter_var($song_id, FILTER_VALIDATE_INT);

        if ($song_id !== false && $song_id !== null) {
            $this->model->deleteSong($song_id);
        }

        header('location: ' . URL . 'songs/index');
    }

     /**
     * ACTION: editSong
     * This method handles what happens when you move to http://yourproject/songs/editsong
     * @param int $song_id Id of the to-edit song
     */
    public function editSong($song_id)
    {
        $song_id = filter_var($song_id, FILTER_VALIDATE_INT);

        if ($song_id !== false && $song_id !== null) {
            $song = $this->model->getSong($song_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/songs/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'songs/index');
        }
    }
    
    /**
     * ACTION: updateSong
     * This method handles what happens when you move to http://yourproject/songs/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a song" form on songs/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function updateSong()
    {
        if (isset($_POST["submit_update_song"])) {
            $artist = filter_input(INPUT_POST, "artist", FILTER_SANITIZE_SPECIAL_CHARS);
            $track = filter_input(INPUT_POST, "track", FILTER_SANITIZE_SPECIAL_CHARS);
            $link = filter_input(INPUT_POST, "link", FILTER_SANITIZE_URL);
            $song_id = filter_input(INPUT_POST, "song_id", FILTER_VALIDATE_INT);

            if ($artist !== null && $artist !== false && $track !== null && $track !== false && $link !== null && $link !== false && $song_id !== false && $song_id !== null) {
                $this->model->updateSong($artist, $track, $link, $song_id);
            }
        }

        header('location: ' . URL . 'songs/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentation
     */
    public function ajaxGetStats()
    {
        $amount_of_songs = $this->model->getAmountOfSongs();

        // simply echo out something. A supersimple API would be possible by echoing JSON here
        echo $amount_of_songs;
    }

}