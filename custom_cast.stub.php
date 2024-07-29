<?php

/**
 * @generate-class-entries
 */

namespace CustomCasting {
    enum CastableTarget {
        case CAST_BOOL;
        case CAST_FLOAT;
        case CAST_LONG;
    }

    interface HasCustomCast {
        /** @return mixed|void */
        public function __doCast(CastableTarget $t) {}
    }

    /** @strict-properties */
    final class CustomCastable {
        public function __construct() {}
    }
}