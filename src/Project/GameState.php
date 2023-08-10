<?php

namespace App\Project;

use App\Cards\CardHand;
use App\Cards\Card;

/**
 * Class GameState
 * 
 * This class is used to store the game state.
 */
class GameState
{
    /**
     * @var CardHand $tableCards The cards on the table.
     */
    private CardHand $tableCards;

    /**
     * @var CardHand $trashCards The cards in the trash.
     */
    private CardHand $trashCards;

    /**
     * @var int $pot The pot.
     */
    private int $pot;

    /**
     * @var int $smallBlind The small blind.
     */
    private int $smallBlind;

    /**
     * @var int $bigBlind The big blind.
     */
    private int $bigBlind;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tableCards = new CardHand();
        $this->trashCards = new CardHand();
        $this->pot = 0;
        $this->smallBlind = 10;
        $this->bigBlind = 20;
    }

    /**
     * Get the table cards.
     * 
     * @return CardHand The table cards.
     */
    public function getTableCards(): CardHand
    {
        return $this->tableCards;
    }

    /**
     * Get the trash cards.
     * 
     * @return CardHand The trash cards.
     */
    public function getTrashCards(): CardHand
    {
        return $this->trashCards;
    }

    /**
     * Get the table cards as a string.
     * 
     * @return array The table cards as a string.
     */
    public function getTableCardsAsString(): array
    {
        $cards = [];
        $tableCards = $this->getTableCards()->getCards();
        foreach ($tableCards as $card) {
            $cards[] = $card;
        }
        return $cards;
    }

    /**
     * Get the number of table cards.
     * 
     * @return int The number of table cards.
     */
    public function getNumOfTableCards(): int
    {
        return count($this->tableCards->getCards());
    }

    /**
     * Get the pot.
     * 
     * @return int The pot.
     */
    public function getPot(): int
    {
        return $this->pot;
    }

    /**
     * Get the small blind.
     * 
     * @return int The small blind.
     */
    public function getSmallBlind(): int
    {
        return $this->smallBlind;
    }

    /**
     * Get the big blind.
     * 
     * @return int The big blind.
     */
    public function getBigBlind(): int
    {
        return $this->bigBlind;
    }

    /**
     * Add a card to the table.
     * 
     * @param Card $card The card to add.
     * 
     * @return void
     */
    public function addTableCard(Card $card): void
    {
        $this->tableCards->addCard($card);
    }

    /**
     * Add a card to the trash.
     * 
     * @param Card $card The card to add.
     * 
     * @return void
     */
    public function addTrashCard(Card $card): void
    {
        $this->trashCards->addCard($card);
    }

    /**
     * Set the pot.
     * 
     * @param int $pot The pot.
     * 
     * @return void
     */
    public function setPot(int $pot): void
    {
        $this->pot = $pot;
    }

    /**
     * Set the small blind.
     * 
     * @param int $smallBlind The small blind.
     * 
     * @return void
     */
    public function setSmallBlind(int $smallBlind): void
    {
        $this->smallBlind = $smallBlind;
    }

    /**
     * Set the big blind.
     * 
     * @param int $bigBlind The big blind.
     * 
     * @return void
     */
    public function setBigBlind(int $bigBlind): void
    {
        $this->bigBlind = $bigBlind;
    }

    /**
     * Reset the table cards.
     * 
     * @return void
     */
    public function resetTableCards(): void
    {
        $this->tableCards = new CardHand();
    }

    /**
     * Add to the pot
     * 
     * @param int $amount The amount to add.
     * 
     * @return void
     */
    public function addToPot(int $amount): void
    {
        $this->pot += $amount;
    }

    /**
     * Reset the pot.
     * 
     * @return void
     */
    public function resetPot(): void
    {
        $this->pot = 0;
    }
}