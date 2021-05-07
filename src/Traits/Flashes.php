<?php declare(strict_types=1);
namespace Vottus\Flashes\Traits;

use Nette\Utils\JsonException;
use Vottus\Flashes\Entities\Flash;

trait Flashes
{

    /**
     * @param string|null $title // Flash Title
     * @param $message // Flash Content
     * @param string $type // Flash Type
     * @param mixed|null $additional // Additional information you may need
     * @return Flash
     */
    public function flash(?string $title, $message, string $type="info", $additional=null): Flash
    {
        $flash = new Flash($title, $message, $type, $additional);
        $this->getPresenter()->flashMessage($flash);
        return $flash;
    }

}
