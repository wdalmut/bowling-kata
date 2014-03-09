<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

use \Game,
    \Frame,
    \Ball;

class FeatureContext extends BehatContext
{

    /**
     * @Given /^this game session$/
     */
    public function gameSession(TableNode $table)
    {
        $this->game = new Game();

        $row = $table->getRow(0);
        foreach ($row as $string) {
            $cells = explode(",", $string);

            $frame = new Frame();
            foreach ($cells as $cell) {
                $ball = new Ball($cell);
                $frame->addRoll($ball);
            }

            $this->game->addFrame($frame);
        }
    }

    /**
     * @When /^I check the game score$/
     */
    public function checkTheGameScore()
    {
        $this->score = $this->game->getScore();
    }

    /**
     * @Then /^my score is (\d+) points$/
     */
    public function myScoreIs($score)
    {
        assertEquals($this->score, $score);
    }
}
