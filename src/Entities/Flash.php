<?php declare(strict_types=1);

namespace Vottus\Flashes\Entities;

use Nette\Utils\Json;
use Nette\Utils\JsonException;

class Flash
{

    /**
     * @var string // Flash Title
     */
    public $title;

    /**
     * @var mixed // Flash Message
     */
    public $message;

    /**
     * @var string // Flash Type - swal or notify
     */
    public $flashType;

    /**
     * @var string // Additional information that will be passed in a Json
     */
    public $additional;


    /**
     * Flash constructor.
     * @param string $title
     * @param $message
     * @param $flashType
     * @param string $additional
     * @throws JsonException
     */
    public function __construct(string $title, $message, $flashType, $additional)
    {
        $this->title = $title;
        $this->message = $message;
        $this->flashType = $flashType;
        $this->additional = Json::encode($additional);
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getFlashType(): string
    {
        return $this->flashType;
    }

    /**
     * @return string
     */
    public function getAdditional(): string
    {
        return $this->additional;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @param string $flashType
     */
    public function setFlashType(string $flashType): void
    {
        $this->flashType = $flashType;
    }

    /**
     * @param string $additional
     */
    public function setAdditional(string $additional): void
    {
        $this->additional = $additional;
    }
}