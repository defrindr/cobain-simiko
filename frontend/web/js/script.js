


// function showHide() {
//     $toHide = document.getElementById("toHide");
//     $toShow = document.getElementById("toShow");
//     $("#toShow").removeClass('hidden');
//     $("#toHide").addClass("hidden");
// }

function showCardCaption(image){
	console.log("test");
	// var elemen = image.getElementsByClassName("card-caption");
	// // console.log();
	// elemen.className = elemen[0].className.replace(" hidden","");
}

function prevImages(anu) {
    img = document.getElementById('modImg');
    text = document.getElementById('modalHeader');
    img.src = anu.src;
    text.innerHTML = "<b>" + anu.alt + '</b><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    // alert(1);
    // alert("11");
    // image.src = img.src;

}


$(function(){
	$(document).on('click', '.showModalButton', function(){
		if ($('#modalShow').data('bs.modal').isShown) {
			$('#modalShow').find('#modalContent')
			.load($(this).attr('value'));
			document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
		} else {
			$('#modalShow').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
			document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
		}
	});
});



window.onscroll = function() {
    scrollFunc()
};

function scrollFunc() {
    if (innerWidth > 768) {
        if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
            document.getElementById("navbarHead").style.background = "#316767";
            document.getElementById("navbarHead-collapse").style.border = 0;
        } else {
            document.getElementById("navbarHead").style.background = "transparent";
            document.getElementById("navbarHead-collapse").style.borderBottom = "1px solid #eee";
        }
    }
};
