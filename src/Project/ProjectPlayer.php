<?php

namespace App\Project;

use App\Cards\CardHand;

class ProjectPlayer implements PlayerInterface
{
    /**
     * @var string $name The name of the player.
     * @var string $role The role of the player.
     * @var int $chips The amount of chips the player has.
     * @var int $bets The amount of chips the player has bet.
     * @var int $totalBets The total amount of chips the player has bet this round.
     * @var CardHand $hand The hand of the player.
     * @var CardHand $best5CardHand The best 5 card hand of the player.
     * @var array $best5CardHandArray The best 5 card hand of the player as an array.
     * @var int $handValue The value of the players hand.
     * @var PlayerActions $playerActions The moves the player can make.
     * @var bool $isHuman If the player is human or not.
     * @var CardHands $cardHands The possible hands in the game.
     * @var PreFlop $preFlop The pre flop logic.
     * @var string $bestHandName The name of the best hand the player has.
     */
    private string $name;
    private string $role = "";
    private int $chips;
    private int $bets = 0;
    private int $totalBets = 0;
    protected CardHand $hand;
    protected CardHand $best5CardHand;
    protected array $best5CardHandArray = [];
    protected int $handValue = 0;
    protected PlayerActions $playerActions;
    private bool $isHuman = true;
    private CardHands $cardHands;
    private PreFlop $preFlop;
    private string $bestHandName = "";

    /**
     * Player constructor.
     *
     * @param string $name The name of the player.
     *
     */
    public function __construct(string $name, int $initialChips)
    {
        $this->name = $name;
        $this->chips = $initialChips;
        $this->hand = new CardHand();
        $this->best5CardHand = new CardHand();
        $this->playerActions = new PlayerActions();
        $this->cardHands = new CardHands();
        $this->preFlop = new PreFlop();
    }

    /**
     * Get the name of the player.
     *
     * @return string The name of the player.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the role of the player.
     *
     * @param string $role The role of the player.
     *
     * @return void
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Get the players chips.
     *
     * @return int The amount of chips the player has.
     */
    public function getChips(): int
    {
        return $this->chips;
    }

    /**
     * Increase the players chips.
     *
     * @param int $money The amount of chips to increase with.
     *
     * @return void
     */
    public function increaseChips(int $money): void
    {
        $this->chips += $money;
    }

    /**
     * Decrease the players chips.
     *
     * @param int $money The amount of chips to decrease with.
     *
     * @return void
     */
    public function decreaseChips(int $money): void
    {
        if ($money > $this->chips) {
            $money = $this->chips;
        }
        $this->chips -= $money;
    }

    /**
     * Get the players bets.
     *
     * @return int The amount of chips the player has bet.
     */
    public function getBets(): int
    {
        return $this->bets;
    }

    /**
     * Set the players bets.
     *
     * @param int $bets The amount of chips to set the players bets to.
     *
     * @return void
     */
    public function setBets(int $bets): void
    {
        $this->bets = $bets;
    }

    /**
     * Reset the players bets.
     *
     * @return void
     */
    public function resetBets(): void
    {
        $this->bets = 0;
    }

    /**
     * Add to the players bets.
     *
     * @param int $betAmount The amount of chips to add to the players bets.
     *
     * @return void
     */
    public function addToBets(int $betAmount): void
    {
        if ($betAmount > $this->chips) {
            $betAmount = $this->chips;
        }
        $this->bets += $betAmount;
    }

    /**
     * Clear the players bets.
     *
     * @return void
     */
    public function clearPlayerBets(): void
    {
        $this->totalBets += $this->bets;
        $this->bets = 0;
    }

    /**
     * Get total bets.
     *
     * @return int The total amount of chips the player has bet this round.
     */
    public function getTotalBets(): int
    {
        return $this->totalBets;
    }

    /**
     * Get the players hand.
     *
     * @return CardHand The players hand.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Set the players hand.
     *
     * @param CardHand $hand The hand to set.
     *
     * @return void
     */
    public function setHand(CardHand $hand): void
    {
        $this->hand = $hand;
    }

    /**
     * Get the players moves.
     *
     * @return PlayerActions The players moves.
     */
    public function getPlayerActions(): PlayerActions
    {
        return $this->playerActions;
    }

    /**
     * Get the players hand value.
     *
     * @return int The players hand value.
     */
    public function getHandValue(): int
    {
        return $this->handValue;
    }

    /**
     * Get the players cards as an array.
     *
     * @return array The players cards as an array.
     */
    public function getString(): array
    {
        return $this->hand->getCardsAsArrayProj();
    }

    /**
     * Check if human
     *
     * @return bool True if human, false if not.
     */
    public function isHuman(): bool
    {
        if ($this->isHuman) {
            return true;
        }

        return false;
    }

    /**
     * Set the players hand value.
     *
     * @param int $handValue The hand value to set.
     *
     * @return void
     */
    public function setHandValue(int $handValue): void
    {
        $this->handValue = $handValue;
    }

    /**
     * Set the players best 5 card hand.
     *
     * @param CardHand $hand The hand to set.
     *
     * @return void
     */
    public function setBest5CardHand(CardHand $hand): void
    {
        $bestHandId = $this->cardHands->checkBestHand($hand);

        switch ($bestHandId) {
            case 9:
                $this->bestHandName = "Straight Flush";
                $this->best5CardHand = $this->cardHands->checkStraightFlush($hand);
                break;
            case 8:
                $this->bestHandName = "Four of a Kind";
                $this->best5CardHand = $this->cardHands->checkFourOfAKind($hand);
                break;
            case 7:
                $this->bestHandName = "Full House";
                $this->best5CardHand = $this->cardHands->checkFullHouse($hand);
                break;
            case 6:
                $this->bestHandName = "Flush";
                $this->best5CardHand = $this->cardHands->checkFlush($hand);
                break;
            case 5:
                $this->bestHandName = "Straight";
                $this->best5CardHand = $this->cardHands->checkStraight($hand);
                break;
            case 4:
                $this->bestHandName = "Three of a Kind";
                $this->best5CardHand = $this->cardHands->checkThreeOfAKind($hand);
                break;
            case 3:
                $this->bestHandName = "Two Pair";
                $this->best5CardHand = $this->cardHands->check2Pair($hand);
                break;
            case 2:
                $this->bestHandName = "Pair";
                $this->best5CardHand = $this->cardHands->checkPair($hand);
                break;
            default:
                $this->bestHandName = "High Card";
                $this->best5CardHand->addCard($this->cardHands->checkHighCardAceHigh($hand));
                break;
        }
    }

    /**
     * Set the players best 5 card hand as an array.
     *
     * @return void
     */
    public function setBest5CardHandArray(): void
    {
        $this->best5CardHandArray = $this->preFlop->turnCardsIntoStringArray($this->best5CardHand->getCards());
    }

    /**
     * Reset the players best 5 card hand.
     *
     * @return void
     */
    public function resetBest5CardHand(): void
    {
        $this->best5CardHand = new CardHand();
        $this->best5CardHandArray = [];
        $this->bestHandName = "";
    }

    /**
     * Get the players best 5 card hand.
     *
     * @return array The players best 5 card hand.
     */
    public function getBest5CardHandArray(): array
    {
        return $this->best5CardHandArray;
    }

    /**
     * Get the players best hand name.
     *
     * @return string The players best hand name.
     */
    public function getBestHandName(): string
    {
        return $this->bestHandName;
    }

    /**
     * Get the players role.
     *
     * @return string The players role.
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Reset the players hand.
     *
     * @return void
     */
    public function resetHand(): void
    {
        $this->hand = new CardHand();
        $this->handValue = 0;
        $this->resetBest5CardHand();
    }

    /**
     * Get the players data.
     *
     * @return array<string, mixed> The players data.
     */
    public function getPlayerData(): array
    {
        return [
            "name" => $this->name,
            "role" => $this->getRole(),
            "chips" => $this->chips,
            "folded" => $this->playerActions->hasFolded(),
            "bets" => $this->bets,
            "totalBets" => $this->totalBets,
            "hand" => $this->getHand(),
            "playerActions" => $this->playerActions->getLatestAction(),
            "isHuman" => $this->isHuman,
            "handValue" => $this->handValue,
        ];
    }

}
