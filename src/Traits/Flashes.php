<?php declare(strict_types=1);
namespace Vottus\Flashes\Traits;

use Nette\Utils\JsonException;
use Vottus\Flashes\Entities\Flash;

trait Flashes
{

    /**
     * Sends flash message
     * @param $title // flash title
     * @param $message // flash content
     * @param string $type // type of flash
     * @param $additional // additional information (for ex. timer in swal)
     * @return Flash // the flash
     * @throws JsonException
     */
    public function flash($title, $message, string $type, $additional): Flash
    {
        $id = $this->getParameterId('flash');
        $messages = $this->getPresenter()->getFlashSession()->$id;
        $messages[] = $flash = new Flash($title, $message, $type, $additional);
        $this->getTemplate()->flashes = $messages;
        $this->getPresenter()->getFlashSession()->$id = $messages;
        return $flash;
    }

}