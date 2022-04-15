function jelszoEllenorzes() {
    let jelszo = document.getElementById("jelszo").value
    let jelszoUjra = document.getElementById("jelszo_ujra").value
    let elkuldes = document.getElementById("elkuldes")
    
    if (jelszo.length < 6 || jelszo !== jelszoUjra) {
        elkuldes.disabled = true
    } else {
        elkuldes.disabled = false
    }   
}

jelszoEllenorzes()
