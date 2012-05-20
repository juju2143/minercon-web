<?php
if(isset($_GET['source'])) die(highlight_file(__FILE__)); // Open source \o/
/*
 *   minercon, a simple interactive Minecraft RCon shell made in PHP
 *   Copyright (C) 2012 Julien "Juju" Savard
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once("MinecraftRcon.class.php");
$rcon = new MinecraftRcon;

// argv and argc
$argv = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", urldecode($_GET['cmd']), 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
$argc = count($argv);
$serv = $_POST['server'];
$pass = $_POST['pass'];
$serverinfo = explode(":", $serv, 2);
$server = $serverinfo[0];
$port = isset($serverinfo[1])?$serverinfo[1]:25575;
try
{
	$rcon->Connect($server, $port, $pass);
}
catch (MinecraftRconException $e)
{
	die($e->getMessage()."<br/>");
}
	$line = $_GET['cmd'];
	if($line === FALSE)
	{
		$rcon->Disconnect();
		echo "<br/>";
		die();
	}
	$result = $rcon->Command($line);
	$result = str_replace("\xa70", "<span class=\"n0\">", $result);
	$result = str_replace("\xa71", "<span class=\"n4\">", $result);
	$result = str_replace("\xa72", "<span class=\"n2\">", $result);
	$result = str_replace("\xa73", "<span class=\"n6\">", $result);
	$result = str_replace("\xa74", "<span class=\"n1\">", $result);
	$result = str_replace("\xa75", "<span class=\"n5\">", $result);
	$result = str_replace("\xa76", "<span class=\"n3\">", $result);
	$result = str_replace("\xa77", "<span class=\"n7\">", $result);
	$result = str_replace("\xa78", "<span class=\"b0\">", $result);
	$result = str_replace("\xa79", "<span class=\"b4\">", $result);
	$result = str_replace("\xa7a", "<span class=\"b2\">", $result);
	$result = str_replace("\xa7b", "<span class=\"b6\">", $result);
	$result = str_replace("\xa7c", "<span class=\"b1\">", $result);
	$result = str_replace("\xa7d", "<span class=\"b5\">", $result);
	$result = str_replace("\xa7e", "<span class=\"b3\">", $result);
	$result = str_replace("\xa7f", "<span class=\"b7\">", $result);
	$result = str_replace("\xa7k", "", $result);
	$result = str_replace("\xa7l", "<span class=\"b\">", $result);
	$result = str_replace("\xa7m", "<span class=\"s\">", $result);
	$result = str_replace("\xa7n", "<span class=\"u\">", $result);
	$result = str_replace("\xa7o", "<span class=\"i\">", $result);
	$result = str_replace("\xa7r", "<span class=\"reset\">", $result);
	$result = str_replace("\n", "<br/>", $result);
	echo $result."<span class=\"reset\">";
	$rcon->Disconnect();
?>
