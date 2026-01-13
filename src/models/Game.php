<?php
class Game
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTopSoloScores($limit = 5)
    {
        $stmt = $this->pdo->prepare("SELECT *
                                     FROM top_5_solo_scores
                                     LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopMultiplayerWinners($limit = 5)
    {
        $stmt = $this->pdo->prepare("SELECT *
                                     FROM top_5_multiplayer_winners
                                     LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveSoloGame($userId, $score)
    {
        $stmt = $this->pdo->prepare("INSERT INTO solo_games (user_id, score, game_date, started_at, duration) 
                                     VALUES (:user_id, :score, NOW(), NOW(), 0)");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':score', $score, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function saveMultiplayerGame($players, $scores)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO multiplayer_games (game_date, status, started_at) 
                                         VALUES (NOW(), 'completed', NOW())");
            $stmt->execute();

            $playerData = [];
            foreach ($players as $index => $playerName) {
                $playerData[] = [
                    'name' => $playerName,
                    'score' => $scores[$index]
                ];
            }
            usort($playerData, fn($a, $b) => $b['score'] - $a['score']);

            $gameId = $this->pdo->lastInsertId();

            foreach ($playerData as $rank => $player) {
                $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = :username");
                $stmt->bindValue(':username', $player['name'], PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch();

                error_log("User found: " . ($user ? $user['id'] : 'no'));

                $stmt = $this->pdo->prepare("INSERT INTO multiplayer_participants (game_id, user_id, player_name, score, `rank`, is_winner) 
                                             VALUES (:game_id, :user_id, :player_name, :score, :rank, :is_winner)");
                $stmt->bindValue(':game_id', $gameId, PDO::PARAM_INT);
                $stmt->bindValue(':user_id', $user ? $user['id'] : null, $user ? PDO::PARAM_INT : PDO::PARAM_NULL);
                $stmt->bindValue(':player_name', $player['name'], PDO::PARAM_STR);
                $stmt->bindValue(':score', $player['score'], PDO::PARAM_INT);
                $stmt->bindValue(':rank', $rank + 1, PDO::PARAM_INT);
                $stmt->bindValue(':is_winner', $rank === 0 ? 1 : 0, PDO::PARAM_INT);
                $stmt->execute();

                error_log("Participant inserted for: " . $player['name']);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
