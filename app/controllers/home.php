<?php
class Home extends Controller {
    public function index() {
        $this->view('movie/index');  // ONLY load the movie search form.
    }
}
?>
