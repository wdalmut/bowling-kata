Feature: Bowling game computer
    In order to compute the game score
    As a player of bowling
    I need to complete a frame

    Scenario: compute a simple game score
        Given this game session
            | 5, 2 | 5, 3 | 5, 4 | 5, 2 | 5, 1 | 5, 2 | 5, 3 | 5, 2 | 5, 2 | 5, 2 |
        When I check the game score
        Then my score is 73 points

    Scenario: compute a game score with a spare
        Given this game session
            | 5, 2 | 7, 3 | 5, 4 | 5, 2 | 5, 1 | 5, 2 | 5, 3 | 5, 2 | 5, 2 | 5, 2 |
        When I check the game score
        Then my score is 80 points

    Scenario: compute a game score with a strike
        Given this game session
            | 5, 2 | 10 | 5, 4 | 5, 2 | 5, 1 | 5, 2 | 5, 3 | 5, 2 | 5, 2 | 5, 2 |
        When I check the game score
        Then my score is 84 points

    Scenario: compute a game score with a couple of strikes
        Given this game session
            | 5, 2 | 10 | 10 | 5, 2 | 5, 1 | 5, 2 | 5, 3 | 5, 2 | 5, 2 | 5, 2 |
        When I check the game score
        Then my score is 98 points

    Scenario: compute a game score with three strikes
        Given this game session
            | 5, 2 | 10 | 10 | 10 | 5, 1 | 5, 2 | 5, 3 | 5, 2 | 5, 2 | 5, 2 |
        When I check the game score
        Then my score is 120 points

    Scenario: compute the perfect game
        Given this game session
            | 10 | 10 | 10 | 10 | 10 | 10 | 10 | 10 | 10 | 10, 10, 10 |
        When I check the game score
        Then my score is 300 points

    Scenario: compute a game score with a closing strike
        Given this game session
            | 1, 1 | 1, 1 | 1, 1 | 1, 1 | 1, 1 | 1, 1 | 1, 1 | 1, 1 | 1, 1 | 10, 10, 10 |
        When I check the game score
        Then my score is 48 points
