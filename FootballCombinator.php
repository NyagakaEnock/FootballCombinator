<!DOCTYPE html>
<html>
<title>Football Combinator</title>
<meta name="robots" content="noindex, nofollow">
<body>
<form method="post" action="FootballCombinator.php" id="shortener">
<label for="longurl">Enter the No of Games</label>
 <input type="text" name="NumberOfGames" id="longurl">
 <input type="submit" value="Get all Combinations" name="submit">
</form>


</body>
</html>
<?php
class FootballCombinator
{
	/*
	 * FootballCombinator
	 * Copyright (c) 2017 FootballCombinator
	 *
	 * This library is free software; you can redistribute it and/or
	 * modify it under the terms of the GNU Lesser General Public
	 * License as published by the Free Software Foundation; either
	 * version 2.1 of the License, or (at your option) any later version.
	 *
	 * This library is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	 * Lesser General Public License for more details.
	 *
	 * Developer Nyagaka Enock Email:nyagenox@gmail.com
	
	*/
	
	
	//*Specify the No of Games Played
	
	public $NumberOfGames = 2;

	
	public function __construct()
	{

	}
	

	public function ListCombinations($NumberOfGames)
	{

	echo $this->toTable($this->getTableValues($NumberOfGames));

	}
	public function getTableValues($count) {
		if (1 === $count) {
			// Win(1) and Draw(0)or Away Win(1) for the first variable
			return array(array('Win'), array('Draw'), array('Lose'));
		}   
		$wins = $aways = $draws = $this->getTableValues(--$count);
		
		for ($i = 0, $total = count($wins); $i < $total; $i++) {
			// the Win copy gets a 1 added to each row
			array_unshift($wins[$i], 'Win');
			// and the away win copy gets a -1
			array_unshift($aways[$i], 'Draw');
			// and the away win copy gets a 0
			array_unshift($draws[$i], 'Lose');
			
		}   

		// combine the 1 and 0 and -1 copies to give this variable's output
		return array_merge($wins, $aways,$draws);
	}

	public function toTable(array $rows) {
		$counter = 0;
		$return = "<table>\n";
		$headers = range('A', chr(64 + count($rows[0])));
		
		$return .= '<tr><th> Game ' . implode('</th><th> Game ', $headers) . "</th></tr>\n";

		foreach ($rows as $row) {
			$counter = $counter +1;
			$return .= '<tr><td>' .$counter." ". implode('</td><td>', $row) . "</td></tr>\n";
			
		}

		return $return . '</table>';
		
	}
}
	$FootballCombinator = new FootballCombinator();
		if(isset($_POST['submit']))
		{
			
			if($_POST['NumberOfGames']==null)
			{
				$FootballCombinator->ListCombinations($FootballCombinator->NumberOfGames);
			}else if(!is_numeric($_POST['NumberOfGames']))
			{
				echo ("Enter a valid Number");	
			}else
			{				
		$FootballCombinator->ListCombinations($_POST['NumberOfGames']);				
			}
		}else{
		$FootballCombinator->ListCombinations($FootballCombinator->NumberOfGames);	
		}

?>
