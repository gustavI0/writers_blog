<?php

namespace Blog\Controller;

class Controller {

    public function idSet($id)
    {
        if (isset($id) && $id > 0) return true;
    }

}