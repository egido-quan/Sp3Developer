<?php

function getData() {
    return json_decode((file_get_contents(__DIR__.'/data.json')), true);
}

function getSampleData() {
    return json_decode((file_get_contents(__DIR__.'/sampleData.json')), true);
}




