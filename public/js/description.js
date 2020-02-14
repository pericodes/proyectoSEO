var newImg;
var descriptionEditor;

let keyWordsArray = ["Oferta", "Chollo", "Ganga", "rebajado", "mejor precio"];

for (const keyword  of keyWordsArray) {
    addKeyword(keyword); 
}

/* EDITOR */
	let editorSedlector = "#description";
			tinymce.init({
				selector: editorSedlector,  // change this value according to your HTML
				images_upload_handler: function (blobInfo, success, failure) {
					var xhr, formData;		
					xhr = new XMLHttpRequest();
					xhr.withCredentials = false;
					xhr.open('POST', _UploadImageUrl);
					xhr.onload = function() {
					var json;

					if (xhr.status != 200) {
						failure('HTTP Error: ' + xhr.status);
						console.log('HTTP Error: ' + xhr.status);
						return;
					}
					console.log(xhr.responseText);

					json = JSON.parse(xhr.responseText);

					if (!json) {
						failure('Invalid JSON: ' + xhr.responseText);
						return;
					}
					newImg = json;
					success(json.ramdomId);
					};
					formData = new FormData();

					if( typeof(blobInfo.blob().name) !== undefined )
						fileName = blobInfo.blob().name;
					else
						fileName = blobInfo.filename();
					formData.append('tinyImageUpload', blobInfo.blob(), fileName);
					formData.append('action', "tinyEditor");
					//formData.append('file', blobInfo.blob(), fileName(blobInfo));
					xhr.send(formData);
				},
				setup: function(editor){

					editor.on('NodeChange', function (e) {
                    changeImageAttributes(e.element);
					});
					editor.on('init', function (e) {

                        descriptionEditor = this.contentDocument;
                        descriptionEditor.head.insertAdjacentHTML("beforeend", `
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                        ${style}
                        `);
						observer.observe(descriptionEditor, config);
						descriptionEditor.body.addEventListener('keyup', ()=>{
                            analyzeText(descriptionEditor.body);
                            //let headings = "h2 h3 h4 h5 h6".toLocaleUpperCase();
                            //if(headings.includes(node.tagName)){
                                generateMenuNavigation();
                            //}
						});
                    });
                    editor.on('init', () => {
                        editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                      });
                      editor.on('focus', () => {
                        editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                        editor.getContainer().style.borderColor="#80bdff"
                      });
                      editor.on('blur', () => {
                        editor.getContainer().style.boxShadow="",
                        editor.getContainer().style.borderColor=""
                      });
				},
				plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
				imagetools_cors_hosts: ['picsum.photos'],
				menubar: 'file edit view insert format tools table help',
				toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
				toolbar_sticky: true,
				autosave_ask_before_unload: true,
				autosave_interval: "30s",
				autosave_prefix: "{path}{query}-{id}-",
				autosave_restore_when_empty: false,
				autosave_retention: "2m",
				image_advtab: true,
				content_css: [
					'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
					'//www.tiny.cloud/css/codepen.min.css'
				],
				link_list: [
					{ title: 'My page 1', value: 'http://www.tinymce.com' },
					{ title: 'My page 2', value: 'http://www.moxiecode.com' }
				],
				image_list: [
					{ title: 'My page 1', value: 'http://www.tinymce.com' },
					{ title: 'My page 2', value: 'http://www.moxiecode.com' }
				],
				image_class_list: [
					{ title: 'None', value: '' },
					{ title: 'Some class', value: 'class-name' }
				],
				importcss_append: true,
				height: 400,
				file_picker_callback: function (callback, value, meta) {
					/* Provide file and text for the link dialog */
					if (meta.filetype === 'file') {
					callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
					}

					/* Provide image and alt text for the image dialog */
					if (meta.filetype === 'image') {
					callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
					}

					/* Provide alternative source and posted for the media dialog */
					if (meta.filetype === 'media') {
					callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
					}
				},
				templates: [
						{ title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
				],
				template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
				template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
				height: 600,
				image_caption: true,
				quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
				noneditable_noneditable_class: "mceNonEditable",
				toolbar_drawer: 'sliding',
                contextmenu: "link image imagetools table",
                skin: 'bootstrap',
				});

	// Options for the observer (which mutations to observe)
	const config = { attributes: true, childList: true, subtree: true };

	function changeImageAttributes(node) {
		if(newImg != null && node.tagName === "IMG" && node.src.indexOf(newImg.ramdomId)>-1){    
						/*node.setAttribute("src", newImg["image"].srcToOriginalImage);
                        node.setAttribute("srcset", newImg.srcset);*/
                        console.log(newImg["picture"]);
                        
                        node.insertAdjacentHTML("beforebegin", newImg["picture"]);
                        node.parentNode.removeChild(node);
						newImg = null;
                    }
        console.log(node);
        console.log(node.textContent);

        //We evit to have more than one h1 element
        if(node.tagName === "H1"){
                var p = document.createElement('p');
                    p.innerHTML = node.innerHTML;
                    node.parentNode.replaceChild(p, node);
        }
        
        let headings = "h2 h3 h4 h5 h6".toLocaleUpperCase();
        if(headings.includes(node.tagName)){
            generateMenuNavigation();
        }
	}
	
	var nodeSelected;

	function testDomain(domain){
		let domainRegex = /(?<domain>[a-zA-z](?:[a-zA-Z0-9]|(?:(?:[\.\-_])\w)){1,252}\.(?<tdl>[a-zA-Z]{2,6})\.?)/gmi;
		return domainRegex.test(domain);
	}
	function propeLinks(node) {
		if(node.tagName === "A" && afiliatesSites.has(node.host)){
			node.setAttribute("rel","sponsored"); 
			node.setAttribute("target","_blank");
			node.setAttribute("title",afiliatesSites.get(node.host).title);
			nodeSelected = node;
			node.setAttribute("href",afiliatesSites.get(node.host).href(afiliatesSites.get(node.host), node.href, true));
			console.log(node.text);
   			if(!node.text || testDomain(node.text))
				node.text = afiliatesSites.get(node.host).title;
		}
	}

	// Callback function to execute when mutations are observed
	const callback = function(mutationsList, observer) {
		// Use traditional 'for loops' for IE 11
		for(let mutation of mutationsList) {
			if (mutation.type === 'childList') {
				for(let node of mutation.addedNodes){
					if(node.tagName === "IMG")
						changeImageAttributes(node);
					if(node.tagName === "A")
						propeLinks(node);
				}
			}
			else if (mutation.type === 'attributes') {
				if(mutation.attributeName === "src"){
					console.log('The ' + mutation.attributeName + ' attribute was modified.');
					changeImageAttributes(mutation.target);
				}else if(mutation.attributeName === "href"){
					if(mutation.target !== nodeSelected){
						propeLinks(mutation.target);
					}else{
						nodeSelected = null;
					}
					
				}
				
			}
		}
		
	};

	// Create an observer instance linked to the callback function
	const observer = new MutationObserver(callback);

	// Start observing the target node for configured mutations
	//observer.observe(targetNode, config);

	// Later, you can stop observing
    //observer.disconnect()
    
    function addKeyword(text, className) {
        let keyWords = document.getElementById("keywords");
        //console.log(keyWords.getElementsByTagName("input"));
        let addKeywordButtom = document.getElementById("addKeywordButtom");
        if(keyWords.getElementsByTagName("input").length < 15){
            if(className != "keyWordAutoAdded" || (className == "keyWordAutoAdded" && text) ) {
                let keyword = keyWords.children[0].cloneNode(true);
                keyword.getElementsByTagName("input")[0].id = `keyword${keyWords.children.length}`;
                keyword.getElementsByTagName("input")[0].name = `keyword${keyWords.children.length}`;
                if(text){
                    keyword.getElementsByTagName("input")[0].value = text;
                }else{
                    keyword.getElementsByTagName("input")[0].value = ``;
                    keyword.getElementsByTagName("input")[0].focus();
                }
                if(className){
                    keyword.classList.add(className);
                }
                keyword.getElementsByTagName("input")[0].placeholder = `Nueva palabra clave`;
                keyword.getElementsByTagName("button")[0].removeAttribute("style");
                addKeywordButtom.parentNode.parentNode.insertAdjacentElement('beforebegin',keyword);
            }
        }
        if(keyWords.getElementsByTagName("input").length >= 15){
            addKeywordButtom.style.display = "none"; 
        }
        
        
        //document.getElementById("removeBottom").removeAttribute("style");
    }
    function removeKeyword(self) {
        let keyWords = document.getElementById("keywords");
        keyWords.removeChild(self.parentNode.parentNode);
        if(keyWords.children.length == 1){
            self.style = "display:none";
        }
        document.getElementById("addKeywordButtom").removeAttribute("style");
    }

    function wordCount(text) {
		return text.match(/[^\s\.\,\:]+/gmi).length;	
	}

	function analyzeText(node) {

		let text = node.textContent;
		let words = wordCount(text);
		console.log(words);
		if(words > 50){
			let keywords = extractKeyWords(node.textContent);
			let keyWordsElement = document.getElementsByClassName("keyWordAutoAdded");
			while (keyWordsElement.length > 0) {
				keyWordsElement[0].parentNode.removeChild(keyWordsElement[0]);
			}
			for(let i = 0; i < words/25; i++){
				addKeyword(keywords[i], "keyWordAutoAdded");
			}
			console.log(keywords);
		}
	}

    function makeString(object) {
    if (object == null) return '';
    return '' + object;
    };
    function stripTags(str) {
    return makeString(str).replace(/<\/?[^>]+>/g, '');
    };
    function extractKeyWords(str, options){
        /*if(_.isEmpty(str)){
            return [];
        }
        if(_.isEmpty(options)){
            options = {
                remove_digits: true,
                return_changed_case: true
            };
        }*/
        let return_changed_case = true;
        let return_chained_words = true;
        let remove_digits = true;
        let _remove_duplicates = true;
        let return_max_ngrams = true;

        //  strip any HTML and trim whitespace
        let text = str.trim(stripTags(str));

            let words = text.split(/\s/);
            let unchanged_words = [];
            let low_words = [];
            //  change the case of all the words
            for(let x = 0;x < words.length; x++){
                let w = words[x].match(/https?:\/\/.*[\r\n]*/g) ? words[x] : words[x].replace(/\.|,|;|!|\?|\(|\)|:|"|^'|'$|“|”|‘|’/g,'');
                //  remove periods, question marks, exclamation points, commas, and semi-colons
                //  if this is a short result, make sure it's not a single character or something 'odd'
                if(w.length === 1){
                    w = w.replace(/-|_|@|&|#/g,'');
                }
                //  if it's a number, remove it
                let digits_match = w.match(/\d/g);
                if(remove_digits && digits_match && digits_match.length === w.length){
                    w = "";
                }
                if(w.length > 0){
                    low_words.push(w.toLowerCase());
                    unchanged_words.push(w);
                }
            }
            let results = [];
            
            let _last_result_word_index = 0;
            let _start_result_word_index = 0;
            let _unbroken_word_chain = false;
            for(let y = 0; y < low_words.length; y++){

                if(stopwords.indexOf(low_words[y]) < 0){
                    
                    if(_last_result_word_index !== y - 1){
                        _start_result_word_index = y;
                        _unbroken_word_chain = false; 
                    } else {
                        _unbroken_word_chain = true;
                    }
                    let result_word = return_changed_case && !unchanged_words[y].match(/https?:\/\/.*[\r\n]*/g) ? low_words[y] : unchanged_words[y];
                    
                    if (return_max_ngrams && _unbroken_word_chain && !return_chained_words && return_max_ngrams > (y - _start_result_word_index) && _last_result_word_index === y - 1){
                        let change_pos = results.length - 1 < 0 ? 0 : results.length - 1;
                        results[change_pos] = results[change_pos] ? results[change_pos] + ' ' + result_word : result_word;
                    } else if (return_chained_words && _last_result_word_index === y - 1) {
                        let change_pos = results.length - 1 < 0 ? 0 : results.length - 1;
                    results[change_pos] = results[change_pos] ? results[change_pos] + ' ' + result_word : result_word;
                    } else {
                    results.push(result_word);
                    }

                    _last_result_word_index = y;
                } else {
                    _unbroken_word_chain = false;
                }
            }

            if(_remove_duplicates) {
                    var frequency = {}, value;

                    // compute frequencies of each value
                    for(var i = 0; i < results.length; i++) {
                        value = results[i];
                        if(value in frequency) {
                            frequency[value]++;
                        }
                        else {
                            frequency[value] = 1;
                        }
                    }

                    // make array from the frequency object to de-duplicate
                    var uniques = [];
                    for(value in frequency) {
                        uniques.push(value);
                    }

                    // sort the uniques array in descending order by frequency
                    function compareFrequency(a, b) {
                        return frequency[b] - frequency[a];
                    }

                    results = uniques.sort(compareFrequency);
            }

            return results;
        
    }

    function generateMenuNavigation() {
        let toc_container = descriptionEditor.getElementById("toc_container");

        
        if(toc_container){
            toc_container.parentNode.removeChild(toc_container);
        }

        let headings = descriptionEditor.querySelectorAll("h2, h3, h4, h5, h6");
        let levels = [0, 0, 0, 0, 0];
        let level = 0; 
        let ul = `<ul >`;
        let html = `<nav id="toc_container" class="no_bullets"><p class="toc_title">Índice de contenido</p><ul class="toc_list">`;

        for (let heading of headings) {
            let newLevel;
            switch (heading.tagName) {
                case "H2":
                    newLevel = 0;
                    break;
                case "H3":
                    newLevel = 1;
                        
                        break;
                case "H4":
                    newLevel = 2;
                        
                        break;
                case "H5":
                    newLevel = 3;
                        
                        break;
                case "H6":
                    newLevel = 4;
                        
                        break;
                
                default:
                    break;
            }
            for (let index = newLevel+1; index < levels.length; index++) {
                levels[index] = 0;
            }
            ++levels[newLevel];
            let content = "";
            for (let index = 0; index < levels.length && index < newLevel+1; index++) {
                content += levels[index] + ".";
                
            }
            let id = heading.textContent.replace(/[^\w]/gi, "-");
            heading.id = id; 
            console.log(content);
            
            let li = `<li ><a href="#${id}"><span class="toc_number toc_depth_${newLevel+1}">${content}</span> ${heading.textContent}</a></li>`;

            if(newLevel == level){
                html += li;
            }else if(newLevel >= level){
                html += `${ul}${li}`;
            }else{
                html += `</ul>${li}`;
                
            }
            level = newLevel;
            
        }
        html += `</ul></nav>`;

        headings[0].insertAdjacentHTML("beforebegin", html);


    }

    var style = `
    <style>
    #toc_container ul,#toc_container li {
        margin:0;
        padding:0;
    }
    
    #toc_container.no_bullets ul,
    #toc_container.no_bullets li,
    #toc_container.no_bullets ul li,
    .toc_widget_list.no_bullets,
    .toc_widget_list.no_bullets li {
        background:none;
        list-style-type:none;
        list-style:none;
    }
    
    #toc_container.have_bullets li {
        padding-left:12px;
    }
    
    #toc_container ul ul {
        margin-left:1.5em;
    }
    
    #toc_container {
        background:#f9f9f9;
        border:1px solid #aaa;
        padding:10px;
        margin-bottom:1em;
        width:auto;
        display:table;
        font-size:95%;
    }
    
    #toc_container.toc_light_blue {
        background:#edf6ff;
    }
    
    #toc_container.toc_white {
        background:#fff;
    }
    
    #toc_container.toc_black {
        background:#000;
    }
    
    #toc_container.toc_transparent {
        background:none transparent;
    }
    
    #toc_container p.toc_title {
        text-align:center;
        font-weight:700;
        margin:0;
        padding:0;
    }
    
    #toc_container.toc_black p.toc_title {
        color:#aaa;
    }
    
    #toc_container span.toc_toggle {
        font-weight:400;
        font-size:90%;
    }
    
    #toc_container p.toc_title + ul.toc_list {
        margin-top:1em;
    }
    
    .toc_wrap_left {
        float:left;
        margin-right:10px;
    }
    
    .toc_wrap_right {
        float:right;
        margin-left:10px;
    }
    
    #toc_container a {
        text-decoration:none;
        text-shadow:none;
        color: black; 
    }
    
    #toc_container a:hover {
        text-decoration:underline;
    }
    
    .toc_sitemap_posts_letter {
        font-size:1.5em;
        font-style:italic;
    }
    </style>`;

    var stopwords = [
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '_',
        'a',
        'actualmente',
        'acuerdo',
        'adelante',
        'ademas',
        'además',
        'adrede',
        'afirmó',
        'agregó',
        'ahi',
        'ahora',
        'ahí',
        'al',
        'algo',
        'alguna',
        'algunas',
        'alguno',
        'algunos',
        'algún',
        'alli',
        'allí',
        'alrededor',
        'ambos',
        'ampleamos',
        'antano',
        'antaño',
        'ante',
        'anterior',
        'antes',
        'apenas',
        'aproximadamente',
        'aquel',
        'aquella',
        'aquellas',
        'aquello',
        'aquellos',
        'aqui',
        'aquél',
        'aquélla',
        'aquéllas',
        'aquéllos',
        'aquí',
        'arriba',
        'arribaabajo',
        'aseguró',
        'asi',
        'así',
        'atras',
        'aun',
        'aunque',
        'ayer',
        'añadió',
        'aún',
        'b',
        'bajo',
        'bastante',
        'bien',
        'breve',
        'buen',
        'buena',
        'buenas',
        'bueno',
        'buenos',
        'c',
        'cada',
        'casi',
        'cerca',
        'cierta',
        'ciertas',
        'cierto',
        'ciertos',
        'cinco',
        'claro',
        'comentó',
        'como',
        'con',
        'conmigo',
        'conocer',
        'conseguimos',
        'conseguir',
        'considera',
        'consideró',
        'consigo',
        'consigue',
        'consiguen',
        'consigues',
        'contigo',
        'contra',
        'cosas',
        'creo',
        'cual',
        'cuales',
        'cualquier',
        'cuando',
        'cuanta',
        'cuantas',
        'cuanto',
        'cuantos',
        'cuatro',
        'cuenta',
        'cuál',
        'cuáles',
        'cuándo',
        'cuánta',
        'cuántas',
        'cuánto',
        'cuántos',
        'cómo',
        'd',
        'da',
        'dado',
        'dan',
        'dar',
        'de',
        'debajo',
        'debe',
        'deben',
        'debido',
        'decir',
        'dejó',
        'del',
        'delante',
        'demasiado',
        'demás',
        'dentro',
        'deprisa',
        'desde',
        'despacio',
        'despues',
        'después',
        'detras',
        'detrás',
        'dia',
        'dias',
        'dice',
        'dicen',
        'dicho',
        'dieron',
        'diferente',
        'diferentes',
        'dijeron',
        'dijo',
        'dio',
        'donde',
        'dos',
        'durante',
        'día',
        'días',
        'dónde',
        'e',
        'ejemplo',
        'el',
        'ella',
        'ellas',
        'ello',
        'ellos',
        'embargo',
        'empleais',
        'emplean',
        'emplear',
        'empleas',
        'empleo',
        'en',
        'encima',
        'encuentra',
        'enfrente',
        'enseguida',
        'entonces',
        'entre',
        'era',
        'erais',
        'eramos',
        'eran',
        'eras',
        'eres',
        'es',
        'esa',
        'esas',
        'ese',
        'eso',
        'esos',
        'esta',
        'estaba',
        'estabais',
        'estaban',
        'estabas',
        'estad',
        'estada',
        'estadas',
        'estado',
        'estados',
        'estais',
        'estamos',
        'estan',
        'estando',
        'estar',
        'estaremos',
        'estará',
        'estarán',
        'estarás',
        'estaré',
        'estaréis',
        'estaría',
        'estaríais',
        'estaríamos',
        'estarían',
        'estarías',
        'estas',
        'este',
        'estemos',
        'esto',
        'estos',
        'estoy',
        'estuve',
        'estuviera',
        'estuvierais',
        'estuvieran',
        'estuvieras',
        'estuvieron',
        'estuviese',
        'estuvieseis',
        'estuviesen',
        'estuvieses',
        'estuvimos',
        'estuviste',
        'estuvisteis',
        'estuviéramos',
        'estuviésemos',
        'estuvo',
        'está',
        'estábamos',
        'estáis',
        'están',
        'estás',
        'esté',
        'estéis',
        'estén',
        'estés',
        'ex',
        'excepto',
        'existe',
        'existen',
        'explicó',
        'expresó',
        'f',
        'fin',
        'final',
        'fue',
        'fuera',
        'fuerais',
        'fueran',
        'fueras',
        'fueron',
        'fuese',
        'fueseis',
        'fuesen',
        'fueses',
        'fui',
        'fuimos',
        'fuiste',
        'fuisteis',
        'fuéramos',
        'fuésemos',
        'g',
        'general',
        'gran',
        'grandes',
        'gueno',
        'h',
        'ha',
        'haber',
        'habia',
        'habida',
        'habidas',
        'habido',
        'habidos',
        'habiendo',
        'habla',
        'hablan',
        'habremos',
        'habrá',
        'habrán',
        'habrás',
        'habré',
        'habréis',
        'habría',
        'habríais',
        'habríamos',
        'habrían',
        'habrías',
        'habéis',
        'había',
        'habíais',
        'habíamos',
        'habían',
        'habías',
        'hace',
        'haceis',
        'hacemos',
        'hacen',
        'hacer',
        'hacerlo',
        'haces',
        'hacia',
        'haciendo',
        'hago',
        'han',
        'has',
        'hasta',
        'hay',
        'haya',
        'hayamos',
        'hayan',
        'hayas',
        'hayáis',
        'he',
        'hecho',
        'hemos',
        'hicieron',
        'hizo',
        'horas',
        'hoy',
        'hube',
        'hubiera',
        'hubierais',
        'hubieran',
        'hubieras',
        'hubieron',
        'hubiese',
        'hubieseis',
        'hubiesen',
        'hubieses',
        'hubimos',
        'hubiste',
        'hubisteis',
        'hubiéramos',
        'hubiésemos',
        'hubo',
        'i',
        'igual',
        'incluso',
        'indicó',
        'informo',
        'informó',
        'intenta',
        'intentais',
        'intentamos',
        'intentan',
        'intentar',
        'intentas',
        'intento',
        'ir',
        'j',
        'junto',
        'k',
        'l',
        'la',
        'lado',
        'largo',
        'las',
        'le',
        'lejos',
        'les',
        'llegó',
        'lleva',
        'llevar',
        'lo',
        'los',
        'luego',
        'lugar',
        'm',
        'mal',
        'manera',
        'manifestó',
        'mas',
        'mayor',
        'me',
        'mediante',
        'medio',
        'mejor',
        'mencionó',
        'menos',
        'menudo',
        'mi',
        'mia',
        'mias',
        'mientras',
        'mio',
        'mios',
        'mis',
        'misma',
        'mismas',
        'mismo',
        'mismos',
        'modo',
        'momento',
        'mucha',
        'muchas',
        'mucho',
        'muchos',
        'muy',
        'más',
        'mí',
        'mía',
        'mías',
        'mío',
        'míos',
        'n',
        'nada',
        'nadie',
        'ni',
        'ninguna',
        'ningunas',
        'ninguno',
        'ningunos',
        'ningún',
        'no',
        'nos',
        'nosotras',
        'nosotros',
        'nuestra',
        'nuestras',
        'nuestro',
        'nuestros',
        'nueva',
        'nuevas',
        'nuevo',
        'nuevos',
        'nunca',
        'o',
        'ocho',
        'os',
        'otra',
        'otras',
        'otro',
        'otros',
        'p',
        'pais',
        'para',
        'parece',
        'parte',
        'partir',
        'pasada',
        'pasado',
        'paìs',
        'peor',
        'pero',
        'pesar',
        'poca',
        'pocas',
        'poco',
        'pocos',
        'podeis',
        'podemos',
        'poder',
        'podria',
        'podría',
        'podriais',
        'podriamos',
        'podrian',
        'podrias',
        'podrá',
        'podrán',
        'podría',
        'podrían',
        'poner',
        'por',
        'por qué',
        'porque',
        'posible',
        'primer',
        'primera',
        'primero',
        'primeros',
        'principalmente',
        'pronto',
        'propia',
        'propias',
        'propio',
        'propios',
        'proximo',
        'próximo',
        'próximos',
        'pudo',
        'pueda',
        'puede',
        'pueden',
        'puedo',
        'pues',
        'q',
        'qeu',
        'que',
        'quedó',
        'queremos',
        'quien',
        'quienes',
        'quiere',
        'quiza',
        'quizas',
        'quizá',
        'quizás',
        'quién',
        'quiénes',
        'qué',
        'r',
        'raras',
        'realizado',
        'realizar',
        'realizó',
        'repente',
        'respecto',
        's',
        'sabe',
        'sabeis',
        'sabemos',
        'saben',
        'saber',
        'sabes',
        'sal',
        'salvo',
        'se',
        'sea',
        'seamos',
        'sean',
        'seas',
        'segun',
        'segunda',
        'segundo',
        'según',
        'seis',
        'ser',
        'sera',
        'seremos',
        'será',
        'serán',
        'serás',
        'seré',
        'seréis',
        'sería',
        'seríais',
        'seríamos',
        'serían',
        'serías',
        'seáis',
        'señaló',
        'si',
        'sido',
        'siempre',
        'siendo',
        'siete',
        'sigue',
        'siguiente',
        'sin',
        'sino',
        'sobre',
        'sois',
        'sola',
        'solamente',
        'solas',
        'solo',
        'solos',
        'somos',
        'son',
        'soy',
        'soyos',
        'su',
        'supuesto',
        'sus',
        'suya',
        'suyas',
        'suyo',
        'suyos',
        'sé',
        'sí',
        'sólo',
        't',
        'tal',
        'tambien',
        'también',
        'tampoco',
        'tan',
        'tanto',
        'tarde',
        'te',
        'temprano',
        'tendremos',
        'tendrá',
        'tendrán',
        'tendrás',
        'tendré',
        'tendréis',
        'tendría',
        'tendríais',
        'tendríamos',
        'tendrían',
        'tendrías',
        'tened',
        'teneis',
        'tenemos',
        'tener',
        'tenga',
        'tengamos',
        'tengan',
        'tengas',
        'tengo',
        'tengáis',
        'tenida',
        'tenidas',
        'tenido',
        'tenidos',
        'teniendo',
        'tenéis',
        'tenía',
        'teníais',
        'teníamos',
        'tenían',
        'tenías',
        'tercera',
        'ti',
        'tiempo',
        'tiene',
        'tienen',
        'tienes',
        'toda',
        'todas',
        'todavia',
        'todavía',
        'todo',
        'todos',
        'total',
        'trabaja',
        'trabajais',
        'trabajamos',
        'trabajan',
        'trabajar',
        'trabajas',
        'trabajo',
        'tras',
        'trata',
        'través',
        'tres',
        'tu',
        'tus',
        'tuve',
        'tuviera',
        'tuvierais',
        'tuvieran',
        'tuvieras',
        'tuvieron',
        'tuviese',
        'tuvieseis',
        'tuviesen',
        'tuvieses',
        'tuvimos',
        'tuviste',
        'tuvisteis',
        'tuviéramos',
        'tuviésemos',
        'tuvo',
        'tuya',
        'tuyas',
        'tuyo',
        'tuyos',
        'tú',
        'u',
        'ultimo',
        'un',
        'una',
        'unas',
        'uno',
        'unos',
        'usa',
        'usais',
        'usamos',
        'usan',
        'usar',
        'usas',
        'uso',
        'usted',
        'ustedes',
        'v',
        'va',
        'vais',
        'valor',
        'vamos',
        'van',
        'varias',
        'varios',
        'vaya',
        'veces',
        'ver',
        'verdad',
        'verdadera',
        'verdadero',
        'vez',
        'vosotras',
        'vosotros',
        'voy',
        'vuestra',
        'vuestras',
        'vuestro',
        'vuestros',
        'w',
        'x',
        'y',
        'ya',
        'yo',
        'z',
        'él',
        'éramos',
        'ésa',
        'ésas',
        'ése',
        'ésos',
        'ésta',
        'éstas',
        'éste',
        'éstos',
        'última',
        'últimas',
        'último',
        'últimos'
    ];