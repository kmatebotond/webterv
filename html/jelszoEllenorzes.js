function jelszoEllenorzes() {
    let jelszo = document.getElementsByName("jelszo")[0].value
    let jelszoUjra = document.getElementsByName("jelszo_ujra")[0].value
    let regisztracio = document.getElementsByName("regisztracio")[0]
    
    if (jelszo.length < 6 || jelszo !== jelszoUjra) {
        regisztracio.disabled = true
    } else {
        regisztracio.disabled = false
    }   
}

jelszoEllenorzes()
