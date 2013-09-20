<?php
/*
Plugin Name: Народ скаже, як зав'яже!
Plugin URI: http://ged.org.ua/narod-skazhe-jak-zavjazhe/
Description: Це не просто плагін, це надія на цвіт та розвиток українського Wordpressу та блоґґінгу зокрема. Після активації він привітає вас ліричним <cite>Слава Україні!</cite>, та щоразу після оновлення сторінки буде виводити випадковий вислів у правому верхньому кутку адмін панелі.
Author: Варщук Богдан (на основі плаґіну <a href="http://ma.tt/">Hello Dolly</a> від Matt Mullenweg)
Version: 1.5
Author URI: http://ged.org.ua/
*/

// These are the lyrics to Hello Dolly
$lyrics = "Слава Україні! Героям Слава!
Народ скаже, як зав'яже
В своїй хаті своя й правда, і сила, і воля..
Еней був парубок моторний, і хлопець хоч куди козак..
Кохайтеся чорнобриві, та не з москалями!
Я єсть народ, якого Правди сила ніким звойована ще не була!
Мова — це глибина тисячоліть
Слово - срібло, а мовчання - золото
Реве та стогне Дніпр широкий..
Думи мої, думи мої, лихо мені з вами!
Нащо стали на папері сумними рядами?
Нації вмирають не від інфаркту. Спочатку їм відбирає мову
Споконвіку було Слово
Патріотизм — це не любов до ідеї, а любов до вітчизни
Люблять батьківщину не за те, що вона велика, а за те, що своя
Кожному мила своя сторона
Нема на світі України, Немає другого Дніпра
Ще не вмерла України і слава, і воля... 
Можна вибрать друга і по духу брата
Та не можна рідну матір вибирати
Кожен — коваль своєї долі
Я стверджуюсь, я утверждаюсь, бо я живу
Коли в людини є народ, тоді вона уже людина!";

// Here we split it into lines
$lyrics = explode("\n", $lyrics);
// And then randomly choose a line
$chosen = wptexturize( $lyrics[ mt_rand(0, count($lyrics) - 1) ] );

// This just echoes the chosen line, we'll position it later
function hello_dolly() {
	global $chosen;
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_footer action is called
add_action('admin_footer', 'hello_dolly');

// We need some CSS to position the paragraph
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		position: absolute;
		top: 2.3em;
		margin: 0;
		padding: 0;
		right: 10px;
		font-size: 16px;
		color: #d54e21;
	}
	</style>
	";
}

add_action('admin_head', 'dolly_css');

?>