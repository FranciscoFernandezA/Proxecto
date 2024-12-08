


const productCards = document.querySelectorAll(".producto");
productCards.forEach((card) => {


  //ANIMACION PARA LAS CARDS
  card.addEventListener("mouseover", () => {
    card.style.transform = "scale(1.2)";
    card.style.backgroundColor = "#fad4f9";
    card.style.position = "relative";
    card.style.zIndex = "1";
  });

  card.addEventListener("mouseout", () => {
    card.style.transform = "scale(1)";
    card.style.backgroundColor = "#ffffff";
    card.style.position = "relative";
    card.style.zIndex = "0";
  });
});
