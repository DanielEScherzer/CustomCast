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
        public const int TARGET_BOOL = 1;
        public const int TARGET_FLOAT = 2;
        public const int TARGET_LONG = 4;
        public const int TARGET_ALL = 7;

        private int $target;
        public function __construct(int $target = CustomCastable::TARGET_ALL) {}
    }
}