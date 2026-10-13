<?php

namespace App\Docs;

enum SyncOption
{
    /** Rewrite every post, even when its source is unchanged. */
    case Force;

    /** Unpublish docs whose source file was removed. */
    case Prune;

    /** Report what would change without writing anything. */
    case DryRun;
}
