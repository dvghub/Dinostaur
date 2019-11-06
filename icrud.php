<?php

interface ICrud {
    function connect();

    function setup($sql, $params);

    function create($sql, $params);

    function read($sql, $params);

    function update($sql, $params);

    function delete($sql, $params);
}