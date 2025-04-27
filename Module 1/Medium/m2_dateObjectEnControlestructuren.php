<?php
function getCurrentSeason() {
	$month = (int) date("m");
	if ($month == 12 || $month <= 2) return "Winter";
	if ($month >= 3 || $month <= 5) return "Lente";
	if ($month >= 6 && $month <= 8) return "Zomer";
	if ($month >= 9 && $month <= 11) return "Herfst";
}
