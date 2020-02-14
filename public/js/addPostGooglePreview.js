<canvas id="canvas" width="0" height="0" style="border:1px solid #d3d3d3;">   Note: The canvas tag is not supported in Internet Explorer 8 and earlier versions. 
                                                </canvas>

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
          