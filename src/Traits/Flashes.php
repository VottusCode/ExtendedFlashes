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
     * @throws JsonException
     */
    public function flash(?string $title, $message, string $type="info", $additional=null): Flash
    {
        $id = $this->getParameterId('flash');
        $messages = $this->getPresenter()->getFlashSession()->$id;
        $messages[] = $flash = new Flash($title, $message, $type, $additional);
        $this->getTemplate()->flashes = $messages;
        $this->getPresenter()->getFlashSession()->$id = $messages;
        return $flash;
    }

}