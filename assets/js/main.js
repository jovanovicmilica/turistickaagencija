$(document).ready(function(){
    


    if(location.href.indexOf("index.php")!=-1){
        $("#glasajAnketa").click(glasaj)
    }
    if(location.href.indexOf("putovanje.php")!=-1){
        $(".listaZelja").click(dodajUlistuZelja)
    }
    if(location.href.indexOf("listaZelja.php")!=-1){
        $(".listaZeljaBrisi").click(brisiIzListe)
    }
    if(location.href.indexOf("kontakt.php")!=-1){
        $("#btnPoruka").click(posaljiPoruku)
    }
    if(location.href.indexOf("admin.php")!=-1){
        $("#onemoguci").click(onemoguci)
        $("#omoguci").click(omoguci)
    }
    if(location.href.indexOf("dodajAdmin.php")!=-1){
        $("#dodajPutovanje").click(dodajPutovanje)
        $("#dodajPutopis").click(dodajPutopis)
    }
    if(location.href.indexOf("putovanjaAdmin.php")!=-1){
        $(".obrisiPutovanje").click(obrisiPutovanje)
    }
    if(location.href.indexOf("adminPutopisi.php")!=-1){
        $(".obrisiPutopis").click(obrisiPutopis)
    }
    if(location.href.indexOf("azuriraj.php")!=-1){
        $("#updatePutovanje").click(updatePutovanje)
    }
    if(location.href.indexOf("azurirajPutopis.php")!=-1){
        $("#updatePutopis").click(updatePutopis)
    }


    
})

function glasaj(){
    var cb=$('input[name="anketa"]:checked')
    var idAnkete=$("#anketaId").val()

    
    if(cb.val()!=undefined){
        $.ajax({
            url:'models/glasaj.php',
            method:"POST",
            dataType:"json",
            data:{
                "izbor":cb.val(),
                "anketa":idAnkete,
                "dugme":true
            },
            success:function(data){
                $("#anketaTekst").html(data)
                $("#glasajAnketa").attr("disabled",true)
            },
            error:function(xhr){
                $("#anketaTekst").html(xhr.responseText)
            }
        })
    }
    else{
        $("#anketaTekst").html("Niste izabrali odgovor")
    }
}

$("#nalog").click(function(e){
    e.preventDefault()
    $("#modal").show()
    $("#registracijaForma").hide()
    $("#logovanjeForma").show()
})
$("#registracija").click(function(e){
    e.preventDefault()
    $("#registracijaForma").show()
    $("#logovanjeForma").hide()
    $("#registracija").addClass("aktivno")
    $("#logovanje").removeClass("aktivno")
})
$("#logovanje").click(function(e){
    e.preventDefault()
    $("#registracijaForma").hide()
    $("#logovanjeForma").show()
    $("#registracija").removeClass("aktivno")
    $("#logovanje").addClass("aktivno")
})

$("#close").click(function(e){
    e.preventDefault()
    $("#modal").hide()
    $("#registracija").removeClass("aktivno")
    $("#logovanje").addClass("aktivno")
})

$("#btnLog").click(function(){
    var mail=document.getElementById("emailLog").value;
    var pass=document.getElementById("lozinkaLog").value;

    
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;

    
    if(!regEmail.test(mail)){
        document.getElementById("logovanjeStatus").innerHTML="E-mail format: ivana.panic.176.16@ict.edu.rs ili ivana@gmail.com"
        return false
    }
    else{
        document.getElementById("logovanjeStatus").innerHTML=""
    }
    if(!regPass.test(pass)){
        document.getElementById("logovanjeStatus").innerHTML="Lozinka mora imati bar 8 karaktera"
        return false
    }
    else{
        document.getElementById("logovanjeStatus").innerHTML=""
    }
    $.ajax({
        url:'models/logovanjeObrada.php',
        method:"POST",
        dataType:"json",
        data:{
            "mail":mail,
            "pass":pass,
            "dugme":true
        },
        success:function(data){
            if(data==201){
                location.reload()
            }
            else{
                $("#logovanjeStatus").html(data)
            }
        },
        error:function(xhr){
            $("#logovanjeStatus").html(JSON.parse(xhr.responseText))
        }
    })
})

$("#odjava").click(function(e){
    e.preventDefault()
    $.ajax({
        url:'models/odjava.php',
        method:"POST",
        dataType:"json",
        success:function(data){
            location.reload()
        },
        error:function(xhr){
            
        }
    })
})

$("#btnReg").click(function(e){
    e.preventDefault()

    //poruka za greske
    var ime=document.getElementById("ime").value;
    var prezime=document.getElementById("prezime").value;
    var mail=document.getElementById("email").value;
    var pass=document.getElementById("lozinka").value;
    var passConf=document.getElementById("lozinkaPonovi").value;

    var regIme=/^[A-Z][a-z]{2,29}$/;
    var regPrezime=/^[A-Z][a-z]{2,39}$/;
    var regEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    var regPass=/^.{8,50}$/;


    
    var greske=0;
    if(!regIme.test(ime)){
        $("#porukaIme").html("Ime mora poceti velikom slovom i ima najvise 30 slova");
        greske++;
    }
    else{
        $("#porukaIme").html("");
    }
    if(!regPrezime.test(prezime)){
        $("#porukaPrezime").html("Prezime mora poceti velikim slovom i ima najvise 40 slova");
        greske++;
    }
    else{
        $("#porukaPrezime").html("");
    }
    if(!regEmail.test(mail)){
        $("#porukaEmail").html("E-mail format: ivana.panic.176.16@ict.edu.rs ili ivana@gmail.com");
        greske++;
    }
    else{
        $("#porukaEmail").html("");
    }
    if(!regPass.test(pass)){
        $("#porukaLozinka").html("Lozinka mora imati najmanje 8 karaktera");
        greske++;
    }
    else{
        $("#porukaLozinka").html("");
    }
    if(passConf!=pass){
        $("#porukaLozinkaPonovi").html("Lozinke se ne poklapaju");
        greske++;
    }
    else{
        $("#porukaLozinkaPonovi").html("");
    }
    
    if(greske==0){
        
        $.ajax({
            url:"models/obradaRegistracija.php",
            method:"post",
            dataType:"json",
            data:{
                "ime":ime,
                "prezime":prezime,
                "email":mail,
                "pass":pass,
                "passConf":passConf,
                "dugmeReg":true
            },
            success:function(data){
                $("#poruka").html(data)
            },
            error:function(xhr){
                $("#poruka").html(xhr.responseText)
            }
        })
    }
})

function dodajUlistuZelja(e){
    e.preventDefault()
    var klik=this.dataset.id
    $.ajax({
        url:"models/obradaListaZelja.php",
        method:"post",
        dataType:"json",
        data:{
            "idPutovanja":klik,
            "dugmeLista":true
        },
        success:function(data){
            if(data=="Morate se ulogovati"){
                $("#wlist").html(data)
            }
            else{
                location.reload()
            }
        },
        error:function(xhr){
            $("#poruka").html(xhr.responseText)
        }
    })
    
}

function brisiIzListe(e){
    e.preventDefault()
    var red=$(this)
    id=this.dataset.id
    $.ajax({
        url:"models/obrisiIzListe.php",
        method:"post",
        dataType:"json",
        data:{
            "idPutovanja":id,
            "dugmeLista":true
        },
        success:function(data){
            red.parent().parent().remove()
        },
        error:function(xhr){
            red.parent().parent().html(xhr.responseText)
        }
    })
}

function posaljiPoruku(){
    var ime=$("#imePoruka").val()
    var prezime=$("#prezimePoruka").val()
    var email=$("#emailPoruka").val()
    var telefon=$("#telefonPoruka").val()
    var tema=$("#temaPoruka").val()
    var poruka=$("#porukaPoruka").val()

    var regExIme=/^[A-Z][a-z]{2,29}$/
    var regExPrezime=/^[A-Z][a-z]{2,39}$/
    var regExEmail=/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/
    var regExTelefon=/^06\d{8}$/
    var regExTema=/^[\w\s\d]+$/
    var regExPoruka=poruka.split(" ")


    if(!regExIme.test(ime)){
        $("#porukaForma").html("Ime mora poceti velikim slovom i ima 30 karaktera najvise")
        return false
    }
    else{
        $("#porukaForma").html("")
    }
    if(!regExPrezime.test(prezime)){
        $("#porukaForma").html("Prezime mora poceti velikim slovom i ima 40 karaktera najvise")
        return false
    }
    else{
        $("#porukaForma").html("")
    }
    if(!regExEmail.test(email)){
        $("#porukaForma").html("E-mail format: ivana.panic.176.16@ict.edu.rs ili ivana@gmail.com")
        return false
    }
    else{
        $("#porukaForma").html("")
    }
    if(!regExTelefon.test(telefon)){
        $("#porukaForma").html("Telefon mora biti u formatu 06******** (8 cifara) umesto zvezdica")
        return false
    }
    else{
        $("#porukaForma").html("")
    }
    if(!regExTema.test(tema)){
        $("#porukaForma").html("Morate upisati temu")
        return false
    }
    else{
        $("#porukaForma").html("")
    }
    if(regExPoruka.length<10){
        $("#porukaForma").html("Poruka mora imati bar 10 reci")
        return false
    }
    else{
        $("#porukaForma").html("")
    }

    $.ajax({
        url:"models/posaljiPoruku.php",
        method:"post",
        dataType:"json",
        data:{
            "ime":ime,
            "prezime":prezime,
            "email":email,
            "telefon":telefon,
            "tema":tema,
            "poruka":regExPoruka,
            "dugme":true
        },
        success:function(data){
            $("#porukaForma").html(data)
        },
        error:function(xhr){
            $("#porukaForma").html(xhr.responseText)
        }
    })
}

function omoguci(){
    $.ajax({
        url:"models/omoguciAnketu.php",
        method:"post",
        dataType:"json",
        data:{
            "dugme2":true
        },
        success:function(data){
            $("#porukaAnketa").html(data)
            location.reload()
        },
        error:function(xhr){
            $("#porukaAnketa").html(xhr.responseText)
        }
    })
}


function onemoguci(){
    $.ajax({
        url:"models/omoguciAnketu.php",
        method:"post",
        dataType:"json",
        data:{
            "dugme":true
        },
        success:function(data){
            $("#porukaAnketa").html(data)
            location.reload()
        },
        error:function(xhr){
            $("#porukaAnketa").html(xhr.responseText)
        }
    })
}

function dodajPutovanje(){
    var slika=document.getElementById("slika").files[0]
    var naslov=document.getElementById("naslov").value
    var polazak=document.getElementById("polazak").value
    var povratak=document.getElementById("povratak").value
    var tekst=document.getElementById("tekst").value
    var cena=document.getElementById("cena").value
    var prevoz=document.getElementById("prevoz").value

    var podaciZaSlanje= new FormData();

    var datum=new Date()

    var polazakDan=polazak.split("-")[2]
    var polazakMesec=polazak.split("-")[1]


    podaciZaSlanje.append("slika",slika)
    podaciZaSlanje.append("naslov",naslov)
    podaciZaSlanje.append("polazak",polazak)
    podaciZaSlanje.append("povratak",povratak)
    podaciZaSlanje.append("tekst",tekst)
    podaciZaSlanje.append("cena",cena)
    podaciZaSlanje.append("prevoz",prevoz)
    podaciZaSlanje.append("dugme",true)

    if(slika==undefined || naslov=="" || tekst=="" || cena=="" || polazak=="" || povratak==""){
        $("#porukaInsertPutovanje").html("Sva polja moraju biti popunjena i morate izabrati sliku")
        return false
    }
    else{
        $("#porukaInsertPutovanje").html("")
    }
    
    if(polazakMesec<=datum.getMonth()+1){
        if(polazakDan<datum.getDate()){
            $("#porukaInsertPutovanje").html("Datum polaska ne moze biti u proslosti")
            return false
        }
        if(polazakDan>datum.getDate()){
            $("#porukaInsertPutovanje").html("")
        }
    }
    else{
        $("#porukaInsertPutovanje").html("")
    }
    if(povratak<=polazak){
        $("#porukaInsertPutovanje").html("Datum povratka ne moze biti pre datuma polaska")
        return false
    }
    else{
        $("#porukaInsertPutovanje").html("")
    }

    $.ajax({
        url:"models/dodajPutovanje.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#porukaInsertPutovanje").html(data)
        },
        error:function(xhr){
            $("#porukaInsertPutovanje").html(xhr.responseText)
        }
    })
}

function dodajPutopis(){
    var slika=document.getElementById("slikaPutopis").files[0]
    var naslov=document.getElementById("naslovPutopis").value
    var tekst=document.getElementById("tekstPutopis").value

    var podaciZaSlanje= new FormData();
    podaciZaSlanje.append("slika",slika)
    podaciZaSlanje.append("naslov",naslov)
    podaciZaSlanje.append("tekst",tekst)
    podaciZaSlanje.append("dugme",true)

    if(slika==undefined || naslov=="" || tekst==""){
        $("#formaDodajPutopis").html("Sva polja moraju biti popunjena i morate izabrati sliku")
        return false
    }
    else{
        $("#formaDodajPutopis").html("")
    }

    $.ajax({
        url:"models/dodajPutopis.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:podaciZaSlanje,
        success:function(data){
            $("#formaDodajPutopis").html(data)
        },
        error:function(xhr){
            $("#formaDodajPutopis").html(xhr.responseText)
        }
    })

}

function obrisiPutovanje(e){
    e.preventDefault()
    var id=this.dataset.id

    $.ajax({
        url:"models/obrisiPutovanje.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id,
            "dugme":true
        },
        success:function(data){
            location.reload()
        },
        error:function(xhr){
            $(this).parent().parent().parent().html(xhr.responseText)
        }
    })
}

function obrisiPutopis(e){
    e.preventDefault()
    var id=this.dataset.id

    $.ajax({
        url:"models/obrisiPutopis.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id,
            "dugme":true
        },
        success:function(data){
            location.reload()
        },
        error:function(xhr){
        }
    })
}

function updatePutovanje(){
    var naslov=document.getElementById("naslovUpdate").value
    var polazak=document.getElementById("polazakUpdate").value
    var povratak=document.getElementById("povratakUpdate").value
    var tekst=document.getElementById("tekstUpdate").value
    var cena=document.getElementById("cenaUpdate").value
    var prevoz=document.getElementById("prevozUpdate").value
    var id=document.getElementById("id").value


    var datum=new Date()

    var polazakDan=polazak.split("-")[2]
    var polazakMesec=polazak.split("-")[1]



    if(naslov=="" || tekst=="" || cena=="" || polazak=="" || povratak==""){
        $("#porukaUpdatePutovanje").html("Sva polja moraju biti popunjena")
        return false
    }
    else{
        $("#porukaUpdatePutovanje").html("")
    }
    
    if(polazakMesec<=datum.getMonth()+1){
        if(polazakDan<datum.getDate()){
            $("#porukaUpdatePutovanje").html("Datum polaska ne moze biti u proslosti")
            return false
        }
        if(polazakDan>datum.getDate()){
            $("#porukaUpdatePutovanje").html("")
        }
    }
    else{
        $("#porukaUpdatePutovanje").html("")
    }
    if(povratak<=polazak){
        $("#porukaUpdatePutovanje").html("Datum povratka ne moze biti pre datuma polaska")
        return false
    }
    else{
        $("#porukaUpdatePutovanje").html("")
    }

    $.ajax({
        url:"models/azurirajPutovanje.php",
        method:"post",
        dataType:"json",
        data:{
            "naslov":naslov,
            "polazak":polazak,
            "povratak":povratak,
            "tekst":tekst,
            "cena":cena,
            "prevoz":prevoz,
            "dugme":true,
            "id":id,
        },
        success:function(data){
            $("#porukaUpdatePutovanje").html(data)
        },
        error:function(xhr){
            $("#porukaUpdatePutovanje").html(xhr.responseText)
        }
    })
}

function updatePutopis(){
    var naslov=document.getElementById("naslovPutopisUpdate").value
    var tekst=document.getElementById("tekstPutopisUpdate").value
    var id=document.getElementById("id").value

    if(naslov=="" || tekst==""){
        $("#formaUpdatePutopis").html("Sva polja moraju biti popunjena i morate izabrati sliku")
        return false
    }
    else{
        $("#formaUpdatePutopis").html("")
    }


    $.ajax({
        url:"models/updatePutopis.php",
        method:"post",
        dataType:"json",
        data:{
            "id":id,
            "naslov":naslov,
            "tekst":tekst,
            "dugme":true
        },
        success:function(data){
            $("#formaUpdatePutopis").html(data)
        },
        error:function(xhr){
            $("#formaUpdatePutopis").html(xhr.responseText)
        }
    })


}