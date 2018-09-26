<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;
use \Fileshare\Models\{File, User, Avatar};
use function Funct\Collection\first;

class PreviewService
{
    /**
     * @property array
     */
    private $previewsSupportMap;

    public function __construct($container)
    {
        $this->previewsSupportMap = $container->get('settings')['previews'];
    }

    public function getFilePreview($fileId)
    {
        $file = File::find($fileId);

        if ($this->filePreviewIsSupported($mime)) {
            return $this->getIndividualPreview($file);
        } else {
            return $this->getDefaultPreview($file);
        }
    }

    private function filePreviewIsSupported(string $mime)
    {
        return array_key_exist($mime, $this->previewsSupportMap);
    }

    private function getIndividualPreview()
    {

    }

    private function getDefaultPreview()
    {

    }
}
