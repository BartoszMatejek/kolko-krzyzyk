<?php

class tictactoe extends game
{
	var $player = "X";
	var $board = array();
	var $totalMoves = 0;	

	function tictactoe()
	{
		game::start();
        $this->newBoard();
	}
	
	function newGame()
	{
		$this->start();
		
		$this->player = "X";
		$this->totalMoves = 0;
        $this->newBoard();
	}
    
    function newBoard() {
    
		$this->board = array();
        
        for ($x = 0; $x <= 2; $x++)
        {
            for ($y = 0; $y <= 2; $y++)
            {
                $this->board[$x][$y] = null;
            }
        }
    }
	
	function playGame($gamedata)
	{
		if (!$this->isOver() && isset($gamedata['move'])) {
			$this->move($gamedata);
        }
			
		if (isset($gamedata['newgame'])) {
			$this->newGame();
        }
				
		$this->displayGame();
	}
	
	function displayGame()
	{
		
		if (!$this->isOver())
		{
			echo "<div id=\"board\">";
			
			for ($x = 0; $x < 3; $x++)
			{
				for ($y = 0; $y < 3; $y++)
				{
					echo "<div class=\"board_cell\">";
					
					if ($this->board[$x][$y])
						echo "<img src=\"images/{$this->board[$x][$y]}.jpg\" alt=\"{$this->board[$x][$y]}\" title=\"{$this->board[$x][$y]}\" />";
					else
					{
						echo "<select name=\"{$x}_{$y}\">
								<option value=\"\"></option>
								<option value=\"{$this->player}\">{$this->player}</option>
							</select>";
					}
					
					echo "</div>";
				}
				
				echo "<div class=\"break\"></div>";
			}
			
			echo "
				<p align=\"center\">
					<input type=\"submit\" name=\"move\" value=\"Zatwierdź\" /><br/>
					</br>
					<b>Kolej gracza {$this->player}.</b></p>
			</div>";
		}
		else
		{
			
			if ($this->isOver() != "Tie")
				echo successMsg("Gratulacje! Gracz " . $this->isOver() . ", wygrał!");
			else if ($this->isOver() == "Tie")
				echo errorMsg("Remis! Czy chcesz ponownie rozpocząć grę?");
				
			session_destroy(); 
				
			echo "<p align=\"center\"><input type=\"submit\" name=\"newgame\" value=\"Nowa gra\" /></p>";
		}
	}
	
	function move($gamedata)
	{			

		if ($this->isOver())
			return;
	
		$gamedata = array_unique($gamedata);
		
		foreach ($gamedata as $key => $value)
		{
			if ($value == $this->player)
			{	
				$coords = explode("_", $key);
				$this->board[$coords[0]][$coords[1]] = $this->player;

				if ($this->player == "X")
					$this->player = "O";
				else
					$this->player = "X";
					
				$this->totalMoves++;
			}
		}
	
		if ($this->isOver())
			return;
	}
	
	function isOver()
	{
		
		if ($this->board[0][0] && $this->board[0][0] == $this->board[0][1] && $this->board[0][1] == $this->board[0][2])
			return $this->board[0][0];
			
		if ($this->board[1][0] && $this->board[1][0] == $this->board[1][1] && $this->board[1][1] == $this->board[1][2])
			return $this->board[1][0];
			
		if ($this->board[2][0] && $this->board[2][0] == $this->board[2][1] && $this->board[2][1] == $this->board[2][2])
			return $this->board[2][0];
			
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][0] && $this->board[1][0] == $this->board[2][0])
			return $this->board[0][0];
			
		if ($this->board[0][1] && $this->board[0][1] == $this->board[1][1] && $this->board[1][1] == $this->board[2][1])
			return $this->board[0][1];
			
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][2] && $this->board[1][2] == $this->board[2][2])
			return $this->board[0][2];
			
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2])
			return $this->board[0][0];
			
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0])
			return $this->board[0][2];
			
		if ($this->totalMoves >= 9)
			return "Tie";
	}
}