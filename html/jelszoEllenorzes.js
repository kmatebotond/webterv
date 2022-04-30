function jelszoEllenorzes() {
    let jelszo = document.getElementById("jelszo").value
    let jelszoUjra = document.getElementById("jelszo_ujra").value
    let elkuldes = document.getElementById("elkuldes")
    let hiba =  document.getElementById("hiba")
    
    if (jelszo.length < 6 || jelszo !== jelszoUjra) {
        elkuldes.disabled = true
        hiba.innerHTML = "A jelszavaknak meg kell egyezniük és legalább 6 karakternek kell lenniük."
    } else {
        elkuldes.disabled = false
        hiba.innerHTML = ""
    }   
}

jelszoEllenorzes()
