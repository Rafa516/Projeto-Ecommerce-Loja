
	/*lightbox das imagens*/

	$(document).ready(function() {

	  $('.image-link').magnificPopup({
	  	type:'image',
	  	gallery:{enabled:true}
	  });
	  

	});

		/*scroll imagens*/
		var scrollAtual = 0;
		$('#tras, #frente').click(fazerScroll);

		
			function fazerScroll(e) {
			    var direcao = e.target.id == 'frente' ? 1 : -1;
			if(direcao != 0){
			    $('#fotos').animate({
			        scrollLeft: scrollAtual += 100 * direcao
			    }, 100);
			}
		}
			
	    

