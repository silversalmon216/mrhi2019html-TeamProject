slider.php

<style>

	* {

		margin:0px;

		padding:0px;

	}



	/* 애니메이션 캔버스 */

	.animation_canvas  {

		overflow:hidden;

		position:relative;

		float:left;

		width:100%;

	}

	

	.slide_section {

		position:absolute;

	}

	

	#leftMove {

		top:50%;

		left:2%;

	}



	#rightMove {

		top:50%;

		left:96%;

	}



	.move_arrow {

		display:table-cell;

		vertical-align:middle;

	}



	/* 슬라이드 패널 */

	.slider_panel {

		width:calc(800px * 5);	/* 사용할 크기 x 갯수 */

		position:relative;

	}



	/* 슬라이드 이미지 */

	.slider_image {

		float:left;

		width:800px;

	}



	/* 슬라이드 텍스트 패널 */

	.slider_text_panel {

		position:absolute;

		top:10%;

		left:10%;

	}

	

	.slider_text {

		position:absolute;

		width:250px;

		height:150px;

	}



	.slider_text > h1 {

		background-color:#FFFFFF;

		opacity:0.5;

		margin:0px;

		padding:0px;

	}



	.slider_text > p {

		background-color:#C0C0C0;

		opacity:0.5;

		margin:0px;

		padding:0px;

	}



	/* 컨트롤 패널  */

	.control_panel  {

		position:absolute;

		overflow:hidden; 

		top:90%; 

		left:45%;

	}



	.control_button {

		font-size:11px;

		width:13px;

		height:13px;

		border:1px solid #D4D4D4;

		background-color:#F4F4F4;

		position:relative; 

		float:left;

		cursor:pointer;

		margin-left:3px;

		margin-right:3px;

		text-align:center;

		font-weight:bold;

	}



	/* 컨트롤 마우스 오버  */

	.control_button:hover { 

		border:1px solid #F4F4F4;

		background-color:#D4D4D4;

		color:#FFFFFF;

	}

	

	/* 컨트롤 현재 영역  */

	.control_button.active { 

		border:1px solid #24822A;

		background-color:#24822A;

		color:#FFFFFF;

	}

</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>

<script>

jQuery(document).ready(function() {



        // 캔버스 사이즈를 구한뒤 이미지 사이즈를 지정한다. 예제) 800px 이다.

	var canvasSize = jQuery("#canvas").css("width");
	var calcSize = canvasSize.split("px");
	jQuery(".slider_image").css("width", canvasSize);



	// 슬라이드의 전체 개수를 구한다.

	var slideMax = jQuery(".control_button").length;



        // 슬라이드 패널의 실제 이미지 크기를 구한다.

        // 이미지 사이즈 × 이미지의 갯수

        jQuery(".slider_panel").css("width", calcSize[0] * slideMax);



	// 슬라이드 이미지 좌우 이동버튼

	function moveArrow(sum) {



		var num = jQuery(".active").index();

		var index = jQuery(".active").index() + sum;



		if(index < 0) { index = slideMax; }

		if(index >= slideMax) { index = 0; }



		moveSlider(index);

	}



	// 슬라이드를 움직여주는 함수

	function moveSlider(index) {



		// 슬라이드를 이동합니다.

		var willMoveLeft = -(index * calcSize[0]);

		jQuery(".slider_panel").animate({ left: willMoveLeft }, "slow");



		// control_button에 active클래스를 부여/제거합니다.

		jQuery(".control_button[data-index=" + index + "]").addClass("active");

		jQuery(".control_button[data-index!=" + index + "]").removeClass("active");



		// 글자를 이동합니다.

		jQuery(".slider_text[data-index=" + index + "]").show().animate({

			left : 0

		}, "slow");

		jQuery(".slider_text[data-index!=" + index + "]").hide("slow", function() {

			jQuery(this).css("left", -300);

		});

	}



	// 초기 텍스트 위치 지정 및 data-index 할당

	jQuery(".slider_text").css("left", -300).each(function(index) {

		jQuery(this).attr("data-index", index);

	});



	// 좌우 슬라이드 넘김 버튼

	jQuery("#leftMove").on("click", function() { moveArrow(-1) });

	jQuery("#rightMove").on("click", function() { moveArrow(1) });



	// 컨트롤 버튼의 클릭 핸들러 지정 및 data-index 할당

	jQuery(".control_button").each(function (index) {

		jQuery(this).attr("data-index", index);

	}).click(function () {

		var index = jQuery(this).attr("data-index");

		moveSlider(index);

	});



	// 초기 슬라이드의 위치 지정

	var randomNumber = Math.floor(Math.random() * slideMax);

	moveSlider(randomNumber);



	var playAction = "";



	// 5초마다 한번씩 슬라이드를 자동으로 다음 페이지로 넘긴다.

	playAction = setInterval(function() {

		moveArrow(1);

	}, 5000);



	// 마우스가 슬라이드 위에 올라와 있는경우 or 빠져 나간 경우

	jQuery(".slide_board").hover(



		// 마우스가 슬라이드 위에 올라와 있는경우 그 움직임을 멈춘다.

		function() {

			clearInterval(playAction);

		}



		// 마우스가 슬라이드 위에 올라와있다 빠져 나간경우 자동 슬라이드를 초기화 하고 다시 시작한다.

		, function () {

			playAction = setInterval(function() {

				moveArrow(1);

			}, 5000);

		}

	);

});

</script>

<body style="text-align:center;">

	<div class="slide_board">

		<div class="animation_canvas">

			<div class="slider_panel">

				<img class="slider_image" src="./image/album_01.jpg">

				<img class="slider_image" src="./image/album_02.jpg">

				<img class="slider_image" src="./image/album_03.jpg">

				<img class="slider_image" src="./image/album_04.jpg">

				<img class="slider_image" src="./image/album_05.jpg">

			</div>

			<div class="slider_text_panel">

				<div class="slider_text">

					<h1>TWICE</h1>

					<p>JYP Entertainment</p>

				</div>

				<div class="slider_text">

					<h1>Red Velvet</h1>

					<p>SM Entertainment</p>

				</div>

				<div class="slider_text">

					<h1>LOVELYZ</h1>

					<p>Woollim Entertainment</p>

				</div>

				<div class="slider_text">

					<h1>MOMOLAND</h1>

					<p>Duble Kick Company</p>

				</div>

				<div class="slider_text">

					<h1>GFRIEND</h1>

					<p>Source Music Entertainment</p>

				</div>

			</div>

			<div class="control_panel">

				<div class="control_button">1</div>

				<div class="control_button">2</div>

				<div class="control_button">3</div>

				<div class="control_button">4</div>

				<div class="control_button">5</div>

			</div>

		</div>

		<div class="slide_section" id="leftMove">

			<div class="move_arrow">◀</div>

		</div>

		<div class="slide_section" id="rightMove">

			<div class="move_arrow">▶</div>

		</div>

	</div>

</body>