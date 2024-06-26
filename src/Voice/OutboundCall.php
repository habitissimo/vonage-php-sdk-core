<?php

declare(strict_types=1);

namespace Vonage\Voice;

use InvalidArgumentException;
use Vonage\Voice\Endpoint\EndpointInterface;
use Vonage\Voice\Endpoint\Phone;
use Vonage\Voice\NCCO\NCCO;
use Vonage\Voice\VoiceObjects\AdvancedMachineDetection;

class OutboundCall
{
    public const MACHINE_CONTINUE = 'continue';
    public const MACHINE_HANGUP = 'hangup';
    protected ?Webhook $answerWebhook = null;
    protected ?Webhook $eventWebhook = null;

    /**
     * Length of seconds before Vonage hangs up after going into `in_progress` status
     */
    protected int $lengthTimer = 7200;

    /**
     * What to do when Vonage detects an answering machine.
     */
    protected ?string $machineDetection = '';

    /**
     * Overrides machine detection if used for more configuration options
     */
    protected ?AdvancedMachineDetection $advancedMachineDetection = null;

    protected ?NCCO $ncco = null;

    /**
     * Whether to use random numbers linked on the application
     */
    protected bool $randomFrom = false;

    /**
     * Length of time Vonage will allow a phone number to ring before hanging up
     */
    protected int $ringingTimer = 60;

    /**
     * Creates a new Outbound Call object
     * If no `$from` parameter is passed, the system will use a random number
     * that is linked to the application instead.
     */
    public function __construct(protected EndpointInterface $to, protected ?Phone $from = null)
    {
        if (!$from) {
            $this->randomFrom = true;
        }
    }

    public function getAnswerWebhook(): ?Webhook
    {
        return $this->answerWebhook;
    }

    public function getEventWebhook(): ?Webhook
    {
        return $this->eventWebhook;
    }

    public function getFrom(): ?Phone
    {
        return $this->from;
    }

    public function getLengthTimer(): ?int
    {
        return $this->lengthTimer;
    }

    public function getMachineDetection(): ?string
    {
        return $this->machineDetection;
    }

    public function getNCCO(): ?NCCO
    {
        return $this->ncco;
    }

    public function getRingingTimer(): ?int
    {
        return $this->ringingTimer;
    }

    public function getTo(): EndpointInterface
    {
        return $this->to;
    }

    public function setAnswerWebhook(Webhook $webhook): self
    {
        $this->answerWebhook = $webhook;

        return $this;
    }

    public function setEventWebhook(Webhook $webhook): self
    {
        $this->eventWebhook = $webhook;

        return $this;
    }

    public function setLengthTimer(int $timer): self
    {
        $this->lengthTimer = $timer;

        return $this;
    }

    public function setMachineDetection(string $action): self
    {
        if ($action === self::MACHINE_CONTINUE || $action === self::MACHINE_HANGUP) {
            $this->machineDetection = $action;

            return $this;
        }

        throw new InvalidArgumentException('Unknown machine detection action');
    }

    public function setNCCO(NCCO $ncco): self
    {
        $this->ncco = $ncco;

        return $this;
    }

    public function setRingingTimer(int $timer): self
    {
        $this->ringingTimer = $timer;

        return $this;
    }

    public function getRandomFrom(): bool
    {
        return $this->randomFrom;
    }

    public function getAdvancedMachineDetection(): ?AdvancedMachineDetection
    {
        return $this->advancedMachineDetection;
    }

    public function setAdvancedMachineDetection(?AdvancedMachineDetection $advancedMachineDetection): static
    {
        $this->advancedMachineDetection = $advancedMachineDetection;

        return $this;
    }
}
