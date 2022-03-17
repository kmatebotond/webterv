for (let i = 0; i < 5; i++) {
  createKategória("Kategória")
}
for (let i = 0; i < 5; i++) {
  createTermek("Termék név", "", "Termék leírás")
}

function createKategória(kategoriaNev) {
  let kategoriak = document.getElementById("kategoriak")
  
  let li = document.createElement("li")
  li.appendChild(document.createTextNode("Kategória"))
  
  kategoriak.appendChild(li)
}

function createTermek(termekNev, termekKep, termekLeiras) {
  let termekek = document.getElementById("termekek")

  let li = document.createElement("li")

  let div = document.createElement("div")

  let p1 = document.createElement("p")
  p1.setAttribute("id", "termek-nev")
  p1.appendChild(document.createTextNode("Termék név"))

  let a = document.createElement("a")
  a.setAttribute("href", "termek.html")

  let img = document.createElement("img")
  img.setAttribute("id", "termek-kep")
  img.setAttribute("src", "")
  img.setAttribute("alt", "Termék kép")
  
  a.appendChild(img)

  let p2 = document.createElement("p")
  p2.setAttribute("id", "termek-leiras")
  p2.appendChild(document.createTextNode("Termék leírás"))

  div.appendChild(p1)
  div.appendChild(a)
  div.appendChild(p2)

  li.appendChild(div)

  termekek.appendChild(li)
}