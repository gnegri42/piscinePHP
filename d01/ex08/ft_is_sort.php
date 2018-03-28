<?php
function ft_is_sort($tab)
{
	$tmp_tab = $tab;
	sort($tmp_tab);
	$result = array_diff_assoc($tmp_tab, $tab);
	if ($result == NULL)
		return (true); 
	else
		return (false);
}
?>