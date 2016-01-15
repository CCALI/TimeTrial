<!DOCTYPE HTML >
<!--
	CALI Time Trial 1.1.0.7
	All Contents Copyright The Center for Computer-Assisted Legal Instruction
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CALI Time Trial</title>

<script src="jquery-1.9.1.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script xsrc="jquery.ui.ipad.js" type="text/javascript"></script>
<script src="jquery.ui.touch-punch.js" type="text/javascript"></script>

<script xsrc="http://code.jquery.com/jquery-1.9.1.js"></script>
<script xsrc="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<script>
// 2013-03-13 SJG
// 2013-05-10
// 2013-06-07 QR code start mode
// 2013-08-08 Leaderboard
// 2014-01-01 Loading 400 cards
// 2015-05-07 Loading 600 cards

var DISPCARDS= 5 ; // max cards on a row, more cards, harder
var STACKCARDS = 10; // cards per stack, each new stack increases point value bonus
var played=1;// number of cards played
var correct=1;// number of cards played correctly
var score=100;// current score
var hiscore=score;
var level = 0;// current level
var pointValue=0;// current card point value
var uid=0; // user id
var ncards;

var ci=0;
var _NUM=0;_YEAR=1;_INFO=4;
var prevScore=0;
var prevHiScore=0;
var prevPointValue=0;
var report="";
var DEL=" &#9830; ";
var gameOn=true;

function getLeaderBoard() {
	var lburl='CALITimeTrial_WS.php?'
		+'u&l&s='+score+'&p&'+ ($('#savecb')[0].checked?'r':'')+'&n='+escape($('#savenick').val());
	console.log(lburl);
	$('#leaderboard').load(lburl, function() {
		uid = $('#leaderboard table').attr('uid');
		$('.signedin').toggle(uid>0);
		$('.signedout').toggle(uid==0);
	});
}

$(document).ready(function(){
	
	if (window.location.search=='?pool')
		{ pool();return; }
	
	 
	hiscore=parseInt(localGet('hiscore',hiscore));
	
	setInterval(interval,100);

	reshuffle();
	
	getLeaderBoard();
	$('#leaderboard').click(function(){
		$('#leaderboard table').fadeOut(1);
		getLeaderBoard();
	});
	
	$('#savecb').click(function(){
		$('.savename').toggle($('#savecb')[0].checked);
	});
	
	$('#musicToggle').click(function(){
		var music=$('#music')[0];
		if (music.play) {
			if (music.paused==false)
			{
				music.pause();
				$('#musicToggle').removeClass('musicOn').addClass('musicOff');
				localSet('music',0);
			}
			else
			{
				music.play();
				$('#musicToggle').removeClass('musicOff').addClass('musicOn');
				localSet('music',null);
			}
		}
	});
	if( localGet('music',1)==0){//localStorage && localStorage.music && localStorage.music==0 ){
		$('#music')[0].pause();
		$('#musicToggle').removeClass('musicOn').addClass('musicOff');
    } 
	
	$('#helpToggle').click(function(){
		$('.help').fadeToggle();
	});
	$('.help').click(function(){
		$('.help').fadeOut();
	});
	
	$( "#sortable2" ).sortable({
		connectWith: ".connectedSortable"
		
	}).disableSelection();
	$( "#sortable1" ).sortable({
		connectWith: ".connectedSortable",
		//revert: true,
		activate:function (event,ui)
		{
			ui.item.removeClass('zoomed');
		},
		
		update: function( event, ui )
		{
			revealCard(ui.item);
			var isCurCard = (ui.item.data('index') == ci);
			var firstNum=99999;
			var goodOrder=true;
			var lastYear=0;
			$('#sortable1 li.card').each(function()
			{
				var num=$(this).data('index');
				var year=parseInt($(this).data('card')[_YEAR]);
				if (year<lastYear){
					goodOrder=false;
					$(this).addClass('wrong');
				}
				else{
					$(this).removeClass('wrong');
				}
				lastYear=year;
				if (num<firstNum){firstNum=num;first=this;}
			});
			if (isCurCard)
			{
				played++;
				if (goodOrder)
				{
					score  += Math.round(pointValue);
					
					if (score>hiscore) {
						hiscore = score;
						localSet('hiscore',hiscore);
					} 
		
					
					correct++;
				}
				else
				{
					// Reposition? //ui.item.insertAfter()
				}
				if ($('#sortable1 li.card').length >= DISPCARDS)
				{	// Remove oldest card so we don't run out of room.
					$(first).animate({top:'-250px'},250).queue(function() //.css({xposition:'absolute'})
					{
						$(this).remove();
						nextCard();
					});
				}
				else
				{
					nextCard();
				}
			}
		}
	}).disableSelection();
	
	
});



function numberWithCommas(x) {//http://stackoverflow.com/questions/2901102/how-to-print-a-number-with-commas-as-thousands-separators-in-javascript
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function reshuffle()
{
	ci=0;
	shuffleArray(cards);
	if (QRCodeCard>0)
	{
		for (var c=0;c<ncards;c++)
			if (cards[c][0]==QRCodeCard)
			{
				var qrCard=cards[c];
				cards[c]=cards[0];
				cards[0]=qrCard;
				break;
			}
	}
	addStack();
	//ci++;
	$('#sortable1').empty();
	var $card=makeCard(cards[ci],ci);
	$('#sortable1').append($card);
	fitCardText($card);
	revealCard($card);
	nextCard();
}

function trace(msg)
{
	if (typeof console!=='undefined') console.log(msg);
}
function revealCard($card)
{	
	$('.year',$card).html($card.data('card')[_YEAR]);
	$('.info',$card).html($card.data('card')[_INFO]);
}
function gameOver()
{
	//gameOn=false;
	alert("Congratulations! You've played all the cards. \n We'll shuffle again and you can keep playing. ");
	
	reshuffle();
	
}
function addStack()
{
	level += 1;
	pointValue = level * 100 + 0.99;
	
	$('.stack').empty();
	for (var c=0;c< STACKCARDS ;c++)
	{
		var $card=$('<li class="card back"></li>');
		$card.css( {position:'absolute', left:c*4 ,top: -220 - c*5});
		$('.stack').append($card);
	}
	
	$('#leaderboard table').fadeTo(0.5,0.5);
	getLeaderBoard();
}
function nextCard()
{
	ci++;
	
	if (ci>=ncards)
	{
		gameOver();
		return;
	}
	
	var $card=makeCard(cards[ci],ci).css({xposition:'absolute',left:'-500px',top:'300px'}).addClass('zoomed').animate( {left:'0px',top:'0px'} ).appendTo('#sortable2').css(
			{
				position:'',left:'',top:''
				//position:'relative',left:'0px',top:'0px'
			});
	
	fitCardText($card);
	
	$('.stack li:last').remove();
	if ($('.stack li').length==0){addStack();}
}

function fitCardText($card)
{	// Try different font sizes for description until we get one that fits nicely.
	var $body = $('.body',$card);
	var $desc = $('.description',$card);
	var pointSize=12 +1;
	var h;
	do {
		pointSize--;
		$desc.css('font-size',pointSize+'pt');
		h=$body.height();
	} while (pointSize>=8 && h>200);
	//$('.year',$card).append(','+h+","+pointSize); //DEBUG
}
function makeCard(card,index)
{
	var $card=$('<li class="card shadow"><div class=year/><div class=number/><div class=body><div class=title/><div class=description/><div class=info/></div></li>');
	$('.number',$card).html(card[_NUM]);
	$('.year',$card).html( 1 ? '?':card[1]);
	$('.title',$card).html(card[2]);
	$('.description',$card).html(card[3]);
	$('.info',$card).html('?');
	
	
	$card.data('card',card);	
	$card.data('index',index);
	return $card;
}

function localGet(id,defVal)
{
	if (localStorage && localStorage.getItem(id)){
		return localStorage.getItem(id);
	}
	else{
		return defVal;
	}
}
function localSet(id,val)
{
	if (localStorage)
	{
		if (val==null){
			localStorage.removeItem(id);
		}
		else{
			localStorage.setItem(id,val);
		}
	}
}

function interval()
{
	if (!gameOn) return;
	if (pointValue>1)
	{
		pointValue -= 0.1 * level;
		if (pointValue<1)
		{
			pointValue=1;
		}
	}
	
	
	if (prevScore!=score)
	{
		prevScore += (score - prevScore) * 0.5;
		$('#score').text( numberWithCommas(Math.round(prevScore)) );
	}
		
	if (prevHiScore != hiscore)
	{
		prevHiScore += (hiscore - prevHiScore) * 0.5;
		$('#hiscore').text(numberWithCommas(Math.round(prevHiScore))); 
	}
	
	
	if (prevPointValue!=pointValue)
	{
		prevPointValue = (prevPointValue + pointValue) * 0.5;
		$('#pointValue').html( 'Level: ' + level + '<br/>' + '+' + numberWithCommas(Math.floor(prevPointValue)));
	}
	report1 = "Cards played: "+(played)+DEL+"Correctly positioned: "+(correct)+DEL+"Level:"+level+DEL+"Points: +"+numberWithCommas(Math.floor(pointValue))+DEL+"Cards left: "+(ncards-ci);
	if (report1!=report)
	{
		report=report1;
		$('#report').html(report);
	}
}

// Greetings, curious one. All the card info is right here in this giant JavaScript array. But there's also a source CSV file. If you want it just ask jmayer@cali.org.
<?php
	// Load data from spreadsheet, ignore comment lines (non Year in first column) or any rows with any blank column.
	// Stuff into a simple Javascript array of arrays. 
	
	if (1){
		// Load from local test file (for testing with fixed data set)
		$csv="CALITimeTrialGameData1-600.csv";//"CALITimeTrialGameData.csv"; 	
	}else{
		// Load data from google spreadsheet
		//5/9/13 this format is now wrong: $csv="https://docs.google.com/spreadsheet/pub?key=0AkLP3h1Q8BaAdFd1QlNvSE9rZVhFY1QyV0J1RlRWUHc&single=true&gid=0&output=csv";
	}
	$jsdata="";
	if (($handle = fopen($csv, "r")) !== FALSE)
	{
		$counter=-2;
		while (($row = fgetcsv($handle, 1000, ",",'"')) !== FALSE)
		{
			$counter++;
			//if ($counter==20) break;// Cheap way to test full deck to completion by making a small deck.
			
			$year=$row[ 4 ];
			if (intval($year)>0){
				
				//echo implode(",",$row)."\n";
				/*$jsrow='';
				for ($c=0; $c < count($row); $c++)
				{
					if ($c>0) $jsrow.=',';
					$jsrow.=json_encode($row[$c]);
				}
				if ($jsdata!='') $jsdata.=",\n";
				*/
				// Pluck out CSV data into friendly named variables.
				$cardid=$row[0];
				$title=htmlentities($row[1]);
				$series=$row[2];
				$text=htmlentities($row[3]);
				$year2=$row[5];
				$president=htmlentities($row[6]);
				$case1=htmlentities($row[7]);
				$case2=htmlentities($row[8]);
				$case3=htmlentities($row[9]);
				$citation=htmlentities($row[10]);
					
					
				// Construct card-friendly data fields to stick into the JS data array.
				// Yes I know a cheater can look at source and get the answers. :D
				switch ($series){
					case 'Justice':
						$description=$text;
						// Construct list of cases, since there may be 1, 2 or 3, add the LI tag only if there's actual case to avoid empty bullets.
						$description.='<ul><li>'.$case1.'</li>'
							.(($case2!='')?'<li>'.$case2.'</li>':'')
							.(($case3!='')?'<li>'.$case3.'</li>':'')
							.'<li>Appointed by '.$president.'</li>'
							.'</ul>';
						//$description.='<p>Appointed by '.$president.'</p>';
						$details='Served '.$year.'-'.$year2;
						break;
						
					case 'Public Law':
						$description=$text;
						$details=$year;
						break;
					
					case 'SCt Case':
						$description=$text;
						$details=$citation; 
						break;
					
					case 'Amendment':
						$description=$text;
						$details=$title.' ('.$year.')'; 
						break;
					
					case 'People':
						$description=$text;
						$details='';
						$details.=' '.$year.'-'.$year2;// 2016-01-15 year1/year2 are born/death years, not Served as is for Justices.
						break;
										
					case 'Documents': // Teatisses and documents treated same
					case 'Treatises':
						$description=$text;
						$details='';
						$details.=''.$year.($year2!='' ? '-'.$year2 : '');
						$details.='   '.$citation; 
						break;
					 
						
					case 'Decades':
						$description=$text;
						$details='';
						break;
					
					default:
						$description=$text;
						$details='';
						echo "<h1>Unknown Series $series. }}}}";
				}
				//$cardid=$counter;

				
				$jsrow=json_encode($year).','.json_encode($title).','.json_encode($description).','.json_encode($details);
				if ($jsdata!='') $jsdata.=",\n ";//",\n";
				$jsdata.='['.$cardid.','.$jsrow."]";
			}
		}
		fclose($handle);
		// TESTING DATA! Add filler fake data so we have something to work with
		if ( 0 )
		{
			$ATLEAST= 50;
			while ($counter<$ATLEAST)
			{
				$counter++;
				$year = 2013 - $ATLEAST + $counter;//rand(1800,2012);
				$case = "Case X v ".$counter;
				if ($jsdata!='') $jsdata.=",\n";
				$very="";
				for ($i=0;$i<rand(1,20);$i++)
					$very.="very, ";
				$extra="This was a $very very interesting case.";
				$jsdata.='['.$counter.','.$year.','.json_encode($case).','.json_encode("Description of filler case $case which happened in year $year. $extra").','.json_encode($case." ($year)")."]";
			}
		}
	}
	echo 'var cards=['.$jsdata."];\n";
	
	echo 'var QRCodeCard='.intval($_GET['card']).';';
?>

ncards=cards.length;

function pool()
{	// Show all cards - hope you're not cheating :)
	
	$('#music')[0].pause();
	$('.help').hide();
	$('.pool').show();
	var c;
	var COLS=5;
	for (c=0;c < ncards;c++)
	{
		var $card = makeCard( cards[c % (ncards+1)],-1);
		revealCard($card);
		var row=Math.floor(c/COLS);
		$card.css( {position:'absolute', left:(c % COLS)*190,top:row*200 + c*15 +140});
		$('.pool').append($card);
		fitCardText($card);
	}
	
}
/**
 * Randomize array element order in-place.
 * Using Fisher-Yates shuffle algorithm.
 */
function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}
</script>
<style>
html, body {
	margin: 0px;
	padding: 0px;
	color: #fff;
	font-family: "Times New Roman", Times, serif;
	overflow: hidden;
}
.board {
	position: fixed;
	width: 100%;
	height: 100%;
	margin: 0px;
	border: 10px;
	padding: 0px;
	border-color: #f00;
	background-color: #030;
	background-image: url('CALITimeTrialBG.jpg');
	background-size: cover;
	overflow: hidden;
}
.pool {
	position: fixed;
	left: 0;right:0; top:0;bottom:0;
	overflow:  scroll;
	display: none; 
}
.stack {
	position: fixed;
	bottom: 5px;
	left: 5px;
}
.logo {
	background-image: url('CALITimeTrialLogo.png');
	background-size: contain;
	position: absolute;
	width: 500px;
	height: 40px;
	left:10px;
	top:2px;
}
.pulse {
	color: yellow;
	font-size: 135px;
}
#pointValue {
	position: fixed;
	bottom: 105px;
	left: 255px;	
	font-size: 35px;
	font-weight: bold;
	color: yellow;
	text-shadow: #000;
}
#report {
	position: fixed;
	bottom: 1em;
	left: 5%;
	right: 5%;
	font-size: 12px;
	text-align: center;
	color: #ddd;
	text-shadow: 1px 1px #000;
}
#musicCredit {
	font-size: 12px;
	text-align: center;
	color: #fff;
}
#musicToggle {
	position: fixed;
	right: 3px;
	bottom: 10px;
	width: 32px;
	height: 32px;
	cursor: pointer;
}
.musicOn {
	background-image: url('music_on.png');	
}
.musicOff {
	background-image: url('music_off.png');	
}
#helpToggle {
	position: fixed;
	right: 43px;
	bottom: 14px;
	font-size: 32px;
	width: 32px;
	height: 32px;
	cursor: pointer;
}
.help {	
	position: absolute;
	width: 33%;
	font-size: 20px;
	top: 40px;
	left: 2em;
   background-color: rgba(0,0,0,.75);
	cursor: pointer;
	padding: 1em;
}
.close {
	position: absolute;
	right: 4px;
	top: 4px;
}
.noselect {
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

#sortable1, #sortable2 {
	text-align: center;
	line-height: 1em;
	vertical-align: middle;
	word-spacing: nowrap;
	padding: 0px;
	margin: 0px;
	height: 250px;
	position: absolute;
	xbackground-color: #f00;
	xoverflow: hidden;
	
}
#sortable1 {
	top: 50px;
	left: 10px;
	right: 10px;
	min-width: 1024px;
}
#sortable2 {
	top: 330px;
	left: 150px;
	right: 150px;
	left: 20px;
	right: 20px;
}
.skipzoomed {
	-moz-transform: scale(1.5);
	zoom: 1.5;
}
.card {
	text-align: left;
	cursor: move;
	list-style-type: none;
	xposition: absolute;
	position: relative;
	display:  inline-block;
	width: 180px;
	height: 250px;
	overflow: hidden;
	background-color: #fff;
	-moz-border-radius:5px;
	border-radius:5px;
	border-color: #000;
	border-width: 1px;
	border-style: solid;
	padding: 0px;
	margin: 5px;
	color: #000;
}
.back {
	cursor: default;
	background: none;
	background-image: url('CALITimeTrialCardFront.png');
	background-size: cover;
	border: none;
}
.wrong {
	background-color: #f88;
}
.card .year {
	padding: 4px;
	line-height: 1em;
	color: #ab7c4f;
	font-size: 22px;
}
.card .title {
	padding: 4px;
	padding-bottom: 8px;
	padding-left: 4px;
	padding-top: 4px;
	line-height: 1em;
	color: #fff;
	font-style: normal;
	background-color: #ab7c4f;
	font-size: 17px;
}
.card .body {
	padding:2px;
	line-height: 1em;
	padding: 1px;
}
.card .description {
	line-height: 1em;
	color: #000;
	font-size: 12px;
	padding-top: 4px;
	padding-bottom: 4px;
	padding-left: 4px;
	padding-top: 4px;
}
.card .description * {
	margin-top: 1px;
	margin-bottom: 1px;
	padding-top: 1px;
	padding-bottom: 1px;
}
.card .description ul {
	padding-left: 2em;
}
.card .description ul li {
	font-size: smaller;
	line-height: 1em;
	color: #ab7c4f;
}
.card .info {
	line-height: 1em;
	position: absolute;
	color: #444;
	font-style: italic;
	font-size: 10px;
	bottom: 4px;
}
.card .number {
	position: absolute;
	color: #fff;
	font-style: italic;
	font-size: 10px;
	top: 2px;
	right: 2px;
}
.pool li.card .number {
	color: #800;	
}
.shadow {
	-moz-box-shadow: 3px 3px 4px #000;
	-webkit-box-shadow: 3px 3px 4px #000;
	box-shadow: 3px 3px 4px #000;
}


.score {
	position: absolute;
	right: 10px;
	/*top:2px;*/
	bottom: 50px;
	font-size: 35px;
	font-weight: bold;
	text-shadow: 2px 2px #000;
	text-align:right;
}
.leaderboard {
	text-shadow: 1px 1px #000;
}
.score table {
	width: 100%;
   background-color: rgba(0,0,0,.2);
}
.signedout {
	width: 100%;
	font-size: 15px;
   background-color: rgba(255,255,255,.2);
	padding: 5px;
}
.score table *,.score .save * {
	font-size: 12px;
}
.score table tr:first-child {
   background-color: rgba(0,0,0,.3);
}
label, input[type=checkbox] {
	cursor: pointer;
}

.save {
	position: absolute;
	bottom: 10px;
	right: 0px;
	z-index:999;
	height: 32px;
}
</style>
</head>
<body >
	
<div class="board">
	<div class="logo">&nbsp;</div>
	<div class="score">Score: <span id="score">.</span><br>
		Hi Score: <span id="hiscore">.</span><br>
		<div class="leaderboard"> <span id="leaderboard">
			<table>
				<tr>
					<th>Rank</th>
					<th>Score</th>
					<th>Player</th>
				</tr>
			</table>
			</span> <br/>
			<div class="save">
				<div class="signedout">If you want to share your scores you'll need to <a href="http://www.cali.org/user/login?destination=timetrial/online/CALITimeTrial.php">login</a> and start over.</div>
				<div class="signedin">
					<input id="savecb" type=checkbox checked=true/>
					<label for="savecb">Save my score</label>
					</input>
					<label for="savenick">as </label>
					<input placeholder="Anonymous"  id="savenick" type="text" maxlength="12" size="12" />
				</div>
			</div>
		</div>
	</div>
	<ul id="sortable1" class="connectedSortable">
	</ul>
	<ul id="sortable2" class="connectedSortable">
	</ul>
	<div class="stack"></div>
	<div id="pointValue"></div>
	<div id="report"></div>
	<div id="helpToggle">?</div>
	<img id="musicToggle" class="musicOn"></img>
	<div class="help">
		<div class="close">X</div>
		<P>Each card represents a significant case, amendment or Supreme Court Justice.
			From the clues on the card determine the year of the case or the year the Justice was first appointed.</P>
		<p>Put the cards into ascending date order from left to right by dragging and dropping them to the left, right or between the cards in the top row. </p>
		<p>If a card turns red you've put it in the wrong spot.
			Shift it to the correct spot before placing the next card. The oldest played card will be discarded once there are five cards in play.
		<P>You start with one card already revealed. Drag the card below to the left or right of the card above. 
			Every ten cards you place increases your points per card, so keep playing.</p>
		<div id="musicCredit" title="Hour Glass">Music by Danielworldmusic LLC</div>
	</div>
</div>
<div class="pool"></div>
<audio id="music"  autoplay loop>
	<source  src="CALI_TimeTrial.mp3" type="audio/mpeg">
	<source  src="CALI_TimeTrial.ogg" type="audio/ogg">
</audio>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-442653-3']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>
