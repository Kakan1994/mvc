<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

/**
 * Class Game represents a game of poker.
 */
class ProjectGame
{
    /**
     * @var DeckOfCards $deck The deck of cards.
     * @var CardHands $cardHands The possible hands in the game.
     * @var GameLogic $gameLogic The game logic.
     * @var GameData $gameData The game data.
     * @var GameQueue $gameQueue The game queue.
     * @var GameState $gameState The game state.
     * @var PreFlop $preFlop The pre flop logic.
     */
    private DeckOfCards $deck;
    private CardHands $cardHands;
    private GameLogic $gameLogic;
    private GameData $gameData;
    private GameQueue $gameQueue;
    private GameState $gameState;
    private PreFlop $preFlop;

    /**
     * Game constructor.
     *
     * @param DeckOfCards $deck The deck of cards.
     * @param CardHands $cardHands The possible hands in the game.
     * @param GameLogic $gameLogic The game logic.
     * @param GameData $gameData The game data.
     * @param GameQueue $gameQueue The game queue.
     * @param GameState $gameState The game state.
     */
    public function __construct(DeckOfCards $deck, CardHands $cardHands, GameLogic $gameLogic, GameData $gameData, GameQueue $gameQueue, GameState $gameState)
    {
        $this->deck = $deck;
        $this->cardHands = $cardHands;
        $this->gameLogic = $gameLogic;
        $this->gameData = $gameData;
        $this->gameQueue = $gameQueue;
        $this->gameState = $gameState;
        $this->preFlop = new PreFlop();
    }

    /**
     * Set player roles and add them to the game queue.
     *
     * @return array The game queue.
     */
    public function setQueAndRoles(): array
    {
        $this->gameQueue->setRolesBeforeStart();

        return $this->gameQueue->getQue();
    }

    /**
     * Take the blinds from the players.
     *
     * @return int The total pot.
     */
    public function takeBlinds(): int
    {
        $smallBlind = $this->gameState->getSmallBlind();
        $bigBlind = $this->gameState->getBigBlind();

        $this->gameQueue->getSmallBlindPlayer()->addToBets($smallBlind);
        $this->gameQueue->getSmallBlindPlayer()->decreaseChips($smallBlind);
        $this->gameQueue->getBigBlindPlayer()->addToBets($bigBlind);
        $this->gameQueue->getBigBlindPlayer()->decreaseChips($bigBlind);

        $totPot = $smallBlind + $bigBlind;
        $this->gameState->addToPot($totPot);

        return $this->gameState->getPot();
    }

    /**
     * Get GameState.
     *
     * @return GameState The game state.
     */
    public function getGameState(): GameState
    {
        return $this->gameState;
    }

    /**
     *  Deal cards to the players.
     *
     * @return array The game queue.
     */
    public function dealCards(): array
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffle();

        $players = $this->gameQueue->getQue();
        for ($i = 0; $i < 2; $i++) {
            foreach ($players as $player) {
                $card = $this->deck->draw();
                $player->getHand()->addCard($card[0]);
            }
        }

        return $this->gameQueue->getQue();
    }

    /**
     * Get players from the game queue.
     *
     * @return array The game queue.
     */
    public function getQue(): array
    {
        return $this->gameQueue->getQue();
    }

    /**
     * Get the players possible actions.
     *
     * @param PlayerInterface $player The player.
     *
     * @return int The possible actions.
     */
    public function getPossibleActions(PlayerInterface $player): int
    {
        $players = $this->getQue();

        $playerBet = $player->getBets();

        $highestBet = $this->gameLogic->getHighestBet($players);

        if ($playerBet === $highestBet) {
            return 2;
        }

        return 3;
    }

    /**
     * Deque a player from the game queue.
     *
     * @return PlayerInterface The player.
     */
    public function dequePlayer(): PlayerInterface
    {
        return $this->gameQueue->dequePlayer();
    }

    /**
     * Enque a player to the game queue.
     *
     * @param PlayerInterface $player The player.
     *
     * @return PlayerInterface The player.
     */
    public function enquePlayer(PlayerInterface $player): PlayerInterface
    {
        $this->gameQueue->enquePlayer($player);

        return $player;
    }

    /**
     * Get the first player from the game queue.
     *
     * @return PlayerInterface The player.
     */
    public function getFirstPlayer(): PlayerInterface
    {
        return $this->gameQueue->peek();
    }

    /**
     *  Check if the round is over.
     *
     * @return bool If the round is over.
     */
    public function roundOver(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->isRoundOver($players);
    }

    /**
     * Get the highest bet.
     *
     * @return int The highest bet.
     */
    public function getHighestBet(): int
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->getHighestBet($players);
    }

    /**
     * Get the rounds pot.
     *
     * @return int The pot.
     */
    public function getPot(): int
    {
        return $this->gameState->getPot();
    }

    /**
     * Add to the pot.
     *
     * @param int $amount The amount to add to the pot.
     *
     * @return int The total pot.
     */
    public function addToPot(int $amount): int
    {
        $this->gameState->addToPot($amount);

        return $this->gameState->getPot();
    }

    /**
     * Get the big blind.
     *
     * @return int The big blind.
     */
    public function getBigBlind(): int
    {
        return $this->gameState->getBigBlind();
    }

    /**
     * Get the small blind.
     *
     * @return int The small blind.
     */
    public function getSmallBlind(): int
    {
        return $this->gameState->getSmallBlind();
    }

    /**
     * Check if the game is ready for the next stage.
     *
     * @return bool If the game is ready for the next stage.
     */
    public function checkNextStage(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->checkNextStage($players);
    }

    /**
     * Set the next stage
     *
     * @return array The players.
     */
    public function setNextStage(): array
    {
        $players = $this->gameQueue->getQue();

        foreach ($players as $player) {
            $player->getPlayerActions()->clearRoundActions();
        }

        $this->gameQueue->shiftPlayers();

        return $players;
    }

    /**
     * Set the new round.
     *
     * @return array The winner and the pot.
     */
    public function setNewRound(): array
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffle();

        $players = $this->gameQueue->getQue();

        $winner = $this->gameLogic->getWinner($players);

        $pot = $this->gameState->getPot();

        $winner->increaseChips($pot);

        foreach ($players as $player) {
            $player->resetBets();
            $player->getPlayerActions()->clearRoundActions();
            $player->resetHand();
            if ($player->getPlayerActions()->hasFolded()) {
                $player->getPlayerActions()->setHasFolded();
            }
        }

        $this->gameState->resetPot();
        $this->gameState->resetTableCards();

        $this->gameQueue->setQueBeforeStart();

        $this->takeBlinds();
        $this->dealCards();


        return [$winner, $pot];
    }

    /**
     * Set the new round when there is a tie.
     *
     * @return array The winners and the pot.
     */
    public function setNewRoundTie(): array
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffle();

        $players = $this->gameQueue->getQue();

        $winners = $this->getWinnersTie();
        $pot = $this->getPot();

        $count = count($winners);
        $splitPot = $pot / $count;

        foreach ($winners as $winner) {
            $winner->increaseChips($splitPot);
        }
        foreach ($players as $player) {
            $player->resetBets();
            $player->getPlayerActions()->clearRoundActions();
            $player->resetHand();
            if ($player->getPlayerActions()->hasFolded()) {
                $player->getPlayerActions()->setHasFolded();
            }
        }

        $this->gameState->resetPot();
        $this->gameState->resetTableCards();

        $this->gameQueue->setQueBeforeStart();

        $this->takeBlinds();
        $this->dealCards();


        return [$winners, $pot];
    }

    /**
     * Get the winner.
     *
     * @return PlayerInterface The winner.
     */
    public function getWinner(): PlayerInterface
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->getWinner($players);
    }

    /**
     * Set the gamestage to Flop.
     *
     * @return array The table cards.
     */
    public function setFlop(): array
    {
        $card= $this->deck->draw();
        $this->gameState->addTrashCard($card[0]);
        for ($i = 0; $i < 3; $i++) {
            $card = $this->deck->draw();
            $this->gameState->addTableCard($card[0]);
        }

        return $this->getTableCards();
    }

    /**
     * Set the gamestage to Turn.
     *
     * @return array The table cards.
     */
    public function setTurn(): array
    {
        $card = $this->deck->draw();
        $this->gameState->addTrashCard($card[0]);
        $card = $this->deck->draw();
        $this->gameState->addTableCard($card[0]);

        return $this->getTableCards();
    }

    /**
     * Set the gamestage to River.
     *
     * @return array The table cards.
     */
    public function setRiver(): array
    {
        $card = $this->deck->draw();
        $this->gameState->addTrashCard($card[0]);
        $card = $this->deck->draw();
        $this->gameState->addTableCard($card[0]);

        return $this->getTableCards();
    }

    /**
     * Get the table cards.
     *
     * @return array The table cards.
     */
    public function getTableCards(): array
    {
        $arrayCards = $this->gameState->getTableCardsAsString();
        return $this->preFlop->turnCardsIntoStringArray($arrayCards);
    }

    /**
     * Check if there is a winner by fold.
     *
     * @return bool If there is a winner by fold.
     */
    public function isWinnerByFold(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->isWinnerByFold($players);
    }

    /**
     * Checks each players best hands and saves it.
     *
     * @return string The best hands.
     */
    public function getAndSetBestHands(): string
    {
        $tableCards = $this->gameState->getTableCards()->getCards();

        $players = $this->gameQueue->getQue();

        foreach ($players as $player) {
            if (!$player->getPlayerActions()->hasFolded()) {
                $playerCards = $player->getHand()->getCards();
                $allCards =  new CardHand();
                foreach ($playerCards as $card) {
                    $allCards->addCard($card);
                }
                foreach ($tableCards as $card) {
                    $allCards->addCard($card);
                }
                $bestHand = $this->cardHands->checkBestHand($allCards);
                $bestHand = $bestHand*100;
                switch ($bestHand) {
                    case 900:
                        $bestHandAfterCheck = $this->cardHands->checkStraightFlush($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 800:
                        $bestHandAfterCheck = $this->cardHands->checkFourOfAKind($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 700:
                        $bestHandAfterCheck = $this->cardHands->checkFullHouse($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 600:
                        $bestHandAfterCheck = $this->cardHands->checkFlush($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 500:
                        $bestHandAfterCheck = $this->cardHands->checkStraight($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 400:
                        $bestHandAfterCheck = $this->cardHands->checkThreeOfAKind($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 300:
                        $bestHandAfterCheck = $this->cardHands->check2Pair($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    case 200:
                        $bestHandAfterCheck = $this->cardHands->checkPair($allCards);
                        $highCard = $this->cardHands->checkHighCardAceHigh($bestHandAfterCheck);
                        break;
                    default:
                        $highCard = $this->cardHands->checkHighCardAceHigh($allCards);
                        break;
                }
                $highCardValue = $highCard->getValue();
                switch ($highCardValue) {
                    case "A":
                        $highCardValue = "14";
                        break;
                    case "K":
                        $highCardValue = "13";
                        break;
                    case "Q":
                        $highCardValue = "12";
                        break;
                    case "J":
                        $highCardValue = "11";
                        break;
                    default:
                        break;
                }

                $bestHand = $bestHand + intval($highCardValue);
                $player->setHandValue($bestHand);
            }
        }

        return "done";
    }

    /**
     * Check if gamestage is pre or post flop.
     *
     * @return string The gamestage.
     */
    public function checkPreOrPostFlop(): string
    {
        $tableCards = $this->gameState->getTableCards()->getCards();

        if (empty($tableCards)) {
            return "pre";
        }

        return "post";
    }

    /**
     * Gets the human player.
     *
     * @return PlayerInterface The human player.
     */
    public function getPlayer(): PlayerInterface
    {
        $human = "";

        $players = $this->gameQueue->getQue();

        foreach ($players as $player) {
            if ($player->getName() !== "Matt" && $player->getName() !== "Steve") {
                $human = $player;
            }
        }

        return $human;
    }

    /**
     * Checks if the round is tied.
     *
     * @return bool If the round is tied.
     */
    public function isTied(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->isTied($players);
    }

    /**
     * Gets the winners of the round when tied.
     *
     * @return array The winners.
     */
    public function getWinnersTie(): array
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->getTiedWinners($players);
    }

    /**
     * Sets the gamedata
     *
     * @return GameData The gamedata.
     */
    public function setGameData(): GameData
    {
        $this->gameData->setPlayers($this->getQue());
        $this->gameData->setGameStage($this->gameState->getNumOfTableCards());
        $this->gameData->setPot($this->getPot());
        $this->gameData->setTableCards($this->getTableCards());

        return $this->gameData;
    }
}
