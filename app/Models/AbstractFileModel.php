<?php

declare(strict_types=1);

namespace Fileshare\Models;

abstract class AbstractFileModel extends AbstractModel
{
    protected $name;
    protected $id;
    protected $author;
    protected $publishDate;
    protected $size;
    protected $format;
}
