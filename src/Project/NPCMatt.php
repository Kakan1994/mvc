<?php

namespace App\Project;

use App\Cards\CardHand;

/**
 * Class NPCMatt
 *
 * Represents a non-player character in the game.
 */
class NPCMatt extends NPCLogic implements PlayerInterface
{
    /**
     * @var string $name The name of the NPC.
     */
    protected string $name;

    /**
     * @var string $role The role of the NPC.
     */
    protected string $role = "";

    /**
     * @var int $chips The amount of chips the NPC has.
     */
    protected int $chips;

    /**
     * @var int $bets The amount of bets the NPC has made.
     */
    protected int $bets = 0;

    /**
     * @var CardHand $hand The hand of the NPC.
     */
    protected CardHand $hand;

    /**
     * @var CardHand $best5CardHand The best 5 card hand of the NPC.
     */
    protected CardHand $best5CardHand;

    /**
     * @var array $best5CardHandArray The best 5 card hand of the NPC as an array.
     */
    protected array $best5CardHandArray = [];

    /**
     * @var PlayerActions $playerActions The player actions of the NPC.
     */
    protected PlayerActions $playerActions;

    /**
     * @var int $handValue The value of the NPC's hand.
     */
    protected int $handValue = 0;

    /**
     * @var bool $isHuman Whether the NPC is a human or not.
     */
    private bool $isHuman = false;

    /**
     * @var CardHands $cardHands The possible hands in the game.
     */
    private CardHands $cardHands;

    /**
     * @var PreFlop $preFlop The pre-flop logic.
     */
    private PreFlop $preFlop;

    /**
     * @var string $bestHandName The name of the best hand.
     */
    private string $bestHandName = "";

    /**
     * NPC constructor.
     *
     * @param string $name The name of the NPC.
     * @param int $initialChips The amount of chips the NPC starts with.
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
     * Get the name of the NPC.
     *
     * @return string The name of the NPC.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Checks if the NPC is a human.
     *
     * @return bool Whether the NPC is a human or not.
     */
    public function isHuman(): bool
    {
        if ($this->isHuman) {
            return true;
        }

        return false;
    }

    /**
     * Set the role of the NPC.
     *
     * @param string $role The role of the NPC.
     *
     * @return void
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Get the role of the NPC.
     *
     * @return string The role of the NPC.
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Get the amount of chips the NPC has.
     *
     * @return int The amount of chips the NPC has.
     */
    public function getChips(): int
    {
        return $this->chips;
    }

    /**
     * Increase the amount of chips the NPC has.
     *
     * @param int $money The amount of chips to increase the NPC's chips with.
     *
     * @return void
     */
    public function increaseChips(int $money): void
    {
        $this->chips += $money;
    }

    /**
     * Decrease the amount of chips the NPC has.
     *
     * @param int $money The amount of chips to decrease the NPC's chips with.
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
     * Get the amount of chips the NPC has bet.
     *
     * @return int The amount of chips the NPC has bet.
     */
    public function getBets(): int
    {
        return $this->bets;
    }

    /**
     * Reset the amount of chips the NPC has bet.
     *
     * @return void
     */
    public function resetBets(): void
    {
        $this->bets = 0;
    }

    /**
     * Add to the amount of chips the NPC has bet.
     *
     * @param int $betAmount The amount of chips to add to the NPC's bets.
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
     * Clear the amount of chips the NPC has bet.
     *
     * @return void
     */
    public function clearPlayerBets(): void
    {
        $this->bets = 0;
    }

    /**
     * Get the NPC's hand.
     *
     * @return CardHand The NPC's hand.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Set the NPC's hand.
     *
     * @param CardHand $hand The NPC's hand.
     *
     * @return void
     */
    public function setHand(CardHand $hand): void
    {
        $this->hand = $hand;
    }

    /**
     * Get the NPC's player actions.
     *
     * @return PlayerActions The NPC's player actions.
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
        if (!empty($hand->getCards())) {
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
                    $this->best5CardHand = new CardHand();
                    $this->best5CardHand->addCard($this->cardHands->checkHighCardAceHigh($hand));
                    break;
            }
        }
    }

    /**
     * Rest the players best 5 card hand.
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
     * Get the players best 5 card hand and set it as array.
     *
     * @return void
     */
    public function setBest5CardHandArray(): void
    {
        $this->best5CardHandArray = $this->preFlop->turnCardsIntoStringArray($this->best5CardHand->getCards());
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
     * Get the NPC's data.
     *
     * @return array<string, mixed> The NPC's data.
     */
    public function getPlayerData(): array
    {
        return [
            "name" => $this->name,
            "role" => $this->role,
            "chips" => $this->chips,
            "bets" => $this->bets,
            "hand" => $this->getHand(),
            "playerActions" => $this->playerActions->getLatestAction(),
            "isHuman" => $this->isHuman,
            "handValue" => $this->handValue,
        ];
    }

    /**
     * Set and return the NPC's move.
     *
     * @param int $actions The actions the NPC can take.
     * @param int $highestBet The highest bet.
     * @param int $bigBlind The big blind.
     *
     * @return array The NPC's move.
     */
    public function setAndReturnMattMove(int $actions, int $highestBet, int $bigBlind): array
    {
        $callAmount = $highestBet - $this->getBets();
        $raiseAmount = $highestBet + $bigBlind - $this->getBets();

        return $this->setMattAction($actions, $callAmount, $raiseAmount);
    }

    /**
     * Set the NPC's action.
     *
     * @param int $actions The actions the NPC can take.
     * @param int $callAmount The amount to call.
     * @param int $raiseAmount The amount to raise.
     *
     * @return array The NPC's action.
     */
    public function setMattAction(int $actions, int $callAmount, int $raiseAmount): array
    {
        $actionData = parent::getAndSetMattAction($this, $actions, $callAmount, $raiseAmount);

        return $actionData;
    }

}
