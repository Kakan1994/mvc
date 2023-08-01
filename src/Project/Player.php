<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;

/**
 * Class Player represents a player in the game.
 */
class Player
{
    /**
     * @var string $name The name of the player.
     */
    private $name;

    /**
     * @var CardHand $hand The hand of the player.
     */
    private $hand;

    /**
     * @var int $bet The bet of the player.
     */
    private $bet;

    /**
     * @var int $chips The chips of the player.
     */
    private $chips;

    /**
     * @var bool $folded If the player has folded.
     */
    private $folded;

    /**
     * @var bool $dealer If the player is the dealer.
     */
    private $dealer;

    /**
     * @var bool $bigBlind If the player is the big blind.
     */
    private $bigBlind;

    /**
     * @var bool $smallBlind If the player is the small blind.
     */
    private $smallBlind;

    /**
     * @var bool $allIn If the player is all in.
     */
    private $allIn;

    /**
     * Player constructor.
     *
     * @param string $name The name of the player.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new CardHand();
        $this->bet = 0;
        $this->chips = 1000;
        $this->folded = false;
        $this->dealer = false;
        $this->bigBlind = false;
        $this->smallBlind = false;
        $this->allIn = false;
    }

    /**
     * Player All In.
     */
    public function setAllIn(): void
    {
        $this->allIn = true;
    }

    /**
     * Gets if the player is all in.
     */
    public function getAllIn(): bool
    {
        if ($this->allIn === true) {
            return true;
        }
        return false;
    }

    /**
     * Player folds.
     * @return void
     */
    public function setFolded(): void
    {
        $this->folded = true;
    }

    /**
     * Player is dealer.
     */
    public function setDealer(): void
    {
        $this->dealer = true;
    }

    /**
     * Player is big blind.
     */
    public function setBigBlind(): void
    {
        $this->bigBlind = true;
    }

    /**
     * Player is small blind.
     */
    public function setSmallBlind(): void
    {
        $this->smallBlind = true;
    }

    /**
     * Gets if the player has folded.
     */
    public function getFolded(): bool
    {
        if ($this->folded === true) {
            return true;
        }
        return false;
    }

    /**
     * Gets if the player is dealer.
     */
    public function getDealer(): bool
    {
        if ($this->dealer === true) {
            return true;
        }
        return false;
    }
    /**
     * Gets if the player is big blind.
     */
    public function getBigBlind(): bool
    {
        if ($this->bigBlind === true) {
            return true;
        }
        return false;
    }
    /**
     * Gets if the player is small blind.
     */
    public function getSmallBlind(): bool
    {
        if ($this->smallBlind === true) {
            return true;
        }
        return false;
    }
    /**
     * Gets the name of the player.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the hand of the player.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Gets the bet of the player.
     */
    public function getBet(): int
    {
        return $this->bet;
    }

    /**
     * Gets the chips of the player.
     */
    public function getChips(): int
    {
        return $this->chips;
    }

    /**
     * Sets the bet of the player.
     * @param int $bet The bet of the player.
     */
    public function setBet(int $bet): void
    {
        $this->bet = $bet;
    }

    /**
     * Sets the chips of the player.
     * @param int $chips The chips of the player.
     */
    public function setChips(int $chips): void
    {
        $this->chips = $chips;
    }

    /**
     * Adds chips to the player.
     * @param int $chips The chips to add.
     */
    public function addChips(int $chips): void
    {
        $this->chips += $chips;
    }

    /**
     * Player draws a card.
     */
    public function playerDraw(Card $card): void
    {
        $this->hand->addCard($card);
    }

    /**
     * Player bets.
     * @param int $bet The bet of the player.
     */
    public function playerBets(int $bet): void
    {
        // If the bet is more than the chips, the player is all in.
        if ($bet > $this->chips) {
            $bet = $this->chips;
            $this->allIn = true;
        }
        $this->bet += $bet; // Add the bet to the total bet.
        $this->chips -= $bet; // Remove the bet from the chips.
    }

    public function playerReset(): void
    {
        $this->hand = new CardHand();
        $this->bet = 0;
        $this->folded = false;
        $this->allIn = false;
        if ($this->dealer === true) {
            $this->dealer = false;
            $this->bigBlind = true;
        }elseif ($this->bigBlind === true) {
            $this->bigBlind = false;
            $this->smallBlind = true;
        }elseif ($this->smallBlind === true) {
            $this->smallBlind = false;
        }
    }

    public function toJson(): array
    {
        $hand = $this->hand->getCards();
        $hand = array_map(function ($card) {
            return $card->toJson();
        }, $hand);

        return [
            'name' => $this->name,
            'hand' => $hand,
            'bet' => $this->bet,
            'chips' => $this->chips,
            'folded' => $this->folded,
            'dealer' => $this->dealer,
            'bigBlind' => $this->bigBlind,
            'smallBlind' => $this->smallBlind,
            'allIn' => $this->allIn
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toJson());
    }

    public function fromJson(array $json): void
    {
        $this->name = $json['name'];
        $this->hand = new CardHand();
        foreach ($json['hand'] as $card) {
            $card = json_decode($card, true);
            $this->hand->addCard(new Card($card['suit'], $card['value']));
        }
        $this->bet = $json['bet'];
        $this->chips = $json['chips'];
        $this->folded = $json['folded'];
        $this->dealer = $json['dealer'];
        $this->bigBlind = $json['bigBlind'];
        $this->smallBlind = $json['smallBlind'];
        $this->allIn = $json['allIn'];
    }
}