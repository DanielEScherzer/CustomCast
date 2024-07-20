<?php

/**
 * @generate-class-entries
 * @undocumentable
 */

enum CastableTarget {
    case CAST_BOOL;
    case CAST_LONG;
}

interface HasCustomCast {
    /** @return mixed|void */
    public function __doCast(CastableTarget $t) {}
}

final class CustomCastable {
    public function __construct() {}
}