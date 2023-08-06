<?php

namespace App\Project;

use App\Cards\CardHand;
use App\Cards\Card;

class GameState
{
    private CardHand $tableCards;

    private CardHand $trashCards;

    private int $pot;

    private int $smallBlind;

    private int $bigBlind;

    public function __construct()
    {
        $this->tableCards = new CardHand();
        $this->trashCards = new CardHand();
        $this->pot = 0;
        $this->smallBlind = 10;
        $this->bigBlind = 20;
    }

    public function getTableCards(): CardHand
    {
        return $this->tableCards;
    }

    public function getTrashCards(): CardHand
    {
        return $this->trashCards;
    }

    public function getTableCardsAsString(): array
    {
        $cards = [];
        $tableCards = $this->getTableCards()->getCards();
        foreach ($tableCards as $card) {
            $cards[] = $card;
        }
        return $cards;
    }

    public function getNumOfTableCards(): int
    {
        return count($this->tableCards->getCards());
    }

    public function getPot(): int
    {
        return $this->pot;
    }

    public function getSmallBlind(): int
    {
        return $this->smallBlind;
    }

    public function getBigBlind(): int
    {
        return $this->bigBlind;
    }

    public function addTableCard(Card $card): void
    {
        $this->tableCards->addCard($card);
    }

    public function addTrashCard(Card $card): void
    {
        $this->trashCards->addCard($card);
    }

    public function setPot(int $pot): void
    {
        $this->pot = $pot;
    }

    public function setSmallBlind(int $smallBlind): void
    {
        $this->smallBlind = $smallBlind;
    }

    public function setBigBlind(int $bigBlind): void
    {
        $this->bigBlind = $bigBlind;
    }

    public function resetTableCards(): void
    {
        $this->tableCards = new CardHand();
    }

    public function addToPot(int $amount): void
    {
        $this->pot += $amount;
    }

    public function resetPot(): void
    {
        $this->pot = 0;
    }
}