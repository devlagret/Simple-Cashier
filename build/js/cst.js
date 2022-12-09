function autocomplete(inp, arr, btn) {
	console.log('ac called');
	/*the autocomplete function takes two arguments,
	the text field element and an array of possible autocompleted values:*/
	var currentFocus;
	/*execute a function when someone writes in the text field:*/
inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value;
			console.log('click');
			/*close any already open lists of autocompleted values*/
			closeAllLists();
			if (!val) { return false;}
			currentFocus = -1;
			/*create a DIV element that will contain the items (values):*/
			a = document.createElement("small");
			a.setAttribute("id", "nm-prd");
			//a.setAttribute("role", "button");
			a.setAttribute("class", "autocomplete-items text-muted ");
			
			/*append the DIV element as a child of the autocomplete container:*/
			this.parentNode.appendChild(a);
			/*for each item in the array...*/
			for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("button");
					b.setAttribute("class", "m-1 kh");
			b.setAttribute("tabindex", "2");

					/*make the matching letters bold:*/
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += '<input type="hidden" value="' + arr[i] + '">';
					/*execute a function when someone clicks on the item value (DIV element):*/
							b.addEventListener("click", function(e) {
							/*insert the value for the autocomplete text field:*/
							inp.value = this.getElementsByTagName("input")[0].value;
							/*close the list of autocompleted values,
							(or any other open lists of autocompleted values:*/
							closeAllLists();
					});
					a.addEventListener("keypress", function(e) {
						if (event.key === "Enter") {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.getElementsByTagName("input")[0].value;
						document.getElementById("jumlah").focus();
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();}
				});
					a.appendChild(b);
				}
			}
});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				}
			}
});
function addActive(x) {
		/*a function to classify an item as "active":*/
		if (!x) return false;
		/*start by removing the "active" class on all items:*/
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
		/*add class "autocomplete-active":*/
		x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
		/*a function to remove the "active" class from all autocomplete items:*/
		for (var i = 0; i < x.length; i++) {
		x[i].classList.remove("autocomplete-active");
	}
}
function closeAllLists(elmnt) {
		/*close all autocomplete lists in the document,
		except the one passed as an argument:*/
		var x = document.getElementsByClassName("autocomplete-items");
		for (var i = 0; i < x.length; i++) {
			if (elmnt != x[i] && elmnt != inp) {
			x[i].parentNode.removeChild(x[i]);
		}
	}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
		closeAllLists(e.target);
});
}
$(document).ready(function(){

$('.txt.form-control').on('keydown', function () {
//console.log('transfgorm');
	let entered = $(this).val();
	let firstLetter = entered.charAt(0).toUpperCase();
	let rest = entered.substring(1);
	$(this).val(firstLetter + rest);
});
});
//function tambahksr(inp,btn){
//	inp.addEventListener("", function (e) {
//if(inp >= 0){
//console.log("input kosong");
//const isDisable = btn.hasAttribute("disabled");
//if(!isDisable) {
//btn.setAttribute('disabled','true');
//console.log("button has ben disabled");
//}
//}else{
//	console.log("input ada");
//	btn.removeAttribute("disabled");
//}});
//}


const inpt = document.getElementById("kd-prd-txt");
var aryk = [];
function setdata(arr){
arry = arr;
}
function setkode(arr){
	aryk = arr;
}
function changeType() {
	var cb = document.getElementById("select_metode");
	var txt = document.getElementById("kd-prd-txt");
	var val = cb.value; 
	if (val == 'nama'){
		//console.log(arry);
		autocomplete(inpt, arry);
	}else if (val == 'kode'){
		//console.log(aryk);
		autocomplete(inpt, aryk);
	}

	console.log("dash-"+val);
	
}
function tambah() {
	var produk = document.getElementById("kd-prd-txt").value;
	var jumlah = document.getElementById("jumlah").value;
	
	if (produk, jumlah == "") {
	
		window.location.replace("http://localhost/kasir/view/kasir?info=noinput");
	}else{
		document.getElementById("frm-ksr").submit();
	}
}
function byrr() {
	console.log("bayar clicked");
	var total = document.getElementById("total");
	var bayar = document.getElementById("jumlah-byr");
	if(total.value > bayar.value ) {
		console.log("uang kurang");
		window.location.replace("http://localhost/kasir/view/kasir?info=uangkurang&uang="+bayar.value+"&fjs");

	}else {console.log("uang cukup");
	document.getElementById("frm-ksr-byr").submit();
}

}


