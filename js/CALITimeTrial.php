<!DOCTYPE HTML >
<!--
	CALI Time Trial 1.0.5
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
// 2013-05-09

var DISPCARDS= 5 ; // max cards on a row, more cards, harder
var STACKCARDS = 10; // cards per stack, each new stack increases point value bonus
var played=1;// number of cards played
var correct=1;// number of cards played correctly
var score=10;// current score
var level = 0;// current level
var pointValue=0;// current card point value

var ci=0;
var _NUM=0;_YEAR=1;_INFO=4;
var prevScore=0;
var prevPointValue=0;
var report="";
var DEL=" &#9830; ";
var gameOn=true;

function reshuffle()
{
	ci=0;
	shuffleArray(cards);
	addStack();
	ci++;
	$('#sortable1').empty();
	var $card=makeCard(cards[ci],ci);
	$('#sortable1').append($card);
	revealCard($card);
	nextCard();
}

$(document).ready(function(){
	
	if (window.location.search=='?pool')
		{ pool();return; }
	
	
	setInterval(function(){
		if (!gameOn) return;
		if (pointValue>1) {
			pointValue -= 0.01 * level;
			if (pointValue<1) {
				pointValue=1;
			}
		}
		if (prevScore!=score)
		{
			prevScore = (score + prevScore) * .5;
			$('#score').text(Math.round(prevScore));
		}
		if (prevPointValue!=pointValue)
		{
			prevPointValue = (prevPointValue + pointValue) * .5;
			$('#pointValue').html( 'Level: ' + level + '<br/>' + '+' + Math.floor(prevPointValue));
		}
		report1 = "Cards played: "+(played)+DEL+"Correctly positioned: "+(correct)+DEL+"Level:"+level+DEL+"Bonus: +"+Math.floor(pointValue)+DEL+"Cards left: "+(ncards-ci+1);
		if (report1!=report){
			report=report1;
			$('#report').html(report);
		}
	},100);

	reshuffle();
	
	$('#musicToggle').click(function(){
		var music=$('#music')[0];
		if (music.paused==false){
			music.pause();
			$('#musicToggle').removeClass('musicOn').addClass('musicOff');
			if (localStorage)
			{
				localStorage.music=0;
			}
		}
		else
		{
			music.play();
			$('#musicToggle').removeClass('musicOff').addClass('musicOn');
			if (localStorage){
				localStorage.removeItem('music');
			}
		}
	});
	if( localStorage && localStorage.music==0 ){
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
			$('#sortable1 > li').each(function()
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
					score  += Math.floor(pointValue);
					correct++;
				}
				else
				{
					// Reposition? //ui.item.insertAfter()
				}
				if ($('#sortable1 li').length>= DISPCARDS)
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
	alert("Congratulations! You've played all the cards.");
	
	reshuffle();
	
}
function addStack()
{
	level += 1;
	pointValue = level * 10 + .99;
	
	$('.stack').empty();
	for (var c=0;c< STACKCARDS ;c++)
	{
		var $card=$('<li class="card back"></li>');
		$card.css( {position:'absolute', left:c*4 ,top: -220 - c*5})
		$('.stack').append($card);
	}
}
function nextCard()
{
	ci++;
	
	if (ci>ncards)
	{
		gameOver();
		return;
	}
	
	makeCard(cards[ci],ci).css({xposition:'absolute',left:'-500px',top:'300px'}).addClass('zoomed').animate( {left:'0px',top:'0px'} ).appendTo('#sortable2').css(
			{
				position:'',left:'',top:''
				//position:'relative',left:'0px',top:'0px'
				});
	
	//$("#sortable1,#sortable2 li").addTouch();
	//$('#sortable2').addClass('zoomed');
	
	$('.stack li:last').remove();
	if ($('.stack li').length==0){addStack();}
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
<?php
	// Load data from spreadsheet, ignore comment lines (non Year in first column) or any rows with any blank column.
	// Stuff into a simple Javascript array of arrays. 
	
	if (1){
		// Load from local test file (for testing with fixed data set)
		$csv="CALITimeTrialGameData.csv"; 	
	}else{
		// Load data from google spreadsheet
		//5/9/13 this format is now wrong: $csv="https://docs.google.com/spreadsheet/pub?key=0AkLP3h1Q8BaAdFd1QlNvSE9rZVhFY1QyV0J1RlRWUHc&single=true&gid=0&output=csv";
	}
	$jsdata="";
	if (($handle = fopen($csv, "r")) !== FALSE)
	{
		$counter=-2;
		while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
		{
			$counter++;
			$year=$row[3];
			if (intval($year)>0){
				
				/*$jsrow='';
				for ($c=0; $c < count($row); $c++)
				{
					if ($c>0) $jsrow.=',';
					$jsrow.=json_encode($row[$c]);
				}
				if ($jsdata!='') $jsdata.=",\n";
				*/
				// Pluck out CSV data into friendly named variables.
				$title=$row[0];$series=$row[1];$text=$row[2];$year2=$row[4];
					$president=$row[5];$case1=$row[6];$case2=$row[7];$case3=$row[8];$citation=$row[9];
					$cardid=$row[11];
					
				// Construct card-friendly data fields to stick into the JS data array.
				// Yes I know a cheater can look at source and get the answers. :D
				switch ($series){
					case 'Justice':
						$description=$text;
						// Construct list of cases, since there may be 1, 2 or 3, add the LI tag only if there's actual case to avoid empty bullets.
						$description.='<ul><li>'.$case1.' '.(($case2!='')?'<li>':'').$case2.' '.(($case3!='')?'<li>':'').$case3.'</ul>';
						$description.='<p>Appointed by '.$president;
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
					
					default:
						$description=$text;
						$details='';
				}
				//$cardid=$counter;
				
				
				$jsrow=json_encode($year).','.json_encode($title).','.json_encode($description).','.json_encode($details);
				if ($jsdata!='') $jsdata.=",\n";
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
	echo 'var cards=['.$jsdata.'];';
?>

var ncards=cards.length-1;

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
		$card.css( {position:'absolute', left:(c % COLS)*190,top:row*200 + c*15 +140})
		$('.pool').append($card);
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
	font-family: "sans-serif, Arial, Verdana, Geneva";
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
	width: 350px;
	height: 40px;
	left:10px;
	top:2px;
}
.score {
	position: absolute;
	right: 10px;
	top:2px;
	font-size: 35px;
	font-weight: bold;
	text-shadow: #000;
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
	left: 20px;
	right: 20px;
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
	padding: 5px;
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
	line-height: 1em;
	color: #800;
	font-size: 22px;
}
.card .body {
	line-height: 1em;
	xbackground-color: #ffe;
	height: 150px;
	padding: 1px;
}
.card .title {
	line-height: 1em;
	color: #000;
	font-style: italic;
	font-size: 17px;
}
.card .description {
	line-height: 1em;
	color: #000;
	font-size: 12px;
	padding-top: 4px;
	padding-bottom: 4px;
}
.description * {
	margin-top: 1px;
	margin-bottom: 1px;
	padding-top: 1px;
	padding-bottom: 1px;
}
.description ul {
	padding-left: 2em;
	font-size: smaller;
}
.description ul li {
	line-height: 1em;
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
	color: #444;
	font-style: italic;
	font-size: 10px;
	top: 2px;
	right: 2px;
}
.shadow {
	-moz-box-shadow: 3px 3px 4px #000;
	-webkit-box-shadow: 3px 3px 4px #000;
	box-shadow: 3px 3px 4px #000;
}
</style>
</head>
<body >
	<div class="board"> 
		<div class="logo">&nbsp;</div>
		<div class="score">Score: <span id="score">0</span></div>
		<ul id="sortable1" class="connectedSortable"></ul>
		<ul id="sortable2" class="connectedSortable"></ul>
		<div class="stack"></div>
		<div id="pointValue"></div>
		<div id="report"></div>
		<div id="helpToggle">?</div>
		<img id="musicToggle" class="musicOn"></img>
<div class="help"><div class="close">X</div>
	<P>Each card represents a significant case, amendment or Supreme Court Justice.
	From the clues on the card determine the year of the case or the year the Justice was first appointed.</P>
	<p>Put the cards into ascending date order from left to right by dragging and dropping them to the left, right or between the cards in the top row.
	</p>
	<p>If a card turns red you've put it in the wrong spot.
	Shift it to the correct spot before placing the next card. The oldest played card will be discarded once there are five cards in play.
	<P>You start with one card already revealed. Drag the card below to the left or right of the card above. 
	Every ten cards you place increases your points per card, so keep playing.</p>
</div>
	</div>
		<div class="pool"></div>
<audio id="music"  autoplay loop>
	<source  src="CALI_TimeTrial.mp3" type="audio/mpeg">
	<source  src="CALI_TimeTrial.ogg" type="audio/ogg">
</audio>

</body>
</html>