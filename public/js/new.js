
function addPerm(test){
        let flag = ($(test).is(":checked"))
        if (flag){
            $("#Credential_UtilisateursAutorises").val($("#Credential_UtilisateursAutorises").val() + ",#"+$(test).val() + "#")
        } else {
            let coucou = $("#Credential_UtilisateursAutorises").val()
            $("#Credential_UtilisateursAutorises").val(coucou.replaceAll(",#"+$(test).val() + "#",''));
        }
    }
    
    
    
    
    
    function throttle( fn, time ) {
    var t = 0;
    return function() {
        var args = arguments,
            ctx = this;
 
            clearTimeout(t);
 
        t = setTimeout( function() {
            fn.apply( ctx, args );
        }, time );
    };
}
    
    
function estSurPageTimeTracking(url) {
  const pattern = /^https:\/\/apps\.glanum\.com\/GDP\/TimeTracking\/Index\/\d+$/;
  return pattern.test(url);
}

$(document).ready(function () {
			const url = window.location.href;
		if (estSurPageTimeTracking(url)) {
		  console.log("Vous êtes sur la page TimeTracking.");
		} else {
			console.log("🔥🔥🔥🔥")
			document.addEventListener("DOMSubtreeModified", throttle( function(e) {
			    if($('.asana').length === 0) {
			    	var btn = '<a class="asana asana-mail gbutton" href="javascript:void(0);">Asana + Mail</a>&nbsp;&nbsp;&nbsp;<a class="campfire gbutton" href="javascript:void(0);">Campfire</a>'
			    	$(btn).prependTo( $( "#PopUp .page-header" ) );
			    	// Ajout des flèches précédent et suivant dans le calendar
			    	var config = $('#calendar').fullCalendar('getView').calendar.options
					config.header.left = "prev,next"
					$('#calendar').fullCalendar('destroy');
					$('#calendar').fullCalendar(config);
			    	
			    }
			}, 500 ), false );
		}

	
	
    let essais = $("#main-form > div.table-responsive > table.table.table-striped.table-bordered.table-hover.list > tbody")[0].children


        for (var i = 0; i < essais.length; i++) {
          var element = essais[i];
          // Faites quelque chose avec chaque élément

          let searchChaine = $(element)[0].children[6];
          searchChaineText = searchChaine.innerText
          var regex = /(https?:\/\/[^\s]+)/g;
            var matches = searchChaineText.match(regex);

            if (matches) {
              var lien = matches[0];
              $(searchChaine).html(searchChaine.innerHTML+"<a href='"+lien+"' target='_blank'><button type='button'>Go link</button></a>")
            }
        }

});
	
	

      // Sélectionnez l'élément d'entrée (input) avec l'ID "Login"
      var inputLogin = $('#Login');
    
      // Ajoutez l'attribut "autocomplete" avec la valeur "off"
      inputLogin.attr('autocomplete', 'off');
  
    $(document).on('click','#deleteFav',function(){
            localStorage.removeItem("favoryPeople")
            location.reload();
    });

    $(document).on('click','#addFavory',function(){

        let idFav = $('#favoryPeople').find(":selected").val()
        let cptFav = parseInt(($('#favoryPeople').find(":selected")[0].dataset.cpt))
        let textFav = ($('#favoryPeople').find(":selected").text())    
        let objFavory = {'id' : idFav, 'cpt': cptFav, 'text': textFav}
        console.log(objFavory);

        let arrayFavS = localStorage.getItem('favoryPeople')
        arrayFavS = JSON.parse(arrayFavS)
        console.log(arrayFavS)
        if (!arrayFavS){
            let arrayNew = []
            arrayNew.push(objFavory)
            localStorage.setItem('favoryPeople', JSON.stringify(arrayNew));
        }else {
            console.log(arrayFavS);
            let arrayNew = arrayFavS
            arrayNew.push(objFavory)
            console.log(arrayNew);
            localStorage.setItem('favoryPeople', JSON.stringify(arrayNew));
        }



        // localStorage.setItem('favoryPeople', arrayNew);
    })

    $(document).on('click','.gicon-pencil',function(){
    	
    	
    	let pensil = this;
    	console.log($($(this).parents()[1]).css("background-color", "greenyellow"))
    	
    	console.log("✅✅✅")
    	console.log($($(this).parents()[1]).children())
   
        setTimeout(function(){
        	
        	
        	 let monStockage = localStorage;
        console.log(monStockage);

        const propertyNames = Object.keys(monStockage);

        console.log(propertyNames);

        propertyNames.forEach(element => {
                console.log(element);
                let nom = element.split('_');    
                setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class="apply gbutton groupeUser" data-name='+nom[1]+' onclick="return false;">'+nom[1]+'</button>');
        },3000)
            });

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class="apply gbutton" id="addBack" onclick="return false;">Pole Appli</button>');
        },3000)

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class=" gbutton" id="addGroup" onclick="return false;">+</button>');
        },3000)

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class=" gbutton" id="unselectGroup" onclick="return false;">-</button>');
        },3000)

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class=" gbutton" id="deleteStore" onclick="return false;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg></button>');
        },3000)
        	
            console.log("aa")
            let arrayObject = $("#rows_utilisateur").children();
            arrayObject = (Array.from(arrayObject))
            let arrayNames = []
            let arrayIds = []
            let htmls = ""
            let cpt = 0
            arrayObject.forEach(element => {
                cpt = cpt +1
                let id = ($($(element.children[0])[0]).attr('for'))
                arrayIds.push(id)
                let name = ($($(element.children[0])[0]).text().trim())
                arrayNames.push(name)
                let html = "<option value='" +id+"' data-cpt='"+cpt+"'>"+name+"</option>"
                htmls = htmls + html
            });
            console.log(arrayNames);
            console.log(arrayIds);

            $("#rows_utilisateur").prepend("<select id='favoryPeople'>" + htmls + "</select> <button id='addFavory' onclick='return false;'>Ajouter favori</button><button id='deleteFav' onclick='return false;'>Supprimer tous</button>")

            let arrayFavS = localStorage.getItem('favoryPeople')
            arrayFavS = JSON.parse(arrayFavS)
            console.log(arrayFavS)



            arrayFavS.forEach(element => {


                let deleteLine = $("#"+element.id)
                let check = (deleteLine.is(":checked"))
                console.log(check)
                console.log($(deleteLine).parent().remove())
                if (check){
                    let idsplit = element.id.split('_')[1]
                    $("#rows_utilisateur").prepend("<div class='dnaf_row dnaf_row_100 dnaf_row_rad'><label for='"+element.id+"'>"+element.text+"</label><input checked='checked' id='"+element.id+"' type='checkbox' name='mass_checkbox[]' onclick='addPerm("+element.id+")' value='"+idsplit+"'></div>")    
                } else {
                    let idsplit = element.id.split('_')[1]
                    $("#rows_utilisateur").prepend("<div class='dnaf_row dnaf_row_100 dnaf_row_rad'><label for='"+element.id+"'>"+element.text+"</label><input id='"+element.id+"' type='checkbox' name='mass_checkbox[]' onclick='addPerm("+element.id+")' value='"+idsplit+"'></div>")    
                }



            })

        },500);
    })

    const slugify = str =>
  str
    .toLowerCase()
    .trim()
    .replace(/[^\w\s-]/g, '')
    .replace(/[\s_-]+/g, '-')
    .replace(/^-+|-+$/g, '');    


    let old = ""
    

    $(document).on('click','#main_container > div > div > div > div > a' , function() {




        let monStockage = localStorage;
        console.log(monStockage);

        const propertyNames = Object.keys(monStockage);

        console.log(propertyNames);

        propertyNames.forEach(element => {
                console.log(element);
                let nom = element.split('_');    
                setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class="apply gbutton groupeUser" data-name='+nom[1]+' onclick="return false;">'+nom[1]+'</button>');
        },3000)
            });

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class="apply gbutton" id="addBack" onclick="return false;">Pole Appli</button>');
        },3000)

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class=" gbutton" id="addGroup" onclick="return false;">+</button>');
        },3000)

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class=" gbutton" id="unselectGroup" onclick="return false;">-</button>');
        },3000)

        setTimeout(function(){
            $("#credential-from > div.page-header > div").append('<button class=" gbutton" id="deleteStore" onclick="return false;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg></button>');
        },3000)

    }
    );



    $(document).on('click','#unselectGroup', function (){
        localStorage.clear();
    });

    $(document).on('click','#deleteStore', function (){
        localStorage.clear();
    });

        $(document).on('click','.groupeUser', function (){
            let name = this.dataset.name;    
             name = slugify(name)
            let arrayString = localStorage.getItem("clef_"+name)
            let arrayFinal = arrayString.split(',');
            arrayFinal.forEach(element => {
                $("#"+element).click()
            });

        });

    $(document).on('click','#addGroup', function (){
        $("#credential-from > div.page-content > div > div:nth-child(2) > div").prepend("<input id='newName' type='text' style='background: whitesmoke;'><button id='createGroupe' onclick='return false;' class='gbutton'>Creer</button>")
    })

    $(document).on('click','#nd', function (){
        $("#Commentaire").val("[ND] "+ $("#Commentaire").val() )
    });
    
    $(document).on('click','#matin', function (){
        $("#HeureDebut").val(horaireMatinDebut)
        $("#HeureFin").val(horaireMatinFin)
    });
    
    $(document).on('click','#aprem', function (){
        $("#HeureDebut").val(horaireApremDebut)
        $("#HeureFin").val(horaireApremFin)
    });


    $(document).on('click','.task_infos_container',function(){
        setTimeout(() => {
                $("#timetracking_form > div.page-content > div > div:nth-child(1) > div > fieldset").append("<div id='divtt'><button id='nd' class='gbutton' onclick='return false;'>ND</button>")
                $("#timetracking_form > div.page-content > div > div:nth-child(1) > div > fieldset").append("<button id='matin' class='gbutton' onclick='return false;'>Matin</button>")
                $("#timetracking_form > div.page-content > div > div:nth-child(1) > div > fieldset").append("<button id='aprem' class='gbutton' onclick='return false;'>Aprem</button></div>")
}, "1000")
    })


    $(document).on('click','#createGroupe',function(){
        console.log("coucou");
        let arraySelect = Array.from($("input[name='mass_checkbox[]']:checked"));
        let arrayNew = []
        arraySelect.forEach(element => {
                console.log(element.id);
                arrayNew.push(element.id)
            });

        console.log(arrayNew);
        let name = $("#newName").val();
         name = slugify(name)
        localStorage.setItem('clef_'+name, arrayNew);



    });

    $(document).on('click','#addBack', function (){
            arrayBack = [
            'user_2764', // Arnaud
            'user_2950', // Cyril
            'user_3293', // Gael 
            'user_3281', // Kaoutar
            'user_1210', // Jeremy G
            'user_2825', // Leo 
            'user_3278', // Mattias
            'user_2744', // Pierre,
            'user_2783', // Thomas
            'user_3156', // Zac
            'user_3284', // Adrien
            'user_3375', // Tomo
            'user_3286', // Théo
            'user_3306', // Eric
            'user_3521', // Alexis
            'user_3522' // Julie
            ]
            arrayBack.forEach(element => {
                console.log(element);
               $("#"+element).click()
            });

        console.log("back add");
    })

    $( document ).keypress(function(e) {
        arrayBack = [
            'user_2764', // Arnaud
            'user_2950', // Cyril
            'user_3281', // Kaoutar
            'user_1210', // Jeremy G
            'user_2825', // Leo 
            'user_3278', // Mattias
            'user_2744', // Pierre,
            'user_2783', // Thomas
            'user_3156', // Zac
            'user_3284', // Adrien
            'user_3375', // Tomo,
            'user_3286', // Théo
            'user_3306', // Eric
            'user_3521', // Alexis
            'user_3522' // Julie
            ]
        console.log(e.keyCode);
        if (e.keyCode === old && e.keyCode === 43){
            console.log("ok ! ")
            arrayBack.forEach(element => {
                console.log(element);
               //$("#"+element).prop( "checked", true );
               $("#"+element).click();
            });

        }  else if (e.keyCode === 45){
                arrayBack.forEach(element => {
                console.log(element);
               $("#"+element).click()
            });
        }
        old = e.keyCode
  console.log( "Handler for .keypress() called." );
});


    console.log($("button > .picto")[0])
    $("#master_signin_box > button > img").removeAttr('src')
$("#master_signin_box > button > img").attr('src',avatarUrl)

$(document).on('click', '.fc-time', function event(e) {
         e.stopPropagation();
     var text = this.dataset.full
     var esp =  text.split(' ');
     if(esp[2] === "12:30")
     {
         $("#HeureDebut").val("13:30")
     }
    else
    {
        $("#HeureDebut").val(esp[2])
    }

})

    function testleo(){
        console.log("coucou");
    }


$(document).on('click', '.fc-title', function event(e) {
    e.stopPropagation();
     var text = $(this).html();
     console.log(text);
     var esp =  text.split('<br>');
     console.log(esp);
     var esp2 =  esp[2].split('Commentaire :');
     $("#Commentaire").val(decodeURI(esp2[1]))
})


$(document).on('change', '#SelectedTacheProduitId', function event(e) {
    let save = $("#Tache_Libelle").val()
    console.log(save)
     e.stopPropagation();
     console.log(this);
     setTimeout(function() {
         $("#Tache_Libelle").val(save+" ["+$("#Tache_Libelle").val().trim()+"]");
         console.log("essais")
     }, 1500);


     return false;


})



$(document).on('paste', '#Tache_Libelle', function event(e) {

    console.log("changement")    

})

$(document).on('click',"a.icon-comment, span.icon-comment",function (){
    let contenue = $(this)[0].title
    let text = contenue.split('Commentaire :\r\"')
    $("#Commentaire").val(text[1].slice(0, -1));

})



$(document).on('click', '#deleteStore', function event(e) {
    let array = $('input[type="checkbox"]:checked');
    console.log(array);
    for (let i = 0; i < array.length - 1; i++) {
        array[i].checked = false;
        $("#Credential_UtilisateursAutorises").val('')
}
})




$(document).on('click', 'div.fc-content > div > span', function event(e) {
     let essais = ($($(this).parents()[2]).attr('id'));
     const words = essais.split('_');
     console.log(words[2]);
     document.location.href="https://apps.glanum.com/GDP/TimeTracking/Edit/"+words[2]; 

})


$(document).on('click', '#unlock', function event(e) {
    let formlock = ($('#main_container > div > div > form')[0].getElementsByTagName("input"));

        for (var i = 0; i < formlock.length; i++) {
            formlock[i].disabled = false;
        }



})


let tab= $(".task_container.opened")
for (let i = 0 ; i < tab.length ; i++)
{
    let subtable = $(tab[i]).children()
    let array = []
    for (let z = 0 ; z < subtable.length ; z++){
        let text = subtable[i].outerText;
        array[text] = subtable[i].outerText;
        //array.push(subtable[i])
    }
    console.log('table : ');
    console.log(array);
}



    let unlock = $("#main_container > div > div > form > div.dnaf_layout_inline > fieldset > div.dnaf_row.dnaf_row_40")[0].insertAdjacentHTML('beforeend',"<button id='unlock' onclick='return false;'>unlock</button>")
    console.log(unlock)

