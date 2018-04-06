<?php
/*
	08/08/2013 SJG CALI Time Trial Game fuse
	Handle retrieving leader board, user info and saving score

	Get scores, position of user's score and user id
	?cmd=scores&score=999
	
	04/06/2018 Rolling 6 month high score.

*/

	define('TOP_SCORES',5); // Number of top scores to show
	define('NEAREST_SCORES',3); // Number of nearest scores to 'score'.
	define('SCORE_MONTHS' ,6);	// Only scores in past N months are included (current date - N months)
			 
	$result=array();
	$result["ver"]="2017-06-05 10:34";
	///error_reporting(E_ALL);
	require "config.php";


	// #############################################	
	if (isset($_REQUEST['u'])) // u)ser info requested
	{
		//	08/07/2013 SJG Pluck out Drupal userid from session
		// If user not signed in, userid will be 0.
		
		// Set the working directory to your Drupal root
		chdir(DRUPAL_ROOT_DIR);
		define('DRUPAL_ROOT', getcwd());
		
		// Require the bootstrap include
		require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
		
		//Load Drupal
		drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);
		//Full load not needed for just user info

		
		// Output user id so the game can do auto save score without login prompts.
		$result['userid']=$user->uid;//echo "\nvar userid=".$user->uid.";\n";
		$result['username']=$user->name;//echo "\nvar username=".json_encode($user->name).";\n";
		// Can also get CALI Staff, facstaff, student roles here.
		if (isset($_REQUEST['d']))
		{
			var_dump($result);
		}
	}
	
	$score = intval($_REQUEST['s']);
	
	// #############################################	
	if (isset($_REQUEST['r']) && $result['userid']>0) // r)ecord s)core and n)ickname
	{	// Record user's score, n=nick name, user'd id
		$uid = $result['userid'];
		$nick = $mysqli->real_escape_string($_REQUEST['n']);
		if ($nick=='') $nick='Anonymous';
		$sql="delete from scores where uid=$uid and score<=$score limit 3";
		if ($res=$mysqli->query($sql)){}
		$sql="insert into scores (uid,score,nick) values (".($uid).", ".$score.",'".($nick)."')";
		if ($res=$mysqli->query($sql)){}
	}
		
		
	// #############################################	
	if (isset($_REQUEST['l'])) // l)eader board scores
	{	// Collect all scores since we want position and don't know where user's score fits.
		//$res=$mysqli->query("select score,nick,timestamp from scores order by score desc");
		$res=$mysqli->query('select score,nick,timestamp from scores  where timestamp >= now()-interval '.SCORE_MONTHS.' month order by score desc');
		$pos=0;
		while($row=$res->fetch_assoc())
		{
			$pos++;
			$scores[]=array("pos"=>($pos), "show"=>($pos <=TOP_SCORES)?1:0,"score"=> $row['score'], "nick"=> $row['nick'],"when"=>$row['timestamp']);
		}
		if (isset($_REQUEST['d']))
		{
			var_dump($res);
			var_dump($scores);
		}
		// Show closest n scores to user's SCORE.
		if ($score>0)
		{	// e.g., SQL: select score  from scores  order by abs(score-100)  limit 5
			//$res=$mysqli->query('select score from scores order by abs(score-'.intval($score).') asc limit '.NEAREST_SCORES);
			$res=$mysqli->query('select score from scores where timestamp >= now()-interval '.SCORE_MONTHS.' month order by abs(score-'.intval($score).') asc limit '.NEAREST_SCORES);
			$counter=0;
			while($row=$res->fetch_assoc())
			{
				$score = $row['score'];
				foreach($scores as &$rec)
				{
					if ($rec['score']==$score && $counter<NEAREST_SCORES)
					{
						$rec['show']=1;
						$counter++;
					}
				}
				unset($rec);
			}
			if (isset($_REQUEST['d']))
			{
				print_r($scores);
			}
		}
	
		// Forget all scores that aren't top or near user's.
		foreach($scores as $index => &$rec)
		{
			if ($rec['show']!=1) unset($scores[$index]);
		}
		unset($rec);
		$result['scores']=$scores;
	}
	
	
	// #############################################	
	if (isset($_REQUEST['p'])) // p)retty print results table
	{
		echo '<table uid='.$result['userid'].'>';
		echo '<tr><th>Rank</th><th>Score</th><th>Player</th></tr>';
		foreach($scores as $rec)
		{
			echo '<tr><td>#'.$rec['pos'].'</td><td>'.number_format($rec['score']).'</td><td>'.stripslashes($rec['nick']).'</td></tr>';
		}
		echo '</table>';
	}
	else
	{
		echo json_encode($result);
	}

?>


