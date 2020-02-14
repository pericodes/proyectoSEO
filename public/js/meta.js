function generateLink(title) {
	let regex = /[^\w]/gm;
	let link = title.value.toLowerCase();
	link = link.trim();
	link = link.replace(/à/gm, 'a'); 
	link = link.replace(/á/gm, 'a'); 
	link = link.replace(/â/gm, 'a'); 
	link = link.replace(/ã/gm, 'a'); 
	link = link.replace(/ä/gm, 'a'); 
	link = link.replace(/å/gm, 'a'); 
	link = link.replace(/æ/gm, 'a'); 
	link = link.replace(/ç/gm, 'c'); 
	link = link.replace(/è/gm, 'e'); 
	link = link.replace(/é/gm, 'e'); 
	link = link.replace(/ê/gm, 'e'); 
	link = link.replace(/ë/gm, 'e'); 
	link = link.replace(/ì/gm, 'i'); 
	link = link.replace(/í/gm, 'i'); 
	link = link.replace(/î/gm, 'i'); 
	link = link.replace(/ï/gm, 'i'); 
	link = link.replace(/ð/gm, 'o'); 
	link = link.replace(/ñ/gm, 'n'); 
	link = link.replace(/ń/gm, 'n'); 
	link = link.replace(/ò/gm, 'o'); 
	link = link.replace(/ó/gm, 'o'); 
	link = link.replace(/ô/gm, 'o'); 
	link = link.replace(/õ/gm, 'o'); 
	link = link.replace(/ö/gm, 'o'); 
	link = link.replace(/ø/gm, 'o'); 
	link = link.replace(/ù/gm, 'u'); 
	link = link.replace(/ú/gm, 'u'); 
	link = link.replace(/û/gm, 'u'); 
	link = link.replace(/ü/gm, 'u');
	link = link.replace(regex, "-").replace(/\-+/gm, "-"); 
	/*while (regex.test(title)) {
		link = link.replace(regex, "-");
	}*/

    let domain = `${_myDomain}/${encodeURI(link)}`;
    generateUrlSnippet(domain);
	document.getElementById("link").value = `https://${domain}`;
	if(title.value.length <= document.getElementById("metaTitle").getAttribute("maxlength")){
		document.getElementById("metaTitle").value = title.value;
	}else{
		document.getElementById("metaTitle").value = title.value.substring(0, document.getElementById("metaTitle").getAttribute("maxlength"));
	}
	progresionBarTitle();

}

function progresionBarTitle() {
    let charactesrs = document.getElementById("metaTitle").value.length; 
    document.getElementById("progressMetaTitle").setAttribute("aria-valuenow", charactesrs);
    document.getElementById("progressMetaTitle").style.width = `${charactesrs/document.getElementById("metaTitle").getAttribute("maxlength")*100}%`;
    document.getElementById("progressMetaTitle").innerHTML = `${charactesrs}/${document.getElementById("metaTitle").getAttribute("maxlength")}`;
    generateTitleData(document.getElementById("metaTitle").value);
}

document.getElementById("metaTitle").addEventListener('keyup', (e)=>{
    progresionBarTitle();
});
document.getElementById("metaDescription").addEventListener('keyup', ()=>{
    let charactesrs = document.getElementById("metaDescription").value.length; 
    document.getElementById("progressMetaDescription").setAttribute("aria-valuenow", charactesrs);
    document.getElementById("progressMetaDescription").style.width = `${charactesrs/document.getElementById("metaDescription").getAttribute("maxlength")*100}%`;
    document.getElementById("progressMetaDescription").innerHTML = `${charactesrs}/${document.getElementById("metaDescription").getAttribute("maxlength")}`;
    generateDescData(document.getElementById("metaDescription").value);
});

function generateDescData(descText) {		
	  document.getElementById("google-desc").innerHTML = getDescSnippet(descText);
	  document.getElementById("desc-status").innerHTML = getMetaDescStatus(descText);
	  document.getElementById("desc-length").innerHTML = getMetaDescWidth(descText);
    document.getElementById("desc-string-length").innerHTML = descText.length; 
}
	
	
function generateTitleData(titleText) {
	document.getElementById("google-title").innerHTML = getTitleSnippet(titleText);
	document.getElementById("title-status").innerHTML = getTitleStatus(titleText);
	document.getElementById("title-length").innerHTML = getTitleWidth(titleText);
  document.getElementById("title-string-length").innerHTML = titleText.length;
}
	
function generateUrlSnippet(urlText) {		
	  document.getElementById("google-url").innerHTML = getUrlSnippet(urlText);
}
																
function getMetaDescStatus(txt) {      
    //var txt = document.getElementById("desc").value; 
    var metaDescWidth = getMetaDescWidth(txt);
    
    var statusText = "";
    var statusMobile = "";
    var statusDesktop = "";
    if (metaDescWidth <= 680){
       statusText = '<span style="font-weight:bold;color:#016717">The meta description can be read everywhere, nice job!';
      statusMobile = '<span style="color:#016717">OK';
      statusDesktop = '<span style="color:#016717">OK';
    }
    else if (metaDescWidth > 680 && metaDescWidth < 720 ){
      statusText =  '<span style="font-weight:bold;color:#016717">The meta description will not be fully shown on some mobiles.';
      statusMobile = '<span style="color:#e28801">The majority is OK, smaller devices are NOT';
      statusDesktop = '<span style="color:#016717">OK';
    }                                                        
    /*else if (metaDescWidth >= 840 && metaDescWidth < 980 ){
      statusText =  '<span style="font-weight:bold;color:#e28801">The meta description will not be fully shown on mobiles.';
      statusMobile = '<span style="color:#bd0000">Not displayed the whole meta description';
      statusDesktop = '<span style="color:#016717">OK';
    }*/
    else if (metaDescWidth >= 720 && metaDescWidth < 920 ){
      statusText =  '<span style="font-weight:bold;color:#e28801">The meta description will be fully shown on desktop on Google, Bing, Yahoo.';
      statusMobile = '<span style="color:#bd0000">Not displayed the whole meta description';
      statusDesktop = '<span style="color:#e28801">Displayed only on Google, not displayed Bing, Yahoo.';
    }
    else if (metaDescWidth >= 920){
      statusText =  '<span style="font-weight:bold;color:#bd0000">The meta description is probably too long. Make it shorter.';
      statusMobile = '<span style="color:#bd0000">Not displayed the whole meta description';
      statusDesktop = '<span style="color:#bd0000">The meta description is realy looong';
    }
    else {
      statusText = "Unknown status";
    }
        
    //document.getElementById("desc-length").innerHTML = metaDescWidth;
    //document.getElementById("desc-string-length").innerHTML = txt.length; 
    return statusText;
    //document.getElementById("desc-status-mobile").innerHTML = statusMobile;
    //document.getElementById("desc-status-desktop").innerHTML = statusDesktop;
    
    //document.getElementById("google-desc").innerHTML = getDescSnippet(txt);      
}
function getMetaDescWidth(inputText) {
    var c = document.getElementById("canvas");
    var ctx = c.getContext("2d");    
    
    ctx.clearRect(0, 0, c.width, c.height);
    ctx.font = "13px Arial";    
    return Math.round(ctx.measureText(inputText).width);
}
	
function getDescSnippet(inputText) {
    var maxPixels = 1750;
    var metaDescWidth = getMetaDescWidth(inputText);
    
      var inputAsArray = inputText.split(" ");
      
      var develInput = ""; // vytvaram postupne zo slov novy popisok a testujem, kedy prekrocim hranicu na max pocet px
      var outputHtml = ""; // fin&aacute;lne htmlko, ktore pojde na vystup. Bude obsahova&#357; aj <span> tagy
      var zlta = false; // ci je uz aktivne zlte pozadie
      var oranzova = false;
      
      var zltaEnd = false; // ci uz je farba aj uzatvorena
      var oranzovaEnd = false;
      for (i = 0; i < inputAsArray.length; i++) { // prechadzam slovo po slove          
        develInput += inputAsArray[i];
            
           
        var newWidth = getMetaDescWidth(develInput); // zistim dlzku
        
        if (newWidth < 680){ // pohoda dlzka, len pridam text na vystup 
            outputHtml += inputAsArray[i];
        }
        else if (newWidth >= 680 && newWidth < 920){ // ak presiahne 1. metu, dam zlte pozadie
          if (!zlta){
             zlta = true;
             outputHtml+= '<span title="Truncated on mobile devices" style="background-color:#ffff8c;">';
          }                                                   
          outputHtml+= inputAsArray[i];
        }
        else if (newWidth >= 920 && newWidth <= maxPixels){ // ak presiahne 2. metu, dam oranzove pozadie
          if (!oranzova){
             oranzova = true;
             outputHtml+= '<span title="Truncated on Bing &#038; Yahoo!"  style="background-color:#ffd55d;;">';
          }            
          outputHtml+= inputAsArray[i];
        }          
        else if (newWidth > maxPixels){ // vytvoreny string je uz vacsi nez max -> 3. meta
           outputHtml += inputAsArray[i];                                                                
           var n = outputHtml.lastIndexOf(" ");           
           outputHtml = outputHtml.substr(0,n); // useknem posledne slovo, ktor&eacute; "pretek&aacute;" von
           
           if (zltaEnd == false){ // ukoncim zvyraznenia
              outputHtml += '';
              zltaEnd = true;
           }
           if (oranzovaEnd == false){
              outputHtml += '';
              oranzovaEnd = true;
           }
           
           return outputHtml + " ..."; // do v&yacute;stupu este pridam tri bodky
            
        }
              
        if (i != inputAsArray.length - 1){ // kym sa nejedna o posledne slovo, pridavam medzi ne medzeru
          develInput += " ";
          outputHtml += " ";
        } 
    }                      
    if (zltaEnd == false){ // ak som nepresvihol max. dlzku, ale nejake podfarbenie je aktivne
        outputHtml += '';
        zltaEnd = true;
    }
    if (oranzovaEnd == false){
        outputHtml += '';
        oranzovaEnd = true;
    }      
    return outputHtml;
}
function getTitleWidth(inputText) {
	var c = document.getElementById("canvas");
	var ctx = c.getContext("2d");    
	ctx.clearRect(0, 0, c.width, c.height);
	ctx.font = "20px Arial";    
	return Math.round(ctx.measureText(inputText).width);
}
	
function getTitleStatus(txt) {          
    var width = getTitleWidth(txt);
    
    var statusText = "";
    if (width < 580){
      statusText = '<span style="font-weight:bold;color:#016717">The title can be read everywhere, nice job!';
    }
    /*else if (width > 512 && width < 580 ){
      statusText =  '<span style="font-weight:bold;color:#e28801">The title will not be fully shown on some mobiles.';      
    }*/                                                        
    else if (width >= 580){
			statusText =  '<span style="font-weight:bold;color:#bd0000">The title is too long. Make it shorter.';
    }
    else {
      statusText = "Unknown status";
    }
        
    return statusText;         
}
	
function getTitleSnippet(inputText) {
    var maxPixels = 580;
    var width = getTitleWidth(inputText);
    
      var inputAsArray = inputText.split(" ");
      
      var develInput = ""; // vytvaram postupne zo slov novy title a testujem, kedy prekrocim hranicu na max pocet px
      var outputHtml = ""; // fin&aacute;lne htmlko, ktore pojde na vystup. Bude obsahova&#357; aj <span> tagy
      var zlta = false; // ci je uz aktivne zlte pozadie
      var zltaEnd = false; // ci uz je farba aj uzatvorena
      
	
      for (i = 0; i < inputAsArray.length; i++) { // prechadzam slovo po slove          
        develInput += inputAsArray[i];
            
           
        var newWidth = getTitleWidth(develInput); // zistim dlzku
        
        if (newWidth < 580){ // pohoda dlzka, len pridam text na vystup 
            outputHtml += inputAsArray[i];
        }
        /*else if (newWidth >= 512 && newWidth < 580){ // ak presiahne 1. metu, dam zlte pozadie
          if (!zlta){
             zlta = true;
             outputHtml+= '<span title="Truncated on mobile devices" style="background-color:#ffff8c;">';
          }                                                   
          outputHtml+= inputAsArray[i];
        }      */        
        else if (newWidth >= 580){ // vytvoreny string je uz vacsi nez max -> ideme sekat a pridavat bodky " ..." na koniec
					 var triBodkyWidth = getTitleWidth(" ...");
					 var totalWidth = newWidth + triBodkyWidth; // zvysime dlzku o " ...", ktore pridame do snippetu
					 var wordsToCutCount = 0; // kolko slov sa ma useknut
					 while (totalWidth >= 580){
						 var develInputAsArray = develInput.split(" ");
						 var li = develInput.lastIndexOf(" ");
						 develInput = develInput.substr(0,li); // odoberiem posledne slovo
						 
						 wordsToCutCount++;
						 totalWidth = getTitleWidth(develInput) + triBodkyWidth;
					 }
					 
					 outputHtml += inputAsArray[i];                                                                
					 for (j = 0; j < wordsToCutCount; j++){
						 var n = outputHtml.lastIndexOf(" ");           
             outputHtml = outputHtml.substr(0,n); // useknem posledne slovo, ktor&eacute; "pretek&aacute;" von
					 }
           
           if (zltaEnd == false){ // ukoncim zvyraznenia
              outputHtml += '';
              zltaEnd = true;
           }
                      
           return outputHtml + " ..."; // do v&yacute;stupu este pridam tri bodky            						
        }
              
        if (i != inputAsArray.length - 1){ // kym sa nejedna o posledne slovo, pridavam medzi ne medzeru
          develInput += " ";
          outputHtml += " ";
        } 
    }                      
    if (zltaEnd == false){ // ak som nepresvihol max. dlzku, ale nejake podfarbenie je aktivne
        outputHtml += '';
        zltaEnd = true;
    }      
    return outputHtml;
}
	
function getUrlWidth(inputText) {
	var c = document.getElementById("canvas");
	var ctx = c.getContext("2d");    
	ctx.clearRect(0, 0, c.width, c.height);
	ctx.font = "14px Arial";    
	return Math.round(ctx.measureText(inputText).width);
}
	
function getUrlSnippet(inputText) {
   if (getUrlWidth(inputText) < 580){
		 return inputText;
	 }
	 else {
		 var triBodkyWidth = getUrlWidth("...");
		 while ((getUrlWidth(inputText) + triBodkyWidth) >= 580){
			 inputText = inputText.substring(0, inputText.length - 1);
		 }
	 	 
	 	 return inputText + "...";
	 }
}

let isAProduct = false;
function isAProductFunc() {
    isAProduct = !isAProduct;
    if(isAProduct){
        document.getElementById("product").insertAdjacentHTML("beforeend",_productDetails);
        document.getElementById("google-valoration").style.display = "block";

    }else{
        let aux = document.getElementById("productDetails");
        aux.parentNode.removeChild(aux);
        document.getElementById("google-valoration").style.display = "none";
    }
    
}

function removeComent(node) {
    node.parentNode.parentNode.removeChild(node.parentNode);
}

function addComent() {
    document.getElementById("coments").insertAdjacentHTML("beforeend", _coment);
}

function changeValoration() {
    let valorations = document.querySelectorAll(".comentValoration");
    let valorationNumber = 0;
    for (const valoration of valorations) {
        valorationNumber += parseInt(valoration.options[valoration.selectedIndex].value, 10);
    }
    document.getElementById("ratingValue").innerHTML = Math.round10(valorationNumber/valorations.length, -1);
    document.getElementById("ratingCount").innerHTML = `(${valorations.length})`;
    document.getElementById("ratingStar").style.width = `${valorationNumber/valorations.length/5*65}px`;
}

// Conclusión
(function() {
    /**
     * Ajuste decimal de un número.
     *
     * @param {String}  tipo  El tipo de ajuste.
     * @param {Number}  valor El numero.
     * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
     * @returns {Number} El valor ajustado.
     */
    function decimalAdjust(type, value, exp) {
      // Si el exp no está definido o es cero...
      if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
      }
      value = +value;
      exp = +exp;
      // Si el valor no es un número o el exp no es un entero...
      if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
      }
      // Shift
      value = value.toString().split('e');
      value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
      // Shift back
      value = value.toString().split('e');
      return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
    }
  
    // Decimal round
    if (!Math.round10) {
      Math.round10 = function(value, exp) {
        return decimalAdjust('round', value, exp);
      };
    }
    // Decimal floor
    if (!Math.floor10) {
      Math.floor10 = function(value, exp) {
        return decimalAdjust('floor', value, exp);
      };
    }
    // Decimal ceil
    if (!Math.ceil10) {
      Math.ceil10 = function(value, exp) {
        return decimalAdjust('ceil', value, exp);
      };
    }
  })();