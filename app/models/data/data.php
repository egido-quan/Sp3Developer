<?php

function getData() {
    return json_decode((file_get_contents(__DIR__.'/data.json')), true);
}

