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
	

	public function ListCombinations()
	{

	echo $this->toTable($this->getTableValues($this->NumberOfGames));

	}
	public function getTableValues($count) {
		if (1 === $count) {
			// Win(1) and Draw(0)or Away Win(1) for the first variable
			return array(array('1'), array('0'), array('-1'));
		}   
		$wins = $aways = $draws = $this->getTableValues(--$count);
		for ($i = 0, $total = count($wins); $i < $total; $i++) {
			// the Win copy gets a 1 added to each row
			array_unshift($wins[$i], '1');
			// and the away win copy gets a -1
			array_unshift($aways[$i], '-1');
			// and the away win copy gets a 0
			array_unshift($draws[$i], '0');
		}   

		// combine the 1 and 0 and -1 copies to give this variable's output
		return array_merge($wins, $aways,$draws);
	}

	public function toTable(array $rows) {
		$return = "<table>\n";
		$headers = range('A', chr(64 + count($rows[0])));
		$return .= '<tr><th> Game ' . implode('</th><th> Game ', $headers) . "</th></tr>\n";

		foreach ($rows as $row) {
			
			$return .= '<tr><td>' . implode('</td><td>', $row) . "</td></tr>\n";
			
		}

		return $return . '</table>';
		
	}
}

$FootballCombinator = new FootballCombinator();
$FootballCombinator->ListCombinations();
?>