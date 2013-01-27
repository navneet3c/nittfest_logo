$(window).load(function(){
	 $counter=0;
$('#logo').jqPuzzle({
	rows:3,
	cols:3,
	hole: 3,
	shuffle: true,
	numbers: false,
	control: {shufflePieces: false,toggleOriginal: false,toggleNumbers: false, counter:true,timer: false},
	success: {fadeOriginal: true,callback: function(){

		alert("Congrats!");
		$('.jqPuzzle').replaceWith('<img src="images/poster.jpg" style="display: none; position: relative; z-index:25" alt="postertest"  id="poster"> <img src="images/logo.jpg" style="display: none; position: relative; z-index:25" alt="logotest"  id="logo">');
		$('#giveup').fadeOut('fast');
		$('#toptext').css('display','none');
			$('#logo').fadeIn('slow')
			window.setTimeout(function(){$('#logo').css('display','none'); $('#poster').fadeIn('slow')},5000);

	},callbackTimeout: 0},
	style:{gridSize:0,backgroundOpacity: 0.1}
	})
	$('#giveup').fadeIn('fast');
	$('#giveup').click(function(){
		$('#giveup').fadeOut('fast');
			$('.jqPuzzle').replaceWith('<img src="images/poster.jpg" style="display: none; position: relative; z-index:25" alt="postertest"  id="poster"> <img src="images/logo.jpg" style="display: none; position: relative; z-index:25" alt="logotest"  id="logo">');
			$('#toptext').css('display','none');
			$('#logo').fadeIn('slow')
			window.setTimeout(function(){$('#logo').css('display','none'); $('#poster').fadeIn('slow')},5000);
		})
		/*window.setTimeout(function(){
			first=1
	$('#logopuzzle .jqp-piece').mouseup(function(){
			$counter++;

	if($counter>20 && first){
		first=0;
		$('#giveup').fadeIn();t=1;
x=window.setInterval(function(){
	if(t){
		t=0;
		$('#giveup').animate({'width':'110px'},1000);
	}else{
		t=1;
		$('#giveup').animate({'width':'100px'},1000);
	}
	},1010);

	}
	})} ,600)*/

});
